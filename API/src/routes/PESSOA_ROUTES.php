<?php

require (__dir__ . '/../DAO/PESSOA_DAO.php');
require (__dir__ . '/../models/PESSOA_MODELS.php');


$app->get('/pessoa/{id}', function ($request, $response, $args) {
    if(!is_numeric($args['id'])){
        $response->withStatus(404);
        return false;
    }
    
    $dao = new PESSOA_DAO();
    $dao->setDB($this->db);
    $result = $dao->find_id($args['id']);
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(200)->write(json_encode($result));
    else
        $response->withStatus(404);
    
});

$app->post('/pessoa', function ($request, $response) {
    $data = $request->getParsedBody();

    $obj = new PESSOA_MODELS();
    $dao = new PESSOA_DAO();
    
    //se existe
    if(isset($data['nome'])) $obj->setNome(filter_var($data['nome'], FILTER_SANITIZE_STRING));
    if(isset($data['cpf'])) $obj->setCpf(filter_var($data['cpf'], FILTER_SANITIZE_STRING));
    if(isset($data['rg'])) $obj->setRg(filter_var($data['rg'], FILTER_SANITIZE_STRING));
    if(isset($data['sexo'])) $obj->setSexo(filter_var($data['sexo'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['dataNascimento'])) $obj->setDataNascimento(filter_var($data['dataNascimento'], FILTER_SANITIZE_STRING));
    if(isset($data['telefone'])) $obj->setTelefone(filter_var($data['telefone'], FILTER_SANITIZE_STRING));
    if(isset($data['ENDERECO_id'])) $obj->setENDERECO_id(filter_var($data['ENDERECO_id'], FILTER_SANITIZE_NUMBER_INT));
    
    $dao->setDB($this->db);
    $result = $dao->insert($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->post('/pessoa/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $obj = new PESSOA_MODELS();
    $dao = new PESSOA_DAO();
    
    $obj->setId($args['id']);
    if(isset($data['nome'])) $obj->setNome(filter_var($data['nome'], FILTER_SANITIZE_STRING));
    if(isset($data['cpf'])) $obj->setCpf(filter_var($data['cpf'], FILTER_SANITIZE_STRING));
    if(isset($data['rg'])) $obj->setRg(filter_var($data['rg'], FILTER_SANITIZE_STRING));
    if(isset($data['sexo'])) $obj->setSexo(filter_var($data['sexo'], FILTER_SANITIZE_NUMBER_INT));
    if(isset($data['dataNascimento'])) $obj->setDataNascimento(filter_var($data['dataNascimento'], FILTER_SANITIZE_STRING));
    if(isset($data['telefone'])) $obj->setTelefone(filter_var($data['telefone'], FILTER_SANITIZE_STRING));
    if(isset($data['ENDERECO_id'])) $obj->setENDERECO_id(filter_var($data['ENDERECO_id'], FILTER_SANITIZE_NUMBER_INT));
   
    
    $dao->setDB($this->db);
    $result = $dao->update($obj);
    
    if($result)
        $response->withHeader('Content-type', 'application/json')->withStatus(201)->write(json_encode($result));
    else
        $response->withStatus(400);
});

$app->delete('/pessoa/{id}', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $dao = new PESSOA_DAO();
    $dao->setDB($this->db);
    $result = $dao->delete($args['id']);
    
    if($result)
        $response->withStatus(200);
    else
        $response->withStatus(400);
});