<?php

$codigo = $_POST['cod'];
$resultado = "";
include '../../conection/conection.php';
	$conexion = $db -> prepare("CALL cargarConsulta(?)");
	$conexion -> execute(array($codigo));
	$rows = $conexion -> fetchAll(PDO::FETCH_ASSOC);

		foreach ($rows as $key) {
			
			$resultado = array(

	 		"motivo" => $key['MotivoConsulta'] , 
	 		"examen_fisico" => $key['Descripcion_examen_fisico'],
	 		"diagnostico" => $key['Descripcion_diagnostico'], 
	 		"tratamiento" => $key['Descripcion_tratamiento']);
	 		
		
		}
	 echo json_encode($resultado);
?>