<?php
	class ITEMVENDA_MODELS{

		private $id;
		private $qtd;
		private $valor;
		private $pVenda;
		private $VENDA_id;
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

		public function getPVenda(){
			return $this->pVenda;
		}

		public function setPVenda($pVenda){
			if (!is_numeric($pVenda))
	        	throw new InvalIDArgumentException('ID can not be non-numeric');
			$this->pVenda=$pVenda;
		}

		public function getVENDA_id(){
			return $this->VENDA_id;
		}

		public function setVENDA_id($VENDA_id){
			if (!is_numeric($VENDA_id))
	        	throw new InvalIDArgumentException('VENDA_id can not be non-numeric');
			$this->VENDA_id=$VENDA_id;
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