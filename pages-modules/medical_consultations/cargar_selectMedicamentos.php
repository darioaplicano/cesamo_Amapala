<?php
	
	$resultado = "";
	include '../../conection/conection.php';

	$conexion = $db -> prepare("CALL seleccionarMedicamentos()");
	$conexion -> execute();
	$rows = $conexion -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $key) {
	 	
	 	$resultado = $resultado."<option value=".$key['CodMedicamento'].">".$key['NombreMedicamento']."</option>"; 
	 }

	 echo $resultado;

?>