<?php

class PESSOA_DAO extends MASTER_DAO{

 public function insert($obj)
 {
    $db = $this->getDB()->prepare('INSERT INTO PESSOA (nome, cpf, rg, sexo, dataNascimento, telefone, ENDERECO_id) VALUES ("'.$obj->getNome().'","'.$obj->getCpf().'","'.$obj->getRg().'","'.$obj->getSexo().'","'.$obj->getDataNascimento().'","'.$obj->getTelefone().'","'.$obj->getENDERECO_id().'");');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM PESSOA WHERE id = LAST_INSERT_ID();');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}
public function update($obj)
{
    $update_string = '';
    if($obj->getNome() != '') $update_string .= 'nome="'. $obj->getNome() .'", ';
    if($obj->getCpf() != '') $update_string .= 'cpf="'. $obj->getCpf() .'", ';
    if($obj->getRg() != '') $update_string .= 'rg="'. $obj->getRg() .'", ';
    if($obj->getSexo() != '') $update_string .= 'sexo="'. $obj->getSexo() .'", ';
    if($obj->getDataNascimento() != '') $update_string .= 'dataNascimento="'. $obj->getDataNascimento() .'", ';
    if($obj->getTelefone() != '') $update_string .= 'telefone="'. $obj->getTelefone() .'", ';
    if($obj->getENDERECO_id() != '') $update_string .= 'ENDERECO_id="'. $obj->getENDERECO_id() .'", ';

    $db = $this->getDB()->prepare('UPDATE PESSOA SET '. $update_string .' updateDate="'. date('Y-m-d H:i:s') .'" WHERE id='. $obj->getId() .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM PESSOA WHERE id = '. $obj->getId() .';');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

public function delete($id)
{  
    $db = $this->getDB()->prepare('UPDATE PESSOA SET deleteDate ="'. date('Y-m-d H:i:s') .'" WHERE id='. $id .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return true;
}

public function find_id($id)
{
    $db = $this->getDB()->prepare('SELECT * FROM PESSOA WHERE id = '. $id .';');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_all()
{
    $db = $this->getDB()->prepare('SELECT * FROM PESSOA WHERE deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}


}