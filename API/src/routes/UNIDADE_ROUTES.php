<?php

require (__dir__ . '/../DAO/UNIDADE_DAO.php');
require (__dir__ . '/../models/UNIDADE_MODELS.php');

$app->get('/unidades', function ($request, $response, $args) {
    $dao = new UNIDADE_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_all();
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));	
    else
        $response->withStatus(404);
    
});

$app->get('/unidade/{id}', function ($request, $response, $args) {
    if(!is_numeric($args['id'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new UNIDADE_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_id($args['id']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->post('/unidade', function ($request, $response) {
    $data = $request->getParsedBody();

    $obj = new UNIDADE_MODELS();
    $dao = new UNIDADE_DAO();
    
    //se existe
    if(isset($data['unidade'])) $obj->setUnidade(filter_var($data['unidade'], FILTER_SANITIZE_STRING));
    if(isset($data['qtd'])) $obj->setQtd(filter_var($data['qtd'], FILTER_SANITIZE_NUMBER_INT));
    
    $dao->setDB($this->db);
    $result = $dao->insert($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->post('/unidade/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $obj = new UNIDADE_MODELS();
    $dao = new UNIDADE_DAO();
    
    $obj->setId($args['id']);
    if(isset($data['unidade'])) $obj->setUnidade(filter_var($data['unidade'], FILTER_SANITIZE_STRING));
    if(isset($data['qtd'])) $obj->setQtd(filter_var($data['qtd'], FILTER_SANITIZE_NUMBER_INT));
   
    $dao->setDB($this->db);
    $result = $dao->update($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->delete('/unidade/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $dao = new UNIDADE_DAO();
    $dao->setDB($this->db);
    $result = $dao->delete($args['id']);
    
    if($result)
        $response->withStatus(200);
    else
        $response->withStatus(400);
});