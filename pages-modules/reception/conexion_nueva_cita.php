<?php
	
	include '../../conection/conection.php';

	$conexionNuevaCita = $db -> prepare("CALL nuevaCita(?,?,?,?,?,?,?,?)");
	$conexionNuevaCita -> execute(array($_POST['fecha'],$_POST['hora'],$_POST['p_nombre'],$_POST['s_nombre'],$_POST['p_apellido'],$_POST['s_apellido'],$_POST['telefono'],$_POST['codMedico']));
	
	echo "hecho";

?>