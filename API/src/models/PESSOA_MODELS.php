<?php 

class PESSOA_MODELS{

	private $id;
	private $nome;
	private $cpf;
	private $rg;
	private $sexo;
	private $dataNascimento;
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

	public function getCpf(){
		return $this->cpf;
	}

	public function setCpf($cpf){
		if (empty($cpf))
	        throw new InvalIDArgumentException('cpf can not be empty');
		$this->cpf=$cpf;
	}

	public function getRg(){
		return $this->rg;
	}

	public function setRg($rg){
		if (empty($rg))
	        throw new InvalIDArgumentException('rg can not be empty');
		$this->rg=$rg;
	}

	public function getSexo(){		
		return $this->sexo;
	}

	public function setSexo($sexo){
		if (!is_numeric($sexo))
	        throw new InvalIDArgumentException('sexo can not be non-numeric');
		$this->sexo=$sexo;
	}

	public function getDataNascimento(){
		return $this->dataNascimento;
	}

	public function setDataNascimento($dataNascimento){
		$this->dataNascimento=$dataNascimento;
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