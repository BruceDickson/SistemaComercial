<?php
	class USUARIO_MODELS{

		private $id;
		private $usuario;
		private $senha;
		private $email;
		private $PESSOA_id;


		public function getId(){
			return $this->id;
		}

		public function setId($id){
			if (!is_numeric($id))
	        	throw new InvalIDArgumentException('ID can not be non-numeric');
			$this->id=$id;
		}

		public function getUsuario(){
			return $this->usuario;
		}

		public function setUsuario($usuario){
			if (empty($usuario))
	        	throw new InvalIDArgumentException('usuario can not be empty');
			$this->usuario=$usuario;
		}

		public function getSenha(){
			return $this->senha;
		}

		public function setSenha($senha){
			if (empty($senha))
	        	throw new InvalIDArgumentException('senha can not be empty');
			$this->senha=$senha;
		}

		public function getEmail(){
			return $this->email;
		}

		public function setEmail($email){
			if (empty($email))
	        	throw new InvalIDArgumentException('email can not be empty');
			$this->email=$email;
		}

		public function getPESSOA_id(){
			return $this->PESSOA_id;
		}

		public function setPESSOA_id($PESSOA_id){
			if (!is_numeric($PESSOA_id))
	        	throw new InvalIDArgumentException('PESSOA_id can not be non-numeric');
			$this->PESSOA_id=$PESSOA_id;
		}

	}