<?php
	class UNIDADE_MODELS{

		private $id;
		private $unidade;
		private $qtd;


		public function getId(){
			return $this->id;
		}

		public function setId($id){
			if (!is_numeric($id))
	        	throw new InvalIDArgumentException('id can not be non-numeric');
			$this->id=$id;
		}

		public function getUnidade(){
			return $this->unidade;
		}

		public function setUnidade($unidade){
			if (empty($unidade))
	       		throw new InvalIDArgumentException('unidade can not be empty');
			$this->unidade=$unidade;
		}
		
		public function getQtd(){
			return $this->qtd;
		}

		public function setQtd($qtd){
			if (!is_numeric($qtd))
	        	throw new InvalIDArgumentException('qtd can not be non-numeric');
			$this->qtd=$qtd;
		}

	}