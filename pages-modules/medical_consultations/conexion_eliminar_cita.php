<?php

	$idCita = $_POST['id'];
	
	include '../../conection/conection.php';

	$conexion = $db -> prepare("CALL cancelarCita(?)");
	$conexion -> execute(array($idCita));

	echo "Termino";
	
?>