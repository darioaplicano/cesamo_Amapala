<?php

//cesamo
//empleados 
//CodEmpleado  NumIdentidad   P_Nombre  S_Nombre P_Apellido S_Apellido Telefono CorreoElectronico
//FechaNacimiento  sexo Direccion   cargo 
   class conexion{
   	  function ConsultaEmpleados(){
   	  	$host ="localhost";
   	  	$user = "root";
   	  	$pw   = "";
        $db   ="cesamo";

        mysql_connect($host,$user,$pw)or die("No se puede conectar");
        mysql_select_db($db,$con)or die("No se encontro la base de datos");


   	 }
   }
?>
   
   