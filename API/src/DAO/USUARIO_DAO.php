<?php

class USUARIO_DAO extends MASTER_DAO{

	public function insert($obj)
	{
		$db = $this->getDB()->prepare('INSERT INTO USUARIO (usuario, senha, email, PESSOA_id) VALUES ("'.$obj->getUsuario().'","'.$obj->getSenha().'","'.$obj->getEmail().'","'.$obj->getPESSOA_id().'");');
		$db->execute();
		if($db->rowCount() == 1){
			$db = $this->getDB()->prepare('SELECT * FROM USUARIO WHERE id = LAST_INSERT_ID();');
			$db->execute();
			return $db->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return false;
		}
	}
	public function update($obj)
	{
		$update_string = '';
		if($obj->getUsuario() != '') $update_string .= 'usuario="'. $obj->getUsuario() .'", ';
		if($obj->getSenha() != '') $update_string .= 'senha="'. $obj->getSenha() .'", ';
		if($obj->getEmail() != '') $update_string .= 'email="'. $obj->getEmail() .'", ';
		if($obj->getPESSOA_id() != '') $update_string .= 'PESSOA_id="'. $obj->getPESSOA_id() .'", ';
		

		$db = $this->getDB()->prepare('UPDATE USUARIO SET '. $update_string .' updateDate="'. date('Y-m-d H:i:s') .'" WHERE id='. $obj->getId() .' AND deleteDate IS NULL;');
		$db->execute();
		if($db->rowCount() == 1){
			$db = $this->getDB()->prepare('SELECT * FROM USUARIO WHERE id = '. $obj->getId() .';');
			$db->execute();
			return $db->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return false;
		}
	}

	public function delete($id)
	{  
		$db = $this->getDB()->prepare('UPDATE USUARIO SET deleteDate ="'. date('Y-m-d H:i:s') .'" WHERE id='. $id .' AND deleteDate IS NULL;');
		$db->execute();
		if($db->rowCount() == 0) return false;
		return true;
	}

	public function find_id($id)
	{
		$db = $this->getDB()->prepare('SELECT * FROM USUARIO WHERE id = '. $id .';');
		$db->execute();
		if($db->rowCount() == 0) return false;
		return $db->fetchAll(PDO::FETCH_ASSOC);
	}

public function find_all()
{
    $db = $this->getDB()->prepare('SELECT * FROM USUARIO WHERE deleteDate IS NULL;');
    $db->execute();
    if($db->rowCount() == 0) return false;
    return $db->fetchAll(PDO::FETCH_ASSOC);
}

}
