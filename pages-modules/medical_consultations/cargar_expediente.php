<?php
	
	$id = $_POST['id'];
	$codConsulta;
	$resultado = "";
	$resultado2= "";
	$arreglo = array();


	//Busca el codigo de la ultima consulta almacenada para este expediente
include '../../conection/conection.php';

    $conexion2 = $db -> prepare("CALL seleccionarUltimaConsulta(?)");
	$conexion2 -> execute(array($id));
	$rows2 = $conexion2 -> fetchAll(PDO::FETCH_ASSOC);	 	
	foreach ($rows2 as $key) {
		
		$codConsulta = $key['CodConsulta'];

	}

	

//Busca y trae de la base de datos la informacion del expediente
	include '../../conection/conection.php';
	$conexion = $db -> prepare("CALL cargarExpediente(?)");
	$conexion -> execute(array($id));
	$rows = $conexion -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $key) {
	 	
	 	$nombre = $key['P_Nombre']." ".$key['S_Nombre']." ".$key['P_Apellido']." ".$key['S_Apellido'];

	 
	 	$resultado = array(

	 		"iden" => $key['CodExpediente'] , 
	 		"nombre" => $nombre,
	 		"fecha" => $key['FechaNacimiento'], 
	 		"sexo" => $key['Sexo'],
	 		"Lugar" => $key['LugarNacimiento'],
	 		"consulta" => $codConsulta);


	 }


 	
	 echo json_encode($resultado);
?>