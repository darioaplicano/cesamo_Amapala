<?php 
	
	$codigoMedico ="";
	//obtener codigo del medico
	include '../../conection/conection.php';
	$conexion1 = $db -> prepare("CALL obtenerCodigoMedico(?)");
	$conexion1 -> execute(array($_POST['codEmpleado']));
	$row1 = $conexion1 -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($row1 as $key) {
		
		$codigoMedico = $key['CodMedico'];

	}

	include '../../conection/conection.php';


	//subir la consulta despues de obtener el codigo del medico
	
	$conexion = $db -> prepare("CALL crearConsulta(?,?,?,?,?,?)");
	$conexion -> execute(array($_POST['motivo'],$_POST['examenFisico'],$_POST['diagnostico'],$_POST['tratamiento'],$codigoMedico,$_POST['expediente'],));
	$conexion -> fetchAll(PDO::FETCH_ASSOC);

	echo "salio";

?>