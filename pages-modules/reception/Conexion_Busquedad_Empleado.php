<?php
	
	$id = $_POST['nombre'];
	$columnas = "";
	$arreglo = array();

	include '../../conection/conection.php';


	$conexion = $db -> prepare("CALL Agenda(?)");
	$conexion -> execute(array($id));
	$rows = $conexion -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $key) {
	 	
	 	
            
            $nombre = $key['P_Nombre']." ".$key['S_Nombre']." ".$key['P_Apellido']." ".$key['S_Apellido'];
            
            $codEmpleado = $key['NumIdentidad'];
            $telefono=$key['Telefono'];
           // $correoElectronico=$key['CorreoElectronico'];
	    $fechaDeNacimiento=$key['FechaNacimiento'];
	    $sexo=$key['Sexo'];
	    $direccion=$key['Direccion'];         

 $columnas = $columnas."<tr><td>".$codEmpleado."</td><td>".$nombre."</td><td>".$telefono."</td><td>".$fechaDeNacimiento."</td><td>".$sexo."</td><td>".$direccion."</td></tr>";
	 }	 	
	 echo $columnas;
?>;
