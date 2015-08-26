<?php

//se recibe la lista de medicamentos

$listaDeMedicamentos = json_decode($_POST['medicamentos']);
$codigoReceta;


//Primero crear la receta medica

	include '../../conection/conection.php';

	$conexion = $db -> prepare("CALL crearReceta(?)");
	$conexion -> execute(array($_POST['codigoConsulta']));
	$conexion -> fetchAll(PDO::FETCH_ASSOC);

//Segundo Obtener el codigo de receta que se acaba de crear


	include '../../conection/conection.php';

	$conexion2 = $db -> prepare("CALL ultimaReceta(?)");
	$conexion2 -> execute(array($_POST['codigoConsulta']));
	$rows = $conexion2 -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $key) {
		
		$codigoReceta = $key['CodReceta'];

	}


//Tercero por cada medicamento en la lista, registrarlo en la receta.

  include '../../conection/conection.php';

	foreach ($listaDeMedicamentos as $key) {
		
	$conexion3 = $db -> prepare("CALL medicamento_receta(?,?,?,?)");
	$conexion3 -> execute(array($key->codigo,$codigoReceta,$key->cantidad,$key->tratamiento));
	$conexion3 -> fetchAll(PDO::FETCH_ASSOC);

	}

//finalizar
	echo $codigoReceta;

?>