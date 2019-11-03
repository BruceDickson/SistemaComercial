<?php

require (__dir__ . '/../DAO/ENDERECO_DAO.php');
require (__dir__ . '/../models/ENDERECO_MODELS.php');


$app->get('/enderecos', function ($request, $response, $args) {
    $dao = new ENDERECO_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_all();
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->get('/endereco/{id}', function ($request, $response, $args) {
    if(!is_numeric($args['id'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new ENDERECO_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_id($args['id']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->get('/ruaendereco/{rua}', function ($request, $response, $args) {
    if(empty($args['rua'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new ENDERECO_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_name($args['rua']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->post('/endereco', function ($request, $response) {
    $data = $request->getParsedBody();

    $obj = new ENDERECO_MODELS();
    $dao = new ENDERECO_DAO();
    
    //se existe
    if(isset($data['cep'])) $obj->setCep(filter_var($data['cep'], FILTER_SANITIZE_STRING));
    if(isset($data['numero'])) $obj->setNumero(filter_var($data['numero'], FILTER_SANITIZE_STRING));
    if(isset($data['rua'])) $obj->setRua(filter_var($data['rua'], FILTER_SANITIZE_STRING));
    if(isset($data['bairro'])) $obj->setBairro(filter_var($data['bairro'], FILTER_SANITIZE_STRING));
    if(isset($data['cidade'])) $obj->setCidade(filter_var($data['cidade'], FILTER_SANITIZE_STRING));
    if(isset($data['uf'])) $obj->setUf(filter_var($data['uf'], FILTER_SANITIZE_STRING));
    
    $dao->setDB($this->db);
    $result = $dao->insert($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->post('/endereco/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $obj = new ENDERECO_MODELS();
    $dao = new ENDERECO_DAO();
    
    $obj->setId($args['id']);
    if(isset($data['cep'])) $obj->setCep(filter_var($data['cep'], FILTER_SANITIZE_STRING));
    if(isset($data['numero'])) $obj->setNumero(filter_var($data['numero'], FILTER_SANITIZE_STRING));
    if(isset($data['rua'])) $obj->setRua(filter_var($data['rua'], FILTER_SANITIZE_STRING));
    if(isset($data['bairro'])) $obj->setBairro(filter_var($data['bairro'], FILTER_SANITIZE_STRING));
    if(isset($data['cidade'])) $obj->setCidade(filter_var($data['cidade'], FILTER_SANITIZE_STRING));
    if(isset($data['uf'])) $obj->setUf(filter_var($data['uf'], FILTER_SANITIZE_STRING));
   
    
    $dao->setDB($this->db);
    $result = $dao->update($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->delete('/endereco/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $dao = new ENDERECO_DAO();
    $dao->setDB($this->db);
    $result = $dao->delete($args['id']);
    
    if($result)
        $response->withStatus(200);
    else
        $response->withStatus(400);
});