<?php
	
	include '../../conection/conection.php';

	$conexionNuevaPreclinica = $db -> prepare("CALL AgregarPreclinica(?,?,?,?,?,?,?)");
	$conexionNuevaPreclinica -> execute(array($_POST['Fecha'],$_POST['Peso'],$_POST['Presion'],$_POST['Temperatura'],$_POST['Altura'],$_POST['CodEmpleado'],$_POST['CodExpediente ']));
	                                                                                                       
	echo "hecho";

?>