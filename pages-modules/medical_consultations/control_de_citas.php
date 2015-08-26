<!DOCTYPE html>
<html>
<head>
	<title>Control de Citas</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="pages-modules/medical_consultations/diseño.css">
	<link rel="stylesheet" type="text/css" href="pages-modules/medical_consultations/bootstrap.css">
	
	<script type="text/javascript" src="pages-modules/medical_consultations/jquery-2.1.4.js">
 // $(document).load(){
   //   alert("usuario : "+<?php echo $user;?>);
 //};
  </script>
	<script type="text/javascript" src="pages-modules/medical_consultations/src.js">
  
 </script>
<?php

    
    session_start();
    $codeE = $_SESSION['codEmpleado'];

    echo "<input type='text' value=$codeE  id='codEmp' hidden>";
  ?>
</head>
<body>

<div class="container">
<div class="row" style="margin: 10px;">
	<div class="col-sm-9" style="margin: 10px">   

	 		<ul class="nav nav-tabs">
  			<li role="presentation" class="active" id="buscarCita"><a class="button">Buscar</a></li>
  			<li role="presentation" id="crearCita"><a class="button" >Crear Cita</a></li>
  			<li role="presentation" id="borrarCita"><a class="button"  >Cancelar Cita</a></li>
  			</ul>
	</div>
</div>


<div class="row" id:"citas_area_de_trabajo">

<div class="row col-sm-9" id="busca">

    <div class="input-group" >
    <input type="date" class="form-control" placeholder="Introducir fecha" id="buscar_fecha">
    <span class="input-group-btn">
    <button class="btn btn-default" type="button" id="btn_enviar_fecha">Buscar</button>
    </span>
    </div>
</div>









<div class="row col-sm-9" id="resultadoBusqueda">
<table class="table table-bordered">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Nombre</th>
          <th>Teléfono</th>
        </tr>
      </thead>
     <tbody id="resultado">
      
     
     </tbody>
</table>
</div>


	
	<<div class="row col-sm-9" id="formulario_nueva_cita">

  <div class="form-group row col-sm-8">
    <label for="p_nombre">Primer Nombre</label>
    <input type="text" maxlength="30" class="form-control" id="p_nombre"
           placeholder="Introduzca el Primer Nombre">
  </div>
  <div class="form-group row col-sm-8">
    <label for="s_nombre">Segundo Nombre</label>
    <input type="text" maxlength="30" class="form-control" id="s_nombre"
           placeholder="Introduzca el Segundo Nombre">
  </div>
  <div class="form-group row col-sm-8">
    <label for="p_apellido">Primer Apellido</label>
    <input type="text" maxlength="30" class="form-control" id="p_apellido"
           placeholder="Introduzca el Primer Apellido">
  </div>
  <div class="form-group row col-sm-8">
    <label for="s_apellido">Segundo Apellido</label>
    <input type="text" maxlength="30" class="form-control" id="s_apellido"
           placeholder="Introduzca el Segundo Apellido">
  </div>
  <div class="row form-group col-sm-5">
    <label for="telefono">Teléfono</label>
    <input type="tel" maxlength="8"class="form-control" id="telefono" 
           placeholder="Introduzca el Teléfono">
  </div>
  
  <div class="row col-sm-12">
  <div class="form-group row col-sm-6" >
    <label for="fecha_nueva_cita">Fecha</label>
    <input type="date" class="form-control" placeholder="Introducir fecha" id="fecha_nueva_cita">
  </div>

  <div class="form-group col-sm-2 row">
  <label for="hora_nueva_cita">Hora</label>
  <input type="time" class="form-control" placeholder="Hora" id="hora" max="18:30:00" min="07:00:00" requiered="requiered">
    
  </div>
  </div>
  <div class="row col-sm-12">
  <button type="submit" class="btn btn-default" id="guardarCita">Guardar Cita</button>
  </div>
</div>



</div>

<div class="row" id="cancelarCita"> 

     
     
       <div class="input-group col-sm-5" id="busca2" >
       <input type="date" class="form-control" placeholder="Introducir fecha" id="buscar_fecha2">
        <span class="input-group-btn">
        <button class="btn btn-default" type="button" id="btn_enviar_fecha2">Buscar</button>
        </span>
      </div>
    
     

      <div class="row">
        <div class="col-xs-5 selectContainer" id="cancelar">
            <select class="form-control" name="Citas" id="seleccionarCita">
                
            </select>
            <span class="input-group-btn">
            <button class="btn btn-default" type="button" id="btn_borrar">Borrar</button>
            </span>
      

        </div>
      </div>


</div>

<!--alert-->
<div class="col-md-8" id="alertas">
  
</div>




</div>

</body>
</html>