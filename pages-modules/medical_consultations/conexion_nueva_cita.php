<?php
		
		$codigoMedico = "";

	include '../../conection/conection.php';
	$conexion1 = $db -> prepare("CALL obtenerCodigoMedico(?)");
	$conexion1 -> execute(array($_POST['codEmpleado']));
	$row1 = $conexion1 -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($row1 as $key) {
		
		$codigoMedico = $key['CodMedico'];

	}


	include '../../conection/conection.php';

	$conexionNuevaCita = $db -> prepare("CALL nuevaCita(?,?,?,?,?,?,?,?)");
	$conexionNuevaCita -> execute(array($_POST['fecha'],$_POST['hora'],$_POST['p_nombre'],$_POST['s_nombre'],$_POST['p_apellido'],$_POST['s_apellido'],$_POST['telefono'],$codigoMedico));
	$conexionNuevaCita -> fetchAll(PDO::FETCH_ASSOC);
	echo "hecho";

?>