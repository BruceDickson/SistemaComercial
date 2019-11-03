<?php

class UNIDADE_DAO extends MASTER_DAO{

 public function insert($obj)
 {
    $db = $this->getDB()->prepare('INSERT INTO UNIDADE (unidade, qtd) VALUES ("'.$obj->getUnidade().'","'.$obj->getQtd().'");');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM UNIDADE WHERE id = LAST_INSERT_ID();');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}
public function update($obj)
{
    $update_string = '';
    if($obj->getUnidade() != '') $update_string .= 'unidade="'. $obj->getUnidade() .'", ';
    if($obj->getQtd() != '') $update_string .= 'qtd="'. $obj->getQtd() .'", ';
   

    $db = $this->getDB()->prepare('UPDATE UNIDADE SET '. $update_string .' updateDate="'. date('Y-m-d H:i:s') .'" WHERE id='. $obj->getId() .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM UNIDADE WHERE id = '. $obj->getId() .';');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

public function delete($id)
{  
    $db = $this->getDB()->prepare('UPDATE UNIDADE SET deleteDate ="'. date('Y-m-d H:i:s') .'" WHERE id='. $id .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return true;
}

public function find_id($id)
{
    $db = $this->getDB()->prepare('SELECT * FROM UNIDADE WHERE id = '. $id .';');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_all()
{
    $db = $this->getDB()->prepare('SELECT * FROM UNIDADE WHERE deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

}