<?php

require (__dir__ . '/../DAO/ITEMVENDA_DAO.php');
require (__dir__ . '/../models/ITEMVENDA_MODELS.php');

$app->get('/itensvenda/{id}', function ($request, $response, $args) {
    $dao = new ITEMVENDA_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_itens_venda($args['id']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));	
    else
        $response->withStatus(404);
    
});

$app->get('/itemvenda/{id}', function ($request, $response, $args) {
    if(!is_numeric($args['id'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new ITEMVENDA_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_id($args['id']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->post('/itemvenda', function ($request, $response) {
    $data = $request->getParsedBody();

    $obj = new ITEMVENDA_MODELS();
    $dao = new ITEMVENDA_DAO();
    
    //se existe
    if(isset($data['qtd'])) $obj->setQtd(filter_var($data['qtd'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['valor'])) $obj->setValor(filter_var($data['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['pVenda'])) $obj->setPVenda(filter_var($data['pVenda'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['VENDA_id'])) $obj->setVENDA_id(filter_var($data['VENDA_id'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['PRODUTO_id'])) $obj->setPRODUTO_id(filter_var($data['PRODUTO_id'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['UNIDADE_id'])) $obj->setUNIDADE_id(filter_var($data['UNIDADE_id'], FILTER_SANITIZE_NUMBER_INT));

    
    $dao->setDB($this->db);
    $result = $dao->insert($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->post('/itemvenda/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $obj = new ITEMVENDA_MODELS();
    $dao = new ITEMVENDA_DAO();
    
    $obj->setId($args['id']);
    if(isset($data['qtd'])) $obj->setQtd(filter_var($data['qtd'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['valor'])) $obj->setValor(filter_var($data['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['pVenda'])) $obj->setPVenda(filter_var($data['pVenda'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['VENDA_id'])) $obj->setVENDA_id(filter_var($data['VENDA_id'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['PRODUTO_id'])) $obj->setPRODUTO_id(filter_var($data['PRODUTO_id'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['UNIDADE_id'])) $obj->setUNIDADE_id(filter_var($data['UNIDADE_id'], FILTER_SANITIZE_NUMBER_INT));
   
    
    $dao->setDB($this->db);
    $result = $dao->update($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->delete('/itemvenda/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $dao = new ITEMVENDA_DAO();
    $dao->setDB($this->db);
    $result = $dao->delete($args['id']);
    
    if($result)
       // $response->withStatus(200);
       $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(400);
});