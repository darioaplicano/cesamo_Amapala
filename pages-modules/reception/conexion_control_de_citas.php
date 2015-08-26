<?php
 
	$fecha = $_POST['fe'];
        $codigo = $_POST['codigo'];
	include '../../conection/conection.php';
	$filas = "";
	
	$conexion = $db -> prepare("CALL CitaMedico (?,?)");
	$conexion -> execute(array($fecha,$codigo));
	$rows = $conexion -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $key) {
		
		$Fe = $key['Fecha'];
		$hora = $key['Hora'];
		$paciente = $key['P_Nombre_Paciente']." ".$key['S_Nombre_Paciente']." ".$key['P_Apellido_Paciente']." ".$key['S_Apellido_Paciente'];
		$telefono = $key['Telefono'];
		$medico = $key['CodMedico'];


	$filas = $filas."<tr><td>".$Fe."</td><td>".$hora."</td><td>".$paciente."</td><td>".$telefono."</td><td>".$medico."</td></tr> ";

	}

	
	echo $filas;
	?>;