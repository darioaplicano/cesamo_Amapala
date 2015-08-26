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
            
          
         $("#PlanillaDeExpediente").css("display","none");
         $("#CrearExpediente").css("display","none");
        
    $("#boton_buscar_expediente").click(function(){
          var identidad = document.getElementById("numero_de_identidad").value; 
           if(identidad == ""){
                alert("No hay una identidad escriba Por favor escriba una");
                 $("#resultadoBusqueda").css("display","none");
    }
    else{
        $.ajax({
                  type: "POST",
                  url: "pages-modules/nursing/cargar_expediente.php",
                  dataType: "json",
                  cache: "false",
                  data: {"id" : identidad},
                  success: function(data){             
                      if(data ==""){
                          alert("No existe Expediente Crearlo");
                          $("#CrearExpediente").css("display","block");
                          $("#PlanillaDeExpediente").css("display","none");  
                      }
                      else{
                        var info_ex = "<td>"+data["iden"]+"</td><td>"+data["nombre"]+"</td><td>"+data["fecha"]+"</tf><td>"+data["sexo"]+"</td><td>"+data["Lugar"]+"</td>";
                         $("#info_expediente").html(info_ex);
                         $("#PlanillaDeExpediente").css("display","block");
                         $("#CrearExpediente").css("display","none");
                      }
                  },
                  error: function (xhRequest, ErrorText, thrownError){
                  console.log("a ocurrido un error: "+xhRequest+"  "+ErrorText+"    "+thrownError+"   ");
            }
          });
          
        
        
    }
           
          
       });
       
       
