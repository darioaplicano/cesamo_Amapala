<!DOCTYPE html>
<html>
<head>
	<title>Control de Empleados</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="pages-modules/reception/diseño.css">
	<link rel="stylesheet" type="text/css" href="pages-modules/reception/bootstrap.css">
	<script type="text/javascript" src="pages-modules/receptoion/modulePages/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="pages-modules/reception/src.js"></script>
        <script src="src.js"></script>
</head>
<body>

<div class="container">
<div class="row " style="margin: 10px;">
	<div class="col-sm-12" style="margin: 10px">   

	 		<ul class="nav nav-tabs">
  			<li role="presentation" class="active" id="buscarEmpleado"><a class="button">Agenda</a></li>
<!--  			<li role="presentation" id="crearCita"><a class="button" >Crear Cita</a></li>
  			<li role="presentation" id="borrarCita"><a class="button"  >Cancelar Cita</a></li>-->
  			</ul>
	</div>
</div>


<div class="row" id:="Empleadp_area_de_trabajo">
    
<div class="row col-sm-9" id="busca">
    <div class="input-group col-sm-10" >
        <input type="text" class="form-control" placeholder="Introducir Nombre empleado" id="buscar_Empleado1">
    <span class="input-group-btn">
    <button class="btn btn-default" type="button" id="btn_enviar_Empleado">Buscar</button>
    </span>
    </div>
</div>
    
    
    
    <div class="container table-responsive" id="resultadoBusqueda1">
           <ul class="col-md-10"></ul>      
                    <div class="row">
                      <div class="col-md-8">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                          <h3 class="panel-title">Empleados:</h3>
                          </div>
                            <table class="table">
                            <div>
                                <thd>
                                 <tr>
                                 <th>Cod Empleado</th>
                                 <th>Nombre</th>
                                 <th>Telefono</th>
                                 <th>Fecha</th>
                                 <th>Sexo</th>
                                 <th>Direccion</th>
                               </tr>
                               </thd>
                                <tbody>
                            </div>
                         <tbody id="resultado">
                         </tbody>
                            </table>
                         </table>
                        </div>
                      </div>       
                     </div>                 
</div>

    
    
 
    
    
    
<div class="row col-sm-9" id="formulario_nueva_cita">

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
  <input type="time" class="form-control" placeholder="Hora" id="hora">
    
  </div>
  </div>
    
  <div class="row col-sm-12">
  <div class="form-group row col-sm-6" >
    <label for="txtCodigoDeMedico">Codigo de Medico</label>
    <input type="number" class="form-control" placeholder="Introducir Codigo Medico" id="txtCodigoDeMedico">
  </div>
  </div> 
  <div class="row col-sm-12">
  <button type="submit" class="btn btn-default" id="guardarCita1">Guardar Cita</button>
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


    
    
    
</div>

</body>
</html>


<!--<!DOCTYPE html>
<html>
<head>
	<title>Control De Empleados</title>
        <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="pages-modules/reception/diseño.css">
	<script type="text/javascript" src="pages-modules/receptoion/modulePages/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="pages-modules/reception/modulePages/src.js"></script>
         <link rel="stylesheet" type="text/css" href=css/bootstrap-theme.min.css>
        <link rel="stylesheet" type="text/css" href=css/bootstrap.css>
        <link rel="stylesheet" type="text/css" href=Styles.css>
        <script language="Javascript" type="text/javascript" src=js/bootstrap.min.js></script>
        <script language="Javascript" type="text/javascript" src="js/Ajax.js"></script>

</head>
<body>

<div class="container">
<div style="margin: 10px;">
<div class="row" style="margin: 10px;">
	<div class="col-sm-12" style="margin: 10px">   

	 		<ul class="nav nav-tabs">
  			<li role="presentation" class="active" id="btnBuscarEmpleadobtn"><a class="button">Buscar Por Nombre</a></li>
  			<li role="presentation" id="btnBuscarEmpleadobtn"><a class="button" >Buscar Por Identidad</a></li>
  			<li role="presentation" id="btnBuscarEmpleadobtn"><a class="button"  >Buscar Por Numero de Empleado</a></li>
  			</ul>
	</div>
</div>
</div>

    
    
  
<div class="row" id:="Empleado_area_de_trabajo">

<div class="row col-sm-9" id="busca">

    <div class="input-group" >
    <input type="txt" class="form-control" placeholder="Ingrese el Nombre del empleado" id="buscar_PorNombre">
    <span class="input-group-btn">
    <button class="btn btn-default" type="button" id="btn_enviar_PorNombre">Buscar</button>
    </span>
    </div>
</div>

<div class="row col-sm-9" id="resultadoBusqueda">
<table class="table table-bordered">
      <thead>
        <tr>
          <th>Codigo Empleado</th>
          <th>Numero De IOdentidad </th>
          <th>Primer Nombre</th>
          <th>Segundo Nombre</th>
          <th>Primer Apellido</th>
          <th>Telefono Correo</th>
          <th>Fecha De nacimiento</th>
          <th>Genero</th>
          <th>Direccion</th>
          <th>cargo</th>
        </tr>
      </thead>
     <tbody id="resultado">
      
     
     </tbody>
</table>
</div>
</div>

</body>
</html>-->