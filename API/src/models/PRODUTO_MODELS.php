<?php
	class PRODUTO_MODELS{

		private $id;
		private $nome;
		private $qtd;
		private $precoVenda;
		private $precoCompra;
                private $cx;
		private $CATEGORIA_id;


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

		public function getQtd(){
			return $this->qtd;
		}

		public function setQtd($qtd){
			$this->qtd=$qtd;
		}

		public function getPrecoVenda(){
			return $this->precoVenda;
		}

		public function setPrecoVenda($precoVenda){			
			$this->precoVenda=$precoVenda;
		}

		public function getPrecoCompra(){
			return $this->precoCompra;
		}

		public function setPrecoCompra($precoCompra){
			$this->precoCompra=$precoCompra;
		}

                public function getCx(){
			return $this->cx;
		}

		public function setCx($cx){
			if (!is_numeric($cx))
	        	throw new InvalIDArgumentException('cx can not be non-numeric');
			$this->cx=$cx;
		}

		public function getCATEGORIA_id(){
			return $this->CATEGORIA_id;
		}

		public function setCATEGORIA_id($CATEGORIA_id){
			if (!is_numeric($CATEGORIA_id))
	        	throw new InvalIDArgumentException('CATEGORIA_id can not be non-numeric');
			$this->CATEGORIA_id=$CATEGORIA_id;
		}

	}