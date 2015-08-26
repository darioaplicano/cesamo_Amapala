<?php
	
	$id = $_POST['id'];
	$resultado = "";
	$preclinica = "";
	$arreglo = array();

include '../../conection/conection.php';
	$conexion2 = $db -> prepare("CALL informePreclinica(?)");
	$conexion2 -> execute(array($id));
	$rows2 = $conexion2 -> fetchAll(PDO::FETCH_ASSOC);

		foreach ($rows2 as $key) {
			
			$preclinica = $preclinica."<tr><td>".$key['CodPreclinica']."</td><td>".$key['Fecha']."</td><td>".$key['Peso']."</td><td>".$key['Altura']."</td><td>".$key['Presion']."</td><td>".$key['Temperatura']."</td></tr>"; 

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
	 		"preclinica" => $preclinica);


	 }


 	
	 echo json_encode($resultado);
?>