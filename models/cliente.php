<?php 

class Cliente {


	public $id;
	public $nome;
	public $endereco;
	public $numero;
	public $cep;
	public $telefone;


	public function __construct($id,$nome,$endereço,$numero,$cep,$telefone){

		$this->id = $id;
		$this->nome = $nome;
		$this->endereço = $endereço;
		$this->numero = $numero;
		$this->cep = $cep;
		$this->telefone = $telefone;

	}

}


 ?>