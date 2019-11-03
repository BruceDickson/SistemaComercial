<?php

class EMPRESA_DAO extends MASTER_DAO{

 public function insert($obj)
 {
    $db = $this->getDB()->prepare('INSERT INTO EMPRESA (nome, cnpj, telefone, ENDERECO_id) VALUES ("'.$obj->getNome().'","'.$obj->getCnpj().'","'.$obj->getTelefone().'","'.$obj->getENDERECO_id().'");');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM EMPRESA WHERE id = LAST_INSERT_ID();');
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
    if($obj->getCnpj() != '') $update_string .= 'cnpj="'. $obj->getCnpj() .'", ';
    if($obj->getTelefone() != '') $update_string .= 'telefone="'. $obj->getTelefone() .'", ';
    if($obj->getENDERECO_id() != '') $update_string .= 'ENDERECO_id="'. $obj->getENDERECO_id() .'", ';
   
    $db = $this->getDB()->prepare('UPDATE EMPRESA SET '. $update_string .' updateDate="'. date('Y-m-d H:i:s') .'" WHERE id='. $obj->getId() .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM EMPRESA WHERE id = '. $obj->getId() .';');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

public function delete($id)
{  
    $db = $this->getDB()->prepare('UPDATE EMPRESA SET deleteDate ="'. date('Y-m-d H:i:s') .'" WHERE id='. $id .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return true;
}

public function find_id($id)
{
    $db = $this->getDB()->prepare('SELECT * FROM EMPRESA_VIEW WHERE EMPRESA_id = '. $id .';');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}


public function find_all()
{
    $db = $this->getDB()->prepare('SELECT * FROM EMPRESA_VIEW WHERE EMPRESA_delete_Date IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_name($nome)
{
    $db = $this->getDB()->prepare('SELECT * FROM EMPRESA WHERE INSTR(nome, "'.$nome.'") > 0  AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

}