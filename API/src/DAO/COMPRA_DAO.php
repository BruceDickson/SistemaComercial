<?php

class COMPRA_DAO extends MASTER_DAO{

 public function insert($obj)
 {
    $db = $this->getDB()->prepare('INSERT INTO COMPRA (valor, date, FORNECEDOR_id, USUARIO_id) VALUES ("'.$obj->getValor().'","'.$obj->getDate().'","'.$obj->getFORNECEDOR_id().'","'.$obj->getUSUARIO_id().'");');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM COMPRA WHERE id = LAST_INSERT_ID();');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}
public function update($obj)
{
    $update_string = '';
    if($obj->getValor() != '') $update_string .= 'valor="'. $obj->getValor() .'", ';
    if($obj->getDate() != '') $update_string .= 'date="'. $obj->getDate() .'", ';
    if($obj->getFORNECEDOR_id() != '') $update_string .= 'FORNECEDOR_id="'. $obj->getFORNECEDOR_id() .'", ';
    if($obj->getUSUARIO_id() != '') $update_string .= 'USUARIO_id="'. $obj->getUSUARIO_id() .'", ';

    $db = $this->getDB()->prepare('UPDATE COMPRA SET '. $update_string .' updateDate="'. date('Y-m-d H:i:s') .'" WHERE id='. $obj->getId() .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM COMPRA WHERE id = '. $obj->getId() .';');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

public function delete($id)
{  
    $db = $this->getDB()->prepare('UPDATE COMPRA SET deleteDate ="'. date('Y-m-d H:i:s') .'" WHERE id='. $id .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return true;
}

public function find_id($id)
{
    $db = $this->getDB()->prepare('SELECT * FROM COMPRA WHERE id = '. $id .';');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_all()
{
    $db = $this->getDB()->prepare('SELECT * FROM COMPRA_VIEW;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function max_id()
{
    $db = $this->getDB()->prepare('SELECT AUTO_INCREMENT as id FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = "COMPRA";');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

}