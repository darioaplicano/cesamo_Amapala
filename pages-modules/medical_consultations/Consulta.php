<!DOCTYPE html>
<html>
<head>
	<title>Consulta</title>
	<link rel="stylesheet" type="text/css" href="pages-modules/medical_consultations/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="pages-modules/medical_consultations/diseño.css">
	<script type="text/javascript" src="pages-modules/medical_consultations/src.js">
   
  </script>
	<?php
    session_start();
    $codeE = $_SESSION['codEmpleado'];

    echo "<input type='text' value=$codeE  id='codE' hidden>";
  ?>

	
	
	<meta charset="UTF-8">

</head>

<body>

	
	<div class="container">

	 	<div class="col-md-10">   

	 		<ul class="nav nav-tabs">
  			<li role="presentation" class="active" id="opcion1"><a id="menu_seleccionar_expediente" class="button">Seleccionar Expediente</a></li>
  			<li role="presentation" id="opcion2" ><a class="button" id="menu_preclinica">Preclínica</a></li>
  			<li role="presentation" id="opcion3" ><a id="menu_motivo_de_consulta" class="button">Motivo de Consulta</a></li>
  			<li role="presentation" id="opcion4" ><a id="menu_examen_fisico" class="button">Examen Físico</a></li>
  			<li role="presentation" id="opcion5" ><a id="menu_diagnostico" class="button">Diagnóstico</a></li>
  			<li role="presentation" id="opcion6" ><a id="menu_tratamiento" class="button">Tratamiento</a></li>
  			<li role="presentation" id="opcion8" ><a id="menu_finalizar" class="button">Finalizar</a></li>
		</ul>
		</div>


    <div class="row col-lg-11">
		<div class="col-md-10" id="selecExpediente" >   

                <div class="row" id="divBuscadorExpediente">  

                    <div class="row col-md-10">                
                        <label for="buscar">Buscar Expediente:</label>
                    </div>
                
                  <div class="row col-md-10">
                   <div class="input-group">
                        <input type="text" class="form-control" placeholder="Numero de Identidad..." id="numero_de_identidad" maxlength="13">
               		      <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="boton_buscar_expediente">Buscar</button>
                        </span>
                   </div>
                   </div>
                </div>

                
    </div>

    <div class="row" id="expediente" style="margin: 20px">
                   
                <div class="row">
                      <div class="col-md-6">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                          <h3 class="panel-title">Expediente:</h3>
                          </div>
                          <div class="panel-body" id="info_expediente">
                          </div>
                        </div>
                      </div>
                   
                          
                
                </div>
    </div>

    </div> 
        <div class="row">
        <div class="col-lg-9" id="tablaPreclinica">
          
          <table class="table table-hover" id="examenesPreclinica">
               <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha</th> 
                  <th>Peso</th>
                  <th>Altura</th>
                  <th>Presion</th>
                  <th>Temperatura</th>
               </tr>
              </thead>

            <tbody id="resultado_preclinica">
             
          
            </tbody>
        </table>
            

        </div>
        </div>

        <div class="row">
        <div class="col-lg-9" id="mot_consulta">
        		
        		<div class="form-group">
 				<label for="buscar">Motivo de Consulta:</label>
 				<textarea class="form-control" rows="5" id="motivo_de_consulta"></textarea>
				</div>
  		</div>
  		</div>


  		<div class="row">
  			 <div class="col-lg-9 trabajo" id="examen_medico">
  			 	<div class="form-group">
 				<label for="buscar">Examen Físico:</label>
 				<textarea class="form-control" rows="5" id="efisico"></textarea>
				</div>
  			</div>
  		</div>


  		<div class="row">
  			 <div class="col-lg-9 trabajo" id="diagnostico">
  			 	<div class="form-group">
 				<label for="buscar">Diagnóstico:</label>
 				<textarea class="form-control" rows="5" id="txtDiagnostico"></textarea>
				</div>
  			</div>
  		</div>

  		<div class="row">
  			 <div class="col-lg-9 trabajo" id="tratamiento">
  			 	<div class="form-group">
 				<label for="buscar">Tratamiento:</label>
 				<textarea class="form-control" rows="5" id="txtTratamiento"></textarea>
				</div>
  			</div>
  		</div>

  		
      <div class="row" id="enviarConsulta">
        <button type="button" class="btn btn-success" id="enviar">Guardar Consulta</button>
      </div>

</div>
</div>

</body>
</html>