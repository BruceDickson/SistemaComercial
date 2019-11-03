<?php
	class ITEMCOMPRA_MODELS{

		private $id;
		private $qtd;
		private $valor;
		private $pCompra;
		private $COMPRA_id;
		private $PRODUTO_id;
		private $UNIDADE_id;


		public function getId(){
			return $this->id;
		}

		public function setId($id){
			if (!is_numeric($id))
	        	throw new InvalIDArgumentException('ID can not be non-numeric');
			$this->id=$id;
		}

		public function getQtd(){
			return $this->qtd;
		}

		public function setQtd($qtd){
			if (!is_numeric($qtd))
	        	throw new InvalIDArgumentException('qtd can not be non-numeric');
			$this->qtd=$qtd;
		}

		public function getValor(){
			return $this->valor;
		}

		public function setValor($valor){
			if (!is_numeric($valor))
	        	throw new InvalIDArgumentException('valor can not be non-numeric');
			$this->valor=$valor;
		}

		public function getPCompra(){
			return $this->pCompra;
		}

		public function setPCompra($pCompra){
			if (!is_numeric($pCompra))
	        	throw new InvalIDArgumentException('ID can not be non-numeric');
			$this->pCompra=$pCompra;
		}

		public function getCOMPRA_id(){
			return $this->COMPRA_id;
		}

		public function setCOMPRA_id($COMPRA_id){
			if (!is_numeric($COMPRA_id))
	        	throw new InvalIDArgumentException('COMPRA_id can not be non-numeric');
			$this->COMPRA_id=$COMPRA_id;
		}

		public function getPRODUTO_id(){
			return $this->PRODUTO_id;
		}

		public function setPRODUTO_id($PRODUTO_id){
			if (!is_numeric($PRODUTO_id))
	        	throw new InvalIDArgumentException('PRODUTO_id can not be non-numeric');
			$this->PRODUTO_id=$PRODUTO_id;
		}

		public function getUNIDADE_id(){
			return $this->UNIDADE_id;
		}

		public function setUNIDADE_id($UNIDADE_id){
			if (!is_numeric($UNIDADE_id))
	        	throw new InvalIDArgumentException('UNIDADE_id can not be non-numeric');
			$this->UNIDADE_id=$UNIDADE_id;
		}

	}