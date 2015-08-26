<?php
	
	$fecha = $_POST['fe'];
        $codMedico = $_POST['codMedico'];  
	include '../../conection/conection.php';
	$resultado = "";
	$conexion = $db -> prepare("CALL CitaMedico(?,?)");
	$conexion -> execute(array($fecha,$codMedico));
	$rows = $conexion -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $key) {
	
		$resultado = $resultado."<option value=".$key['CodCita'].">".$key['Hora']." ".$key['P_Nombre_Paciente']." ".$key['P_Apellido_Paciente']."</option>";
	}
		echo $resultado;

?>