<?php

require (__dir__ . '/../DAO/CATEGORIA_DAO.php');
require (__dir__ . '/../models/CATEGORIA_MODELS.php');

$app->get('/categorias', function ($request, $response, $args) {
    $dao = new CATEGORIA_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_all();
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->get('/categoria/{id}', function ($request, $response, $args) {
    if(!is_numeric($args['id'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new CATEGORIA_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_id($args['id']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->post('/categoria', function ($request, $response) {
    $data = $request->getParsedBody();

    $obj = new CATEGORIA_MODELS();
    $dao = new CATEGORIA_DAO();
    
    //se existe
    if(isset($data['nomeCategoria'])) $obj->setNomeCategoria(filter_var($data['nomeCategoria'], FILTER_SANITIZE_STRING));
    
    $dao->setDB($this->db);
    $result = $dao->insert($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->post('/categoria/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $obj = new CATEGORIA_MODELS();
    $dao = new CATEGORIA_DAO();
    
    $obj->setId($args['id']);
    if(isset($data['nomeCategoria'])) $obj->setNomeCategoria(filter_var($data['nomeCategoria'], FILTER_SANITIZE_STRING));
   
    
    $dao->setDB($this->db);
    $result = $dao->update($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->delete('/categoria/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $dao = new CATEGORIA_DAO();
    $dao->setDB($this->db);
    $result = $dao->delete($args['id']);
    
    if($result)
        $response->withStatus(200);
    else
        $response->withStatus(400);
});