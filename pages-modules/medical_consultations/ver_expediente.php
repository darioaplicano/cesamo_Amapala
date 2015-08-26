<!DOCTYPE html>
<html>
<head>
	

	<link rel="stylesheet" type="text/css" href="pages-modules/medical_consultations/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="pages-modules/medical_consultations/diseño.css">
	<script type="text/javascript" src="pages-modules/medical_consultations/src.js"></script>
	<script type="text/javascript">

		function consultaClick(a){
			
			var codConsulta = a;

			$.ajax({

                  type: "POST",
                  url: "pages-modules/medical_consultations/cargar_informacion_consulta.php",
                  dataType: "json",
                  cache: "false",
                  data: {"cod" : codConsulta},

                  success: function(data){
                      
                  		$("#motivo").html(data['motivo']);
                  		$("#ef").html(data['examen_fisico']);
                  		$("#tratamiento").html(data['tratamiento']);
                  		$("#diag").html(data['diagnostico']);

                      
                  },
                  error: function (xhRequest, ErrorText, thrownError){
                  alert("a ocurrido un error: "+xhRequest+"  "+ErrorText+"    "+thrownError+"   ");
            

            }

          });
		}

	</script>
	<meta charset="UTF-8">




</head>
<body>
<!--Buscador-->
<div class="row col-md-10">
		
		<div class="row" id="div_buscador_de_expediente">  

                    <div class="row col-md-10">                
                        <label for="buscar">Buscar Expediente:</label>
                    </div>
                
                  <div class="row col-md-10">
                   <div class="input-group">
                        <input type="text" class="form-control" placeholder="Numero de Identidad..." maxlength="13" id="buscadorExpediente3">
               		      	<span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="buscarExpediente3">Buscar</button>
                        </span>
                   </div>
                   </div>
        </div>
<!--Select de Consultas-->
         <div class="row" id="div_select_consultas_expediente" style="margin: 20px">
        		
        		<div class="list-group" id="selectorConsultas">
	  				
	  			</div>

        </div>
</div>

        

          

 <!--Ventana modal-->                                                  

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
         <form class="form-horizontal">


     <!--aqui el  lo que ocupas llenar en todo caso el mi es un formulario -->
    <div class="alert alert-success">
    <div class="form-group">
        <label class="control-label col-xs-3">Motivo de Consulta:</label>
        <div class="col-xs-9">
        	<textarea class="form-control" rows="5" id="motivo" disabled></textarea>
        </div>
    </div> 
    <div class="form-group">
        <label class="control-label col-xs-3">Examen Físico:</label>
        <div class="col-xs-9">
           <textarea class="form-control" rows="5" id="ef" disabled></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Diagnóstico:</label>
        <div class="col-xs-9">
           <textarea class="form-control" rows="5" id="diag" disabled></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Tratamiento:</label>
        <div class="col-xs-9">
            <textarea class="form-control" rows="5" id="tratamiento" disabled></textarea>
        </div>
    </div>
    
      
	</div>
        </form>
    </div>
  </div>
	</div>

                  
       



</div>
<script src="jquery-2.1.4.js"></script>
<script src="bootstrap-modal.js"></script>
</body>
</html>