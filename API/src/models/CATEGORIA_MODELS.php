<?php
	class CATEGORIA_MODELS{

		private $id;
		private $nomeCategoria;


		public function getId(){
			return $this->id;
		}

		public function setId($id){
			if (!is_numeric($id))
	        	throw new InvalIDArgumentException('ID can not be non-numeric');
			$this->id=$id;
		}

		public function getNomeCategoria(){
			return $this->nomeCategoria;
		}

		public function setNomeCategoria($nomeCategoria){
			if (empty($nomeCategoria))
	       		throw new InvalIDArgumentException('nomeCategoria can not be empty');
			$this->nomeCategoria=$nomeCategoria;
		}

}