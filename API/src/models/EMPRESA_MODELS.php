<?php
	class EMPRESA_MODELS{

		private $id;
		private $nome;
		private $cnpj;
		private $telefone;
		private $ENDERECO_id;


		public function getId(){
			return $this->id;
		}

		public function setId($id){
			if (!is_numeric($id))
	        	throw new InvalIDArgumentException('ID can not be non-numeric');
			$this->id=$id;
		}

		public function getNome(){
			return $this->nome;
		}

		public function setNome($nome){
			if (empty($nome))
	       		throw new InvalIDArgumentException('nome can not be empty');
			$this->nome=$nome;
		}

		public function getCnpj(){
			return $this->cnpj;
		}

		public function setCnpj($cnpj){
			$this->cnpj=$cnpj;
		}

		public function getTelefone(){
			return $this->telefone;
		}

		public function setTelefone($telefone){
			$this->telefone=$telefone;
		}

		public function getENDERECO_id(){
			return $this->ENDERECO_id;
		}

		public function setENDERECO_id($ENDERECO_id){
			if (!is_numeric($ENDERECO_id))
	        	throw new InvalIDArgumentException('ENDERECO_id can not be non-numeric');
			$this->ENDERECO_id=$ENDERECO_id;
		}

	}