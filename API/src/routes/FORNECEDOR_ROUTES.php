<?php

require (__dir__ . '/../DAO/FORNECEDOR_DAO.php');
require (__dir__ . '/../models/FORNECEDOR_MODELS.php');


$app->get('/fornecedores', function ($request, $response, $args) {
    $dao = new FORNECEDOR_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_all();
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->get('/fornecedor/{id}', function ($request, $response, $args) {
    if(!is_numeric($args['id'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new FORNECEDOR_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_id($args['id']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->get('/nomefornecedor/{nome}', function ($request, $response, $args) {
    if(empty($args['nome'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new FORNECEDOR_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_name($args['nome']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->post('/fornecedor', function ($request, $response) {
    $data = $request->getParsedBody();

    $obj = new FORNECEDOR_MODELS();
    $dao = new FORNECEDOR_DAO();
    
    //se existe
    if(isset($data['nome'])) $obj->setNome(filter_var($data['nome'], FILTER_SANITIZE_STRING));
    if(isset($data['cnpj'])) $obj->setCnpj(filter_var($data['cnpj'], FILTER_SANITIZE_STRING));
    if(isset($data['telefone'])) $obj->setTelefone(filter_var($data['telefone'], FILTER_SANITIZE_STRING));
    if(isset($data['ENDERECO_id'])) $obj->setENDERECO_id(filter_var($data['ENDERECO_id'], FILTER_SANITIZE_NUMBER_INT));    
    
    $dao->setDB($this->db);
    $result = $dao->insert($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->post('/fornecedor/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $obj = new FORNECEDOR_MODELS();
    $dao = new FORNECEDOR_DAO();
    
    $obj->setId($args['id']);
    if(isset($data['nome'])) $obj->setNome(filter_var($data['nome'], FILTER_SANITIZE_STRING));
    if(isset($data['cnpj'])) $obj->setCnpj(filter_var($data['cnpj'], FILTER_SANITIZE_STRING));
    if(isset($data['telefone'])) $obj->setTelefone(filter_var($data['telefone'], FILTER_SANITIZE_STRING));
    if(isset($data['ENDERECO_id'])) $obj->setENDERECO_id(filter_var($data['ENDERECO_id'], FILTER_SANITIZE_NUMBER_INT));   
   
    
    $dao->setDB($this->db);
    $result = $dao->update($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->delete('/fornecedor/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $dao = new FORNECEDOR_DAO();
    $dao->setDB($this->db);
    $result = $dao->delete($args['id']);
    
    if($result)
        $response->withStatus(200);
    else
        $response->withStatus(400);
});