<?php
  include('Tratamiento.php');
  $medicamentos = array(); 
  $lista_medicamentos = json_encode($medicamentos);
?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="pages-modules/medical_consultations/bootstrap.css">
  
  <script type="text/javascript" src="src.js"></script>
  <script type="text/javascript">

      var codigoDelExpediente="";
      var codigoDelMedico = 1;
      var listaDeMedicamentos = [];
      var codigoConsulta;
    

    $( document ).ready(function() {
          
     

        $.ajax({
            url: "pages-modules/medical_consultations/cargar_selectMedicamentos.php",

                  type: "POST",
                  
                  data: {"valor" : 1},

                  
                  success: function(resultado){

                    $("#seleccionarMedicamento").html(resultado);

                  },

                   error: function (xhRequest, ErrorText, thrownError){
                  console.log("a ocurrido un error: "+xhRequest+"  "+ErrorText+"    "+thrownError+"   ");
                }


      


                 });
      });

    $("#agregarMedicamento").click(function(){
        

           
         
        var cod = $("#seleccionarMedicamento").val();
        var nombre = $("#seleccionarMedicamento option:selected").html();
       var numeroMedicamentos = $("#cMedicamento").val();
       var tratamientoMedicamentos = $("#tMedicamento").val();

       if ((numeroMedicamentos==" ")||(tratamientoMedicamentos==""))
        {

          alert ("Error Campos Vacios: Por Favor Llenar Todos Los Campos");
        
        }else{

          var medicamento = {codigo : cod, nombre: nombre, cantidad: numeroMedicamentos, tratamiento : tratamientoMedicamentos};

         
         
         listaDeMedicamentos.push(medicamento);

         
         
          var productosJSON = JSON.stringify(listaDeMedicamentos);   
          
          $.post('pages-modules/medical_consultations/insertar_tabla_de_medicamentos.php', {"productos": productosJSON},
          function(respuesta) {
               
            $("#resultado_receta").html(respuesta);

          }).error(
         function(){
              console.log('Error al ejecutar la petición');
           }
          );
          
          $("#nMedicamento").val("");
          $("#cMedicamento").val("");
          $("#tMedicamento").val("");


        }
         
                 });

         $('#numero_de_identidad').keydown(function(e) {    
        // Admite [0-9], BACKSPACE y TAB  
        if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode != 8 && e.keyCode != 9)  
        e.preventDefault();  
    });  

         $("#boton_buscar_expediente").click(function(){

          var identidad = document.getElementById("numero_de_identidad").value;

        if (identidad == "") 
          {

              alert("Error: Por Favor, Introduzca el Número de Identidad");

          }else
          {
               $.ajax({

                  type: "POST",
                  url: "pages-modules/medical_consultations/cargar_expediente.php",
                  dataType: "json",
                  cache: "false",
                  data: {"id" : identidad},

                  success: function(data){
                      
                     if (data=="") {

                      alert("No Existe este Expediente");

                     }
                     else{
                       var info_ex = "<div><h4><i><strong><u>Codigo de Expediente:</strong></i></u>  <h4><h5>   "+data["iden"]+"</h5></div><div><h4><i><strong><u>Nombre:  </u></i></strong><h4><h5>   "+data["nombre"]+"</h5></div><div><h4><i><strong><u>Fecha:  </i></strong></u><h4><h5>   "+data["fecha"]+"</h5></div><div><h4><i><u><strong>Sexo:  </i></u></strong><h4><h5>   "+data["sexo"]+"</h5></div><div><h4><u><i><strong>Lugar:  </i></u></strong><h4><h5>   "+data["Lugar"]+"</h5></div>";
                       

                       codigoDelExpediente = data["iden"];
                       codigoConsulta = data["consulta"];

                       $("#info_expediente").html(info_ex);
                       // $("#infoExpediente").html(data);
                      }
                  },

                  error: function (xhRequest, ErrorText, thrownError){
                  console.log("a ocurrido un error: "+xhRequest+"  "+ErrorText+"    "+thrownError+"   ");
            

            }

          });

          }

         




        });

 $('#cMedicamento').keydown(function(e) {    
        // Admite [0-9], BACKSPACE y TAB  
        if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode != 8 && e.keyCode != 9)  
        e.preventDefault();  
    });  

      $("#guardarReceta").click(function(){


          if(codigoDelExpediente==""){
            alert("Error: Seleccione el Expediente del Paciente");
          }
          else{


            if(listaDeMedicamentos.length != 0 ){

              var jsonMedicamentos = JSON.stringify(listaDeMedicamentos);

            $.ajax({
                  type: "POST",
                  url: "pages-modules/medical_consultations/subir_recetaMedica.php",
                  data: {"codigoConsulta": codigoConsulta,"codigoDelExpediente" : codigoDelExpediente, "codigoDelMedico" : codigoDelMedico, "medicamentos" : jsonMedicamentos},
                  success: function(data){
                     
                      alert("Codigo de Receta: "+data);


                  },
                  error: function(xhRequest,ErrorText,thrownError){
                    alert("a ocurrido un error: "+xhRequest+"  "+ErrorText+"    "+thrownError+"   ");
                  }
                  });
              }
              else{
                alert("Error: No se han agregado medicamentos a la Receta");

              }
          }

      });
  </script>
