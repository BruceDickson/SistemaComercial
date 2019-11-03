<?php

class ENDERECO_DAO extends MASTER_DAO{

 public function insert($obj)
 {
    $db = $this->getDB()->prepare('INSERT INTO ENDERECO (cep, numero, rua, bairro, cidade, uf) VALUES ("'.$obj->getCep().'","'.$obj->getNumero().'","'.$obj->getRua().'","'.$obj->getBairro().'","'.$obj->getCidade().'","'.$obj->getUf().'");');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM ENDERECO WHERE id = LAST_INSERT_ID();');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}
public function update($obj)
{
    $update_string = '';
    if($obj->getCep() != '') $update_string .= 'cep="'. $obj->getCep() .'", ';
    if($obj->getNumero() != '') $update_string .= 'numero="'. $obj->getNumero() .'", ';
    if($obj->getRua() != '') $update_string .= 'rua="'. $obj->getRua() .'", ';
    if($obj->getBairro() != '') $update_string .= 'bairro="'. $obj->getBairro() .'", ';
    if($obj->getCidade() != '') $update_string .= 'cidade="'. $obj->getCidade() .'", ';
    if($obj->getUf() != '') $update_string .= 'uf="'. $obj->getUf() .'", ';

    $db = $this->getDB()->prepare('UPDATE ENDERECO SET '. $update_string .' updateDate="'. date('Y-m-d H:i:s') .'" WHERE id='. $obj->getId() .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM ENDERECO WHERE id = '. $obj->getId() .';');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

public function delete($id)
{  
    $db = $this->getDB()->prepare('UPDATE ENDERECO SET deleteDate ="'. date('Y-m-d H:i:s') .'" WHERE id='. $id .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return true;
}

public function find_id($id)
{
    $db = $this->getDB()->prepare('SELECT * FROM ENDERECO WHERE id = '. $id .';');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_all()
{
    $db = $this->getDB()->prepare('SELECT * FROM ENDERECO WHERE deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_name($rua)
{
    $db = $this->getDB()->prepare('SELECT * FROM ENDERECO WHERE INSTR(rua, "'.$rua.'") > 0;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}


}