<?php
	class VENDA_MODELS{

		private $id;
		private $valor;
		private $date;
		private $EMPRESA_id;
		private $USUARIO_id;


		public function getId(){
			return $this->id;
		}

		public function setId($id){
			if (!is_numeric($id))
	        	throw new InvalIDArgumentException('ID can not be non-numeric');			
			$this->id=$id;
		}

		public function getValor(){
			return $this->valor;
		}

		public function setValor($valor){
			if (!is_numeric($valor))
	        	throw new InvalIDArgumentException('valor can not be non-numeric');
			$this->valor=$valor;
		}

		public function getDate(){
			return $this->date;
		}

		public function setDate($date){		
			$this->date=$date;
		}

		public function getEMPRESA_id(){
			return $this->EMPRESA_id;
		}

		public function setEMPRESA_id($EMPRESA_id){
			if (!is_numeric($EMPRESA_id))
	        	throw new InvalIDArgumentException('EMPRESA_id can not be non-numeric');
			$this->EMPRESA_id=$EMPRESA_id;
		}

		public function getUSUARIO_id(){
			return $this->USUARIO_id;
		}

		public function setUSUARIO_id($USUARIO_id){
			if (!is_numeric($USUARIO_id))
	        	throw new InvalIDArgumentException('USUARIO_id can not be non-numeric');
			$this->USUARIO_id=$USUARIO_id;
		}

	}