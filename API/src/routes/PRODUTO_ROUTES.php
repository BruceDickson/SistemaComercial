<?php

require (__dir__ . '/../DAO/PRODUTO_DAO.php');
require (__dir__ . '/../models/PRODUTO_MODELS.php');

$app->get('/produtos', function ($request, $response, $args) {
    $dao = new PRODUTO_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_all();
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));	
    else
        $response->withStatus(404);
    
});

$app->get('/lastproduto', function ($request, $response, $args) {
    $dao = new PRODUTO_DAO();
    $dao->setDB($this->db);
    $result = $dao->max_id();
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->get('/nomeproduto/{nome}', function ($request, $response, $args) {
    if(empty($args['nome'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new PRODUTO_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_name($args['nome']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->get('/produto/{id}', function ($request, $response, $args) {
    if(!is_numeric($args['id'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new PRODUTO_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_id($args['id']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->post('/produto', function ($request, $response) {
    $data = $request->getParsedBody();

    $obj = new PRODUTO_MODELS();
    $dao = new PRODUTO_DAO();
    
    //se existe
    if(isset($data['nome'])) $obj->setNome(filter_var($data['nome'], FILTER_SANITIZE_STRING));
    if(isset($data['qtd'])) $obj->setQtd(filter_var($data['qtd'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['precoVenda'])) $obj->setPrecoVenda(filter_var($data['precoVenda'], FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['precoCompra'])) $obj->setPrecoCompra(filter_var($data['precoCompra'], FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['cx'])) $obj->setCx(filter_var($data['cx'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['CATEGORIA_id'])) $obj->setCATEGORIA_id(filter_var($data['CATEGORIA_id'], FILTER_SANITIZE_NUMBER_INT));
    
    $dao->setDB($this->db);
    $result = $dao->insert($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->post('/produto/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $obj = new PRODUTO_MODELS();
    $dao = new PRODUTO_DAO();
    
    $obj->setId($args['id']);
    if(isset($data['nome'])) $obj->setNome(filter_var($data['nome'], FILTER_SANITIZE_STRING));
    if(isset($data['qtd'])) $obj->setQtd(filter_var($data['qtd'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['precoVenda'])) $obj->setPrecoVenda(filter_var($data['precoVenda'], FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['precoCompra'])) $obj->setPrecocompra(filter_var($data['precoCompra'], FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['cx'])) $obj->setCx(filter_var($data['cx'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['CATEGORIA_id'])) $obj->setCATEGORIA_id(filter_var($data['CATEGORIA_id'], FILTER_SANITIZE_NUMBER_INT));
   
    
    $dao->setDB($this->db);
    $result = $dao->update($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->delete('/produto/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $dao = new PRODUTO_DAO();
    $dao->setDB($this->db);
    $result = $dao->delete($args['id']);
    
    if($result)
        $response->withStatus(200);
    else
        $response->withStatus(400);
});