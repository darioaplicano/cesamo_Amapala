<?php
	
	$fecha = $_POST['fe'];
	$codigoMedico = "";

	include '../../conection/conection.php';
	$conexion1 = $db -> prepare("CALL obtenerCodigoMedico(?)");
	$conexion1 -> execute(array($_POST['codigoEmp']));
	$row1 = $conexion1 -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($row1 as $key) {
		
		$codigoMedico = $key['CodMedico'];

	}

	include '../../conection/conection.php';
	$resultado = "";

	$conexion = $db -> prepare("CALL dateCitas(?,?)");
	$conexion -> execute(array($fecha,$codigoMedico));
	$rows = $conexion -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $key) {
	
		$resultado = $resultado."<option value=".$key['CodCita'].">".$key['Hora']." ".$key['P_Nombre_Paciente']." ".$key['P_Apellido_Paciente']."</option>";
	
	}

		echo $resultado;

?>