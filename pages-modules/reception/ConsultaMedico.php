<?php

	include '../../conection/conection.php';
	$filas = "";
	
	$conexion = $db -> prepare("CALL ConsultaMedico()");
	$conexion -> execute(array());
	$rows = $conexion -> fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $key) {
		
//		$CodMedi = $key['CodMedico'];
//		$medico = $key['P_Nombre']." ".$key['S_Nombre']." ".$key['P_Apellido']." ".$key['S_Apellido'];
                $filas = $filas."<option value=".$key['CodMedico'].">".$key['P_Nombre']." ".$key['S_Nombre']." ".$key['P_Apellido']." ".$key['S_Apellido']."</option>";

      
	

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