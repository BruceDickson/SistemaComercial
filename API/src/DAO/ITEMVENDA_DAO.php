<?php

class ITEMVENDA_DAO extends MASTER_DAO{

 public function insert($obj)
 {
    $db = $this->getDB()->prepare('INSERT INTO ITEMVENDA (qtd, valor, pVenda, VENDA_id, PRODUTO_id, UNIDADE_id) VALUES ("'.$obj->getQtd().'","'.$obj->getValor().'","'.$obj->getPVenda().'","'.$obj->getVENDA_id().'","'.$obj->getPRODUTO_id().'","'.$obj->getUNIDADE_id().'");"');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM ITEMVENDA WHERE id = LAST_INSERT_ID();');
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
    if($obj->getPVenda() != '') $update_string .= 'pVenda="'. $obj->getPVenda() .'", ';
    if($obj->getVENDA_id() != '') $update_string .= 'VENDA_id="'. $obj->getVENDA_id() .'", ';
    if($obj->getPRODUTO_id() != '') $update_string .= 'PRODUTO_id="'. $obj->getPRODUTO_id() .'", ';
    if($obj->getUNIDADE_id() != '') $update_string .= 'UNIDADE_id="'. $obj->getUNIDADE_id() .'", ';

    $db = $this->getDB()->prepare('UPDATE ITEMVENDA SET '. $update_string .' updateDate="'. date('Y-m-d H:i:s') .'" WHERE id='. $obj->getId() .' AND deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 1){
        $db = $this->getDB()->prepare('SELECT * FROM ITEMVENDA WHERE id = '. $obj->getId() .';');
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

public function delete($id)
{  
    $db = $this->getDB()->prepare('SELECT * FROM ITEMVENDA WHERE  id='. $id .'; UPDATE ITEMVENDA SET deleteDate ="'. date('Y-m-d H:i:s') .'" WHERE id='. $id .' AND deleteDate IS NULL;');
    //$db = $this->getDB()->prepare('SELECT id FROM ITEMVENDA WHERE  id='. $id .'; UPDATE ITEMVENDA SET deleteDate ="'. date('Y-m-d H:i:s') .'" WHERE id='. $id .' AND deleteDate IS NULL; SELECT id;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    //return true; Nao retorna oq deletou
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_id($id)
{
    $db = $this->getDB()->prepare('SELECT * FROM ITEMVENDA WHERE id = '. $id .';');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_all()
{
    $db = $this->getDB()->prepare('SELECT * FROM ITEMVENDA WHERE deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

public function find_itens_venda($id)
{
    //$db = $this->getDB()->prepare('SELECT * FROM ITEMVENDA WHERE VENDA_id = '. $id .' AND deleteDate IS NULL;'); //FALTOU O AND deleteDate IS NULL
    $db = $this->getDB()->prepare('SELECT * FROM ITENSVENDA_VIEW WHERE ITEMVENDA_VENDA_id = '. $id .' AND ITEMVENDA_delete_Date IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}


}