<?php

	class Tratamiento{
	 var $nombre;
	 var $cantidad;
	 var $tratamiento;

	 function __construct($n,$c,$t){

	 	    $this->nombre=$n;
			$this->cantidad=$c;
			$this->tratamiento=$t;
	 }

	 public function getNombreMedicamento(){
			return $this->nombre;

		}

		public function setNombreMedicamento($n){
			$this->nombre=$n;
		}


		public function getCantidad(){
			return $this->cantidad;

		}

		public function setCantidad($c){
			$this->cantidad=$c;
		}

		public function getTratamiento(){
			return $this->tratamiento;

		}

		public function setTratamiento($t){
			$this->tratamiento=$t;
		}

	}
	


?>