<?php

	$idCita = $_POST['id'];
        $codMedico =$POST['codMedico'];
	
	include '../../conection/conection.php';

	$conexion = $db -> prepare("CALL CancelarCitaCodMedico(?,?)");
	$conexion -> execute(array($idCita,$codMedico));

	echo "Termino";
	
?>