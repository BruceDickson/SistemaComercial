<?php

class PRODUTO_DAO extends MASTER_DAO{

 public function insert($obj)
 {
    $db = $this->getDB()->prepare('INSERT INTO PRODUTO (nome, qtd, precoVenda, precoCompra, cx, CATEGORIA_id) VALUES ("'.$obj->getNome().'","'.$obj->getQtd().'","'.$obj->getPrecoVenda().'","'.$obj->getPrecoCompra().'","'.$obj->getCx().'","'.$obj->getCATEGORIA_id().'");');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM PRODUTO WHERE id = LAST_INSERT_ID();');
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
    if($obj->getQtd() != '') $update_string .= 'qtd="'. $obj->getQtd() .'", ';
    if($obj->getPrecoVenda() != '') $update_string .= 'precoVenda="'. $obj->getPrecoVenda() .'", ';
    if($obj->getPrecoCompra() != '') $update_string .= 'precoCompra="'. $obj->getPrecoCompra() .'", ';
    if($obj->getCx() != '') $update_string .= 'cx="'. $obj->getCx() .'", ';
    if($obj->getCATEGORIA_id() != '') $update_string .= 'CATEGORIA_id="'. $obj->getCATEGORIA_id() .'", ';  

    $db = $this->getDB()->prepare('UPDATE PRODUTO SET '. $update_string .' updateDate="'. date('Y-m-d H:i:s') .'" WHERE id='. $obj->getId() .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM PRODUTO WHERE id = '. $obj->getId() .';');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

public function delete($id)
{  
    $db = $this->getDB()->prepare('UPDATE PRODUTO SET deleteDate ="'. date('Y-m-d H:i:s') .'" WHERE id='. $id .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return true;
}

public function find_id($id)
{
    $db = $this->getDB()->prepare('SELECT * FROM PRODUTO WHERE id = '. $id .';');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_name($name)
{
    $db = $this->getDB()->prepare('SELECT * FROM PRODUTO WHERE INSTR(nome, "'.$name.'") > 0;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_all()
{
    $db = $this->getDB()->prepare('SELECT * FROM PRODUTO WHERE deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function max_id()
{
    $db = $this->getDB()->prepare('SELECT AUTO_INCREMENT as id FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = "PRODUTO";');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}



}