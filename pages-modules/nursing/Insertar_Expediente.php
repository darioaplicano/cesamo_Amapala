<?php
	
	$id = $_POST['id'];
	$resultado = "";
	$arreglo = array();

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
	 		"Lugar" => $key['LugarNacimiento']);


	 }
	 	
	 echo json_encode($resultado);
?>