</head>
<body>

    <div class="row col-lg-11">

    <div class="panel panel-default">
  	<div class="panel-heading">Buscar Expediente</div>
  	<div class="panel-body">
    <div class="col-lg-10" id="selecExpediente" >   
 <!--Buscador de Expedient-->
                <div class="row" id="divBuscadorExpediente">                            
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Numero de Identidad..." id="numero_de_identidad" maxlength="13">
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="button" id="boton_buscar_expediente">Buscar</button>
                </span>
                
                </div>
                
                </div>
<!--Area donde muestra la informacion del expediente-->
                <div class="row" id="expediente" style="margin: 20px">
                   
                    <div class="row">
                      <div class="col-md-10">
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
        </div>
        </div>
        </div>



  <div class="row col-lg-11">
  <div class="panel panel-default">
  <div class="panel-heading">Receta Medica</div>
  <div class="panel-body">
  <div class="col-lg-11" id="receta">

<!--Area donde se llena la receta medica-->
      <div style="margin: 25px">
                     
            <div class="row"> 
              <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2">Medicamento:</span>
            
             <div class="row">
                   <div class="col-xs-5 selectContainer" id="selecMedicamento">
                        <select class="form-control" name="medicamentos" id="seleccionarMedicamento">
                
                         </select>
                  </div>
            </div>

            </div>


            </div>  
      </div>    

      <div style="margin: 25px">
      <div class="row">
              <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2" style="width: 20px">Cantidad:</span>
                  <input type="text" id="cMedicamento" class="form-control" placeholder="Cantidad" aria-describedby="sizing-addon2">
              </div>
      </div>
      </div>

      <div style="margin: 25px">
      <div class="row">
              <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2">Tratamiento:</span>
             <input type="text" id="tMedicamento" class="form-control" placeholder="Tratamiento" aria-describedby="sizing-addon2">
            </div>
      </div>
      </div>

      <div class="col-lg-10"></div>

      <div class="col-lg-1" style="margin: 10px">
            <button type="button" class="btn btn-default" id="agregarMedicamento">Ingresar</button>
      </div>
          
            
                
            <table class="table table-bordered">
               <thead>
                <tr>
                  <th>Codigo</th> 
                  <th>Medicamento</th>
                  <th>Cantidad</th>
                  <th>Tratamiento</th>
               </tr>
              </thead>

                <tbody id="resultado_receta">
      
          
                </tbody>
            </table>
          </div>
          </div>
          </div>
          </div>
          
        <div class="row col-lg-11">
          <div class="col-lg-10"></div>
          <div id="enviarReceta" class="col-lg-1" style="margin: 10px">
          <button type="button" class="btn btn-success" id="guardarReceta">Guardar Receta</button>
          </div>

        </div>
           
      </div>

</body>
</html>

