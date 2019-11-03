<?php

	class ENDERECO_MODELS{
		private $id;
		private $cep;
		private $numero;
		private $rua;
		private $bairro;
		private $cidade;
		private $uf;

		public function getId()
	    {
	        return $this->id;
	    }

	    public function setId($id)
	    {
	        if (!is_numeric($id))
	            throw new InvalIDArgumentException('ID can not be non-numeric');

	        $this->id = $id;
   		}

   		public function getCep()
	    {
	        return $this->cep;
	    }

	    public function setCep($cep)
	    {
	        
	        $this->cep = $cep;
   		}

   		public function getNumero()
	    {
	        return $this->numero;
	    }

	    public function setNumero($numero)
	    {	     
	        $this->numero = $numero;
   		}
   		public function getRua()
	    {
	        return $this->rua;
	    }

	    public function setRua($rua)
	    {
	        if (empty($rua))
	            throw new InvalIDArgumentException('rua can not be empty');

	        $this->rua = $rua;
   		}
   		public function getBairro()
	    {
	        return $this->bairro;
	    }

	    public function setBairro($bairro)
	    {
	        if (empty($bairro))
	            throw new InvalIDArgumentException('bairro can not be empty');

	        $this->bairro = $bairro;
   		}

   		public function getCidade()
	    {
	        return $this->cidade;
	    }

	    public function setCidade($cidade)
	    {
	        if (empty($cidade))
	            throw new InvalIDArgumentException('cidade can not be empty');

	        $this->cidade = $cidade;
   		}

   		public function getUf()
	    {
	        return $this->uf;
	    }

	    public function setUf($uf)
	    {
	        if (empty($uf))
	            throw new InvalIDArgumentException('uf can not be empty');

	        $this->uf = $uf;
   		}



	}