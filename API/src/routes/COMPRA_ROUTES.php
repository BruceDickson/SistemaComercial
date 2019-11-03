<?php

require (__dir__ . '/../DAO/COMPRA_DAO.php');
require (__dir__ . '/../models/COMPRA_MODELS.php');


$app->get('/compra/{id}', function ($request, $response, $args) {
    if(!is_numeric($args['id'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new COMPRA_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_id($args['id']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->get('/compras', function ($request, $response, $args) {
    $dao = new COMPRA_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_all();
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->get('/lastcompra', function ($request, $response, $args) {
    $dao = new COMPRA_DAO();
    $dao->setDB($this->db);
    $result = $dao->max_id();
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->post('/compra', function ($request, $response) {
    $data = $request->getParsedBody();

    $obj = new COMPRA_MODELS();
    $dao = new COMPRA_DAO();
    
    //se existe
    if(isset($data['valor'])) $obj->setValor(filter_var($data['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['date'])) $obj->setDate(filter_var($data['date'], FILTER_SANITIZE_STRING));
    if(isset($data['FORNECEDOR_id'])) $obj->setFORNECEDOR_id(filter_var($data['FORNECEDOR_id'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['USUARIO_id'])) $obj->setUSUARIO_id(filter_var($data['USUARIO_id'], FILTER_SANITIZE_NUMBER_INT));
    
    $dao->setDB($this->db);
    $result = $dao->insert($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->post('/compra/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $obj = new COMPRA_MODELS();
    $dao = new COMPRA_DAO();
    
    $obj->setId($args['id']);

    if(isset($data['valor'])) $obj->setValor(filter_var($data['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    if(isset($data['date'])) $obj->setDate(filter_var($data['date'], FILTER_SANITIZE_STRING));
    //if(isset($data['FORNECEDOR_id'])) $obj->setFORNECEDOR_id(filter_var($data['FORNECEDOR_id'], FILTER_SANITIZE_NUMBER_INT));
    //if(isset($data['USUARIO_id'])) $obj->setUSUARIO_id(filter_var($data['USUARIO_id'], FILTER_SANITIZE_NUMBER_INT));
    
    $dao->setDB($this->db);
    $result = $dao->update($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->delete('/compra/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $dao = new COMPRA_DAO();
    $dao->setDB($this->db);
    $result = $dao->delete($args['id']);
    
    if($result)
        $response->withStatus(200);
    else
        $response->withStatus(400);
});