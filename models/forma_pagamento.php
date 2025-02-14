<?php 
	

	class pagamento{

		public $id;
		public $desc;
		public $qtd;
		public $tipo;

		public function __construct($id,$desc,$qtd,$tipo){

			$this->id = $id;
			$this->desc = $desc;
			$this->qtd = $qtd;
			$this->tipo = $tipo;

		}

	}

 ?>