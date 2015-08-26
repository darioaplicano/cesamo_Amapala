<?php

$id = $_POST['id'];	
$resultado = "";
include '../../conection/conection.php';
	$conexion = $db -> prepare("CALL seleccionarConsultas(?)");
	$conexion -> execute(array($id));
	$rows = $conexion -> fetchAll(PDO::FETCH_ASSOC);

		
			foreach ($rows as $key) {
			
			$resultado = $resultado.'<button type="button" class="list-group-item" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="consultaClick(value)" value='.$key['CodConsulta'].'>'."<b>Codigo de Consulta:</b> ".$key['CodConsulta']."&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<b>Fecha:</b> ".$key['Fecha'].'</button>';
			 
			}
		
		
	echo $resultado;

?>