<?php
 
        
    $codigoMedico = "";

    include '../../conection/conection.php';
    $conexion1 = $db -> prepare("CALL obtenerCodigoMedico(?)");
    $conexion1 -> execute(array($_POST['codEmpleado']));
    $row1 = $conexion1 -> fetchAll(PDO::FETCH_ASSOC);

    foreach ($row1 as $key) {
        
        $codigoMedico = $key['CodMedico'];

    }

	$fecha = $_POST['fe'];
	include '../../conection/conection.php';
	$filas = "";
	
	$conexion = $db -> prepare("CALL dateCitas(?,?)");
	$conexion -> execute(array($fecha,$codigoMedico));
	$rows = $conexion -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $key) {
		
		$Fe = $key['Fecha'];
		$hora = $key['Hora'];
		$paciente = $key['P_Nombre_Paciente']." ".$key['S_Nombre_Paciente']." ".$key['P_Apellido_Paciente']." ".$key['S_Apellido_Paciente'];
		$telefono = $key['Telefono'];
		$medico = $key['CodMedico'];


	$filas = $filas."<tr><td>".$Fe."</td><td>".$hora."</td><td>".$paciente."</td><td>".$telefono."</td></tr> ";

	}

	
	echo $filas;


   /*	$edwin = $db -> prepare("CALL dateCitas(?)");
    $fecha = date('2015/08/04');
    $edwin -> execute(array($fecha));
    $rows = $edwin->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row){
            $Telefono  =   $row['Telefono'];
        }
        echo $Telefono;
        echo $_SESSION['codEmpleado'];
    include '../../conection/conection.php';
    $douglas = $db -> prepare("selectMedicos()");
    $rows = $douglas->fetchAll(PDO::FETCH_ASSOC);


        echo
<<<html
    <select>
html;
        foreach ($rows as $row){
            $codigo         =   $row['codigo'];
            $Especialidad = $row['Especialidad'];
            echo 
            <<<html
            <option data-id=$codigo>$Especialidad</option>
html;
        }
        echo <<<html
    </select>
html;*/
	?>