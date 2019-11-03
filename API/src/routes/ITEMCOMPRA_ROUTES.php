<?php

require (__dir__ . '/../DAO/ITEMCOMPRA_DAO.php');
require (__dir__ . '/../models/ITEMCOMPRA_MODELS.php');

$app->get('/itenscompra/{id}', function ($request, $response, $args) {
    $dao = new ITEMCOMPRA_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_itens_compra($args['id']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));	
    else
        $response->withStatus(404);
    
});

$app->get('/itemcompra/{id}', function ($request, $response, $args) {
    if(!is_numeric($args['id'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new ITEMCOMPRA_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_id($args['id']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->post('/itemcompra', function ($request, $response) {
    $data = $request->getParsedBody();

    $obj = new ITEMCOMPRA_MODELS();
    $dao = new ITEMCOMPRA_DAO();
    
    //se existe
    if(isset($data['qtd'])) $obj->setQtd(filter_var($data['qtd'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['valor'])) $obj->setValor(filter_var($data['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['pCompra'])) $obj->setPCompra(filter_var($data['pCompra'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['COMPRA_id'])) $obj->setCOMPRA_id(filter_var($data['COMPRA_id'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['PRODUTO_id'])) $obj->setPRODUTO_id(filter_var($data['PRODUTO_id'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['UNIDADE_id'])) $obj->setUNIDADE_id(filter_var($data['UNIDADE_id'], FILTER_SANITIZE_NUMBER_INT));
    
    $dao->setDB($this->db);
    $result = $dao->insert($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->post('/itemcompra/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $obj = new ITEMCOMPRA_MODELS();
    $dao = new ITEMCOMPRA_DAO();    
    
    $obj->setId($args['id']);
    if(isset($data['qtd'])) $obj->setQtd(filter_var($data['qtd'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['valor'])) $obj->setValor(filter_var($data['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['pCompra'])) $obj->setPCompra(filter_var($data['pCompra'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['COMPRA_id'])) $obj->setCOMPRA_id(filter_var($data['COMPRA_id'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['PRODUTO_id'])) $obj->setPRODUTO_id(filter_var($data['PRODUTO_id'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['UNIDADE_id'])) $obj->setUNIDADE_id(filter_var($data['UNIDADE_id'], FILTER_SANITIZE_NUMBER_INT));
   
    
    $dao->setDB($this->db);
    $result = $dao->update($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->delete('/itemcompra/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $dao = new ITEMCOMPRA_DAO();  
    $dao->setDB($this->db);
    $result = $dao->delete($args['id']);
    
    if($result)
        //$response->withStatus(200);
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(400);
});