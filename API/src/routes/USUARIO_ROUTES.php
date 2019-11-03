<?php

require (__dir__ . '/../DAO/USUARIO_DAO.php');
require (__dir__ . '/../models/USUARIO_MODELS.php');


$app->get('/usuario/{id}', function ($request, $response, $args) {
    if(!is_numeric($args['id'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new USUARIO_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_id($args['id']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->post('/usuario', function ($request, $response) {
    $data = $request->getParsedBody();

    $obj = new USUARIO_MODELS();
    $dao = new USUARIO_DAO();
    
    //se existe
    if(isset($data['usuario'])) $obj->setUsuario(filter_var($data['usuario'], FILTER_SANITIZE_STRING));
    if(isset($data['senha'])) $obj->setSenha(filter_var($data['senha'], FILTER_SANITIZE_STRING));
    if(isset($data['email'])) $obj->setEmail(filter_var($data['email'], FILTER_SANITIZE_STRING));
    if(isset($data['PESSOA_id'])) $obj->setPESSOA_id(filter_var($data['PESSOA_id'], FILTER_SANITIZE_STRING));
   
    
    $dao->setDB($this->db);
    $result = $dao->insert($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->post('/usuario/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $obj = new USUARIO_MODELS();
    $dao = new USUARIO_DAO();
    
    $obj->setId($args['id']);
    if(isset($data['usuario'])) $obj->setUsuario(filter_var($data['usuario'], FILTER_SANITIZE_STRING));
    if(isset($data['senha'])) $obj->setSenha(filter_var($data['senha'], FILTER_SANITIZE_STRING));
    if(isset($data['email'])) $obj->setEmail(filter_var($data['email'], FILTER_SANITIZE_STRING));
    if(isset($data['PESSOA_id'])) $obj->setPESSOA_id(filter_var($data['PESSOA_id'], FILTER_SANITIZE_NUMBER_INT));
  
   
    
    $dao->setDB($this->db);
    $result = $dao->update($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->delete('/usuario/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $dao = new USUARIO_DAO();
    $dao->setDB($this->db);
    $result = $dao->delete($args['id']);
    
    if($result)
        $response->withStatus(200);
    else
        $response->withStatus(400);
});