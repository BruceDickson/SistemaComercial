<?php

class ITEMCOMPRA_DAO extends MASTER_DAO{

 public function insert($obj)
 {
    $db = $this->getDB()->prepare('INSERT INTO ITEMCOMPRA (qtd, valor, pCompra, COMPRA_id, PRODUTO_id, UNIDADE_id) VALUES ("'.$obj->getQtd().'","'.$obj->getValor().'", "'.$obj->getPCompra().'","'.$obj->getCOMPRA_id().'","'.$obj->getPRODUTO_id().'","'.$obj->getUNIDADE_id().'");"');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM ITEMCOMPRA WHERE id = LAST_INSERT_ID();');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}
public function update($obj)
{
    $update_string = '';
    if($obj->getQtd() != '') $update_string .= 'qtd="'. $obj->getQtd() .'", ';
    if($obj->getValor() != '') $update_string .= 'valor="'. $obj->getValor() .'", ';
    if($obj->getPCompra() != '') $update_string .= 'pVenda="'. $obj->getPCompra() .'", ';
    if($obj->getCOMPRA_id() != '') $update_string .= 'COMPRA_id="'. $obj->getCOMPRA_id() .'", ';
    if($obj->getPRODUTO_id() != '') $update_string .= 'PRODUTO_id="'. $obj->getPRODUTO_id() .'", ';
    if($obj->getUNIDADE_id() != '') $update_string .= 'UNIDADE_id="'. $obj->getUNIDADE_id() .'", ';

    $db = $this->getDB()->prepare('UPDATE ITEMCOMPRA SET '. $update_string .' updateDate="'. date('Y-m-d H:i:s') .'" WHERE id='. $obj->getId() .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM ITEMCOMPRA WHERE id = '. $obj->getId() .';');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

public function delete($id)
{  
    //$db = $this->getDB()->prepare('UPDATE ITEMCOMPRA SET deleteDate ="'. date('Y-m-d H:i:s') .'" WHERE id='. $id .' AND deleteDate IS NULL;');
    $db = $this->getDB()->prepare('SELECT * FROM ITEMCOMPRA WHERE  id='. $id .'; UPDATE ITEMCOMPRA SET deleteDate ="'. date('Y-m-d H:i:s') .'" WHERE id='. $id .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    //return true;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_id($id)
{
    $db = $this->getDB()->prepare('SELECT * FROM ITEMCOMPRA WHERE id = '. $id .';');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_all()
{
    $db = $this->getDB()->prepare('SELECT * FROM ITEMCOMPRA WHERE deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_itens_compra($id)
{
    $db = $this->getDB()->prepare('SELECT * FROM ITENSCOMPRA_VIEW WHERE ITEMCOMPRA_COMPRA_id = '. $id .' AND ITEMCOMPRA_delete_Date IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

}