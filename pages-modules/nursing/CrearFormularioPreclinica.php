<!DOCTYPE html>
<html>
<head>
	<title>Consulta</title>
	<link rel="stylesheet" type="text/css" href="pages-modules/medical_consultations/diseño.css">
	<link rel="stylesheet" type="text/css" href="pages-modules/medical_consultations/bootstrap.css">
        <script type="text/javascript" src="otro.js"></script>
	<script type="text/javascript" src="pages-modules/medical_consultations/jquery-2.1.4.js"></script>
	  <link rel="stylesheet" type="text/css" href=css/bootstrap-theme.min.css>
        <link rel="stylesheet" type="text/css" href=css/bootstrap.css>
        <link rel="stylesheet" type="text/css" href=Styles.css>
        <script language="Javascript" type="text/javascript" src=js/bootstrap.min.js></script>
        <script language="Javascript" type="text/javascript" src="js/Ajax.js"></script>
	<script type="text/javascript">
        
    
    
    //       script Se crea la preclinica 
       $("#btnGuardarPreclinica").click(function(){
   
        
    var  Fecha = document.getElementById("txtFecha").value;
    var  Peso = document.getElementById("txtPeso").value;
    var  Presion = document.getElementById("txtPresion").value;
    var  Temperatura = document.getElementById("txtTemperatura").value;
    var  Altura =  document.getElementById("txtAltura").value;
    var  CodEmpleado  = document.getElementById("textCodEmpleado").value;
    var  CodExpediente  = document.getElementById("txtCodExpediente").value;
    
    if(fecha==""){alert("Ingresar la fecha en que se registra la preclinica");}
    else{
        if(peso==""){alert("ingrese el peso del pacinete");}
        else{
           if(presion==""){alert("ingrese la presion del paciente")}
           else{
               if(Temperatura==""){alert("ingrese la temperatura del paciente");}
               else{
                   if(Altura==""){alert("ingrese la altura del paciente");}
                   else{
                       if(CodEmpleado==""){alert("ingrese el numero de identidad del paciente");}
                       else{
                           
  $.ajax({
        url:"pages-modules/nursing/conexion_CrearPreclinica.php" 
        type: "POST",
        data:{"Fecha" : Fecha, "Peso" :Peso, "Presion" :Presion, "Temperatura" :Temperatura, "Altura" :Altura, "CodEmpleado" :CodEmpleado, "CodExpediente " :CodExpediente},

        success: function(resp){
                alert("Se agrego correctamente");

        },
        error: function(jqXHR,estado,error){
                console.log(jqXHR+" Estado: "+estado+" Error: "+error);
                alert(jqXHR+" Estado: "+estado+" Error: "+error);
        },
        complete: function(estado){
                console.log("Finalizo el proceso de Insertar Cita: "+ estado);
                              }
    });
                           
                       }
                   }
               }
           }
        }
    }
  
}); 
                
	</script>
	<meta charset="UTF-8">
</head>
<body>	
	<div class="container">
	 	<div class="col-md-7">   
	 		   <ul class="nav nav-tabs">
  			   <li role="presentation" class="active" id="opcion1" class="opciones"><a id="menu_seleccionar_expediente" class="button">Preclina</a></li>
		</ul>
		</div>
  
                    </div>
</body>
</html>







<!--se crea el expediente si no existe el expediente-->
<div class="container" id="CrearExpediente">
 <div class="col-md-8">      
                      <!--<div class="input-group" id="divAgregar">-->
                    <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Crear Expediente</button>-->
<!--<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">-->
  <!--<div class="modal-dialog">-->
    <div class="modal-content">
         <form class="form-horizontal">
    <div class="alert alert-success">
    <div class="form-group">
        <label for="txtFecha"   class="control-label col-xs-3">Fecha:</label>
        <div class="col-xs-9">
            <input type="date" class="form-control" id="txtFecha" placeholder="Fecha">
        </div>
    </div> 
    <div class="form-group">
        <label for="txtPeso" class="control-label col-xs-3">Peso</label>
        <div class="col-xs-9">
            <INPUT class="form-control" placeholder="Peso" type="text" SIZE=10 id="txtPeso" onChange="validarSiNumero(this.value);">
            <!--<input type="tetx" class="form-control" id="txtPeso" placeholder="Peso">-->
        </div>
    </div>
    <div class="form-group">
        <label  for="txtPresion" class="control-label col-xs-3">Presion:</label>
        <div class="col-xs-9">
            <input type="txt" class="form-control" id="txtPresion" placeholder="Presion">
        </div>
    </div>
    <div class="form-group">
        <label for="txtTemperatura" class="control-label col-xs-3">Temperatura:</label>
        <div class="col-xs-9">
            <input type="text" class="form-control" id="txtTemperatura" placeholder="Temperatura">
        </div>
    </div>
    <div class="form-group">
        <label for="txtAltura" class="control-label col-xs-3">Altura:</label>
        <div class="col-xs-9">
            <input type="text" class="form-control" id="txtAltura" placeholder="Altura">
        </div>
    </div>
    <div class="form-group">
        <label for="textCodEmpleado" class="control-label col-xs-3">Cod Medico:</label>
        <div class="col-xs-9">
            <input id="textCodEmpleado" class="form-control" type="text" placeholder="Codigo Empleado">
        </div>      
    </div>
    <div class="form-group">
        <label  for="txtCodExpediente" class="control-label col-xs-3">Codigo Expediente:</label>
        <div class="col-xs-9">
            <!--<textarea type="text" class="form-control" id="txtCodigoExpediente" placeholder="Codigo Expediente"></textarea>-->
            <input id="txtCodExpediente" class="form-control" type="text" placeholder="Codigo Expediente">
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-4">
             <div class="row col-sm-12">
        <button type="submit" class="btn btn-default" id="btnGuardarPreclinica">Guardar Preclinica</button>
  </div>
     <input type="reset" class="btn btn-default" value="Limpiar">
        </div>
    </div>
    
</div>
        </form>
    </div>
  </div>
</div>
<!--                      </div>
                    </div> 
</div>-->