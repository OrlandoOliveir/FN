<?php 
	
	class Produto{

		public $id;
		public $nome;
		public $valor_base; 
		public $qtd;

		public function __construct($id,$nome,$valor_base,$qtd){

		$this->id = $id;
		$this->nome = $nome;
		$this->valor_base = $valor_base;
		$this->qtd = $qtd;

		}

	}

 ?>