//       script Se crea el expediente 
       $("#btnGuardarExpediente").click(function(){
    var  CodExpediente = document.getElementById("txtNumeroDeIdentidad").value;
    var  P_Nombre = document.getElementById("txtPrimerNombre").value;
    var  S_Nombre = document.getElementById("txtSegundoNombre").value;
    var  P_Apellido = document.getElementById("txtPrimerApellido").value;
    var  S_Apellido  =  document.getElementById("txtSegundoApellido").value;
    var  FechaNacimiento  = document.getElementById("textFechaDeNacimiento").value;
    var  LugarNacimiento  = document.getElementById("txtLugarDeNacimiento").value;
    var  Sexo= document.getElementById("txtgenero").value;
    
    if(CodExpediente==""){
        alert("escribir codigo expediente");
    }
    else{
        if(P_Nombre==""){alert("escriba su primer Nombre");}
        else{
            if(P_Apellido==""){alert("escriba su primer apellido ");}
            else{
                if(FechaNacimiento==""){alert("escribir fecha de nacimiento");}
                 else{
                     if(LugarNacimiento==""){alert("escriba su lugar de nacimiento");}
                     else{
                           
//    alert("se agrego correcto");
    $.ajax({
        url: "pages-modules/nursing/Conexion_Ingresar_Expediente.php", 
        type: "POST",
        data:{"CodExpediente" : CodExpediente, "P_Nombre" :P_Nombre, "S_Nombre" :S_Nombre, "P_Apellido" :P_Apellido, "S_Apellido" :S_Apellido, "FechaNacimiento" :FechaNacimiento, "Sexo" :Sexo , "LugarNacimiento" :LugarNacimiento},

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
});
    
	</script>
	<meta charset="UTF-8">
</head>
<body>	
    <div class="container">
	<div class="container">
	 	<div class="col-md-7">   
	 		   <ul class="nav nav-tabs">
  			   <li role="presentation" class="active" id="opcion1" class="opciones"><a id="menu_seleccionar_expediente" class="button">Seleccionar Expediente</a></li>
		</ul>
		</div>
        </div>
            
            
<div class="row " style="margin: 10px;">
<div class="col-sm-12" style="margin: 10px">   
 <div class="row col-sm-9" id="busca">
<div class="input-group col-sm-9" >
  <label for="buscar">Buscar Expediente :</label>
                <div >           
                <span class="input-group-btn">
                   <input type="text" class="form-control" placeholder="Numero de Identidad..." id="numero_de_identidad" maxlength="13"> 
                  <button class="btn btn-default" type="button" id="boton_buscar_expediente">Buscar</button>
                </span>
                </div>    
    </div>
</div>
        </div>
            </div> 
</div>
</body>
</html>







<!--se crea el expediente si no existe el expediente-->
<div class="container" id="CrearExpediente">
 <div class="col-md-4">      
                      <div class="input-group" id="divAgregar">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Crear Expediente</button>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
         <form class="form-horizontal">
    <div class="alert alert-success">
    <div class="form-group">
        <label for="txtNumeroDeIdentidad"  class="control-label col-xs-3">Numero De Identidad:</label>
        <div class="col-xs-9">
            <input type="txt" class="form-control" id="txtNumeroDeIdentidad" placeholder="Numero De identidad">
        </div>
    </div> 
    <div class="form-group">
        <label for="txtPrimerNombre" class="control-label col-xs-3">Primer Nombre</label>
        <div class="col-xs-9">
            <input type="txt" class="form-control" id="txtPrimerNombre" placeholder="Primer Nombre">
        </div>
    </div>
    <div class="form-group">
        <label  for="txtSegundoNombre" class="control-label col-xs-3">Segundo Nombre:</label>
        <div class="col-xs-9">
            <input type="txt" class="form-control" id="txtSegundoNombre" placeholder="Segundo Nombre">
        </div>
    </div>
    <div class="form-group">
        <label for="txtPrimerApellido" class="control-label col-xs-3">Primer Apellido:</label>
        <div class="col-xs-9">
            <input type="text" class="form-control" id="txtPrimerApellido" placeholder="Primer Apellido">
        </div>
    </div>
    <div class="form-group">
        <label for="txtSegundoApellido" class="control-label col-xs-3">Segundo Apellido:</label>
        <div class="col-xs-9">
            <input type="text" class="form-control" id="txtSegundoApellido" placeholder="Segundo Apelido">
        </div>
    </div>
    <div class="form-group">
        <label for="textFechaDeNacimiento" class="control-label col-xs-3">F. Nacimiento:</label>
        <div class="col-xs-9">
            <input id="textFechaDeNacimiento" class="form-control" type="date" placeholder="Fecha De Nacimiento">
        </div>      
    </div>
    <div class="form-group">
        <label  for="txtLugarDeNacimiento" class="control-label col-xs-3">Lugar De Nacimiento:</label>
        <div class="col-xs-9">
            <textarea rows="3" class="form-control" id="txtLugarDeNacimiento" placeholder="Dirección"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="radio-inline" class="control-label col-xs-3">Genero:</label>
        <div class="col-xs-2">
            <label class="radio-inline">
                <input type="radio" name="genderRadios" id="txtgenero" value="M"> Maculino
            </label>
        </div>
        <div class="col-xs-2">
            <label class="radio-inline">
                <input type="radio" name="genderRadios" id="txtgenero" value="F"> Femenino
            </label>
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-4">
             <div class="row col-sm-12">
  <button type="submit" class="btn btn-default" id="btnGuardarExpediente">Guardar Cita</button>
  </div>
            <input type="reset" class="btn btn-default" value="Limpiar">
        </div>
    </div>
    
</div>
        </form>
    </div>
  </div>
</div>
                      </div>
                    </div> 
</div>






<!--se escribe el expediente-->
<div class="container" id="PlanillaDeExpediente">
           <ul class="col-md-5"></ul>      
                    <div class="row">
                      <div class="col-md-8">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                          <h3 class="panel-title">Expediente:</h3>
                          </div>
                            <table class="table">
                            <div>
                                <thd>
                                 <tr>
                                 <th>Numero de Identidad</th>
                                <th>Nombre Completo</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Genero</th>
                               <th>Direccion</th>
                               </tr>
                               </thd>
                                <tbody>
                            </div>
                         <tr id="info_expediente">
                        </tr>
                            </table>
                         </table>
                        </div>
                      </div>       
                     </div>
                               
</div>








