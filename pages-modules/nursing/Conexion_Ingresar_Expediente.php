<?php
	
	include '../../conection/conection.php';

	$conexionCrearExpediente = $db -> prepare("CALL AgregarExpediente(?,?,?,?,?,?,?,?)");
	$conexionCrearExpediente -> execute(array($_POST['CodExpediente'],$_POST['P_Nombre'],$_POST['S_Nombre'],$_POST['P_Apellido'],$_POST['S_Apellido'],$_POST['FechaNacimiento'],$_POST['Sexo'],$_POST['LugarNacimiento']));
	
	echo "hecho";

?>);

