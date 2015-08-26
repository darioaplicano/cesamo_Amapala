$(document).ready(function(){   // ejecuta el script jquery cuando el documento ha terminado de cargarse -->
    $("#b1").click(function(){  // al pulsar (.click) el boton 1 (#b1) -->
        $("#dialogo").dialog({  // muestra la ventana  -->
            width: 590,         // ancho de la ventana -->
            height: 350,        // altura de la ventana -->
            show: "scale",      // animación de la ventana al aparecer -->
            hide: "scale",      // animación al cerrar la ventana -->
            resizable: "false", // fija o redimensionable si ponemos este valor a "true" -->
            position: "center", // posicion de la ventana en la pantalla (left, top, right...) -->
            modal: "true"       // si esta en true bloquea el contenido de la web mientras la ventana esta activa (muy elegante) -->
        });
    });
$("#b2").click(function() {
    $("#dialogo2").dialog({
            width: 590,
            height: 350,
            show: "scale",
            hide: "scale",
            resizable: "false",
            position: "center"     
        });
    });
$("#b3").click(function() {
        $("#dialogo3").dialog({
            width: 590,
            height: 350,
            show: "blind",
            hide: "shake",
            resizable: "false",
            position: "center"     
        });
    });

//Procedimientos de Consulta.php

$("#menu_seleccionar_expediente").click(function(){
       

        $("#selecExpediente").css("display","none");
        $("#mot_consulta").css("display","none");
        $("#examen_medico").css("display","none");
        $("#diagnostico").css("display","none");
        $("#tratamiento").css("display","none");
        $("#selecExpediente").css("display","none");
        $("#enviarConsulta").css("display","none");
        $("#tablaPreclinica").css("display","none");

        $("#selecExpediente").css("display","block");
        $("#divBuscadorExpediente").css("display","block");
        $("#confirmarExpediente").css("display","block");
        $("#expediente").css("display","block");

        $("#opcion2").removeAttr('class');
        $("#opcion3").removeAttr('class');
        $("#opcion4").removeAttr('class');
        $("#opcion5").removeAttr('class');
        $("#opcion6").removeAttr('class');
       
        $("#opcion8").removeAttr('class');


        $("#opcion1").attr("class","active");

});

$("#menu_preclinica").click(function(){
        
        $("#selecExpediente").css("display","none");
        $("#mot_consulta").css("display","none");
        $("#examen_medico").css("display","none");
        $("#diagnostico").css("display","none");
        $("#tratamiento").css("display","none");
        $("#selecExpediente").css("display","none");
        $("#enviarConsulta").css("display","none");

        
        $("#divBuscadorExpediente").css("display","none");
        $("#confirmarExpediente").css("display","none");
        $("#expediente").css("display","none");

        $("#tablaPreclinica").css("display","block");
        $("#examenesPreclinica").css("display","block");

        $("#opcion1").removeAttr('class');
        $("#opcion2").removeAttr('class');
        $("#opcion3").removeAttr('class');
        $("#opcion4").removeAttr('class');
        $("#opcion5").removeAttr('class');
        $("#opcion6").removeAttr('class');
        $("#opcion8").removeAttr('class');


        $("#opcion2").attr("class","active");

});

        $("#menu_motivo_de_consulta").click(function(){
        $("#expediente").css("display","none");  
        $("#selecExpediente").css("display","none");
        $("#tablaPreclinica").css("display","none");
        $("#examen_medico").css("display","none");
        $("#diagnostico").css("display","none");
        $("#tratamiento").css("display","none");
        
        $("#selecExpediente").css("display","none");
        $("#enviarConsulta").css("display","none");

        $("#mot_consulta").css("display","block");

        $("#opcion1").removeAttr('class');
        $("#opcion2").removeAttr('class');
        $("#opcion4").removeAttr('class');
        $("#opcion5").removeAttr('class');
        $("#opcion6").removeAttr('class');
        
        $("#opcion8").removeAttr('class');


        $("#opcion3").attr("class","active");
        
});

    $("#menu_examen_fisico").click(function(){

        $("#selecExpediente").css("display","none");
        $("#expediente").css("display","none"); 
        $("#tablaPreclinica").css("display","none");
        $("#mot_consulta").css("display","none");
        $("#selecExpediente").css("display","none");
        $("#diagnostico").css("display","none");
        $("#tratamiento").css("display","none");
        
        $("#selecExpediente").css("display","none");
        $("#enviarConsulta").css("display","none");
       
        $("#examen_medico").css("display","block");

        $("#opcion1").removeAttr('class');
        $("#opcion2").removeAttr('class');
        $("#opcion3").removeAttr('class');
        $("#opcion5").removeAttr('class');
        $("#opcion6").removeAttr('class');
        
        $("#opcion8").removeAttr('class');


        $("#opcion4").attr("class","active");
    });



        $("#menu_diagnostico").click(function(){

        $("#expediente").css("display","none");  
        $("#selecExpediente").css("display","none");
        $("#tablaPreclinica").css("display","none");
        $("#mot_consulta").css("display","none");
        $("#examen_medico").css("display","none");
        $("#tratamiento").css("display","none");
        
        $("#selecExpediente").css("display","none");
        $("#enviarConsulta").css("display","none");

         $("#diagnostico").css("display","block");

        $("#opcion1").removeAttr('class');
        $("#opcion2").removeAttr('class');
        $("#opcion3").removeAttr('class');
        $("#opcion4").removeAttr('class');
        $("#opcion6").removeAttr('class');
        
        $("#opcion8").removeAttr('class');

        
        $("#opcion5").attr("class","active");
        
});

        $("#menu_tratamiento").click(function(){
        
        $("#expediente").css("display","none");   
        $("#selecExpediente").css("display","none");
        $("#tablaPreclinica").css("display","none");
        $("#examen_medico").css("display","none");
        $("#mot_consulta").css("display","none");
        $("#diagnostico").css("display","none");
        
        $("#selecExpediente").css("display","none");
        $("#enviarConsulta").css("display","none");
       
        $("#tratamiento").css("display","block");

        $("#opcion1").removeAttr('class');
        $("#opcion2").removeAttr('class');
        $("#opcion3").removeAttr('class');
        $("#opcion4").removeAttr('class');
        $("#opcion5").removeAttr('class');
       
        $("#opcion8").removeAttr('class');


        $("#opcion6").attr("class","active");
        
});

       
        

    
    $("#menu_finalizar").click(function(){


        $("#selecExpediente").css("display","block");
        $("#tablaPreclinica").css("display","none");
        $("#divBuscadorExpediente").css("display","none");
        $("#confirmarExpediente").css("display","none");
        $("#expediente").css("display","block");
        $("#examen_medico").css("display","block");
        $("#mot_consulta").css("display","block");
        $("#diagnostico").css("display","block");
        $("#tratamiento").css("display","block");
        
        $("#enviarConsulta").css("display","block");
        $("#enviar").css("display","block");

        
      

        $("#opcion1").removeAttr('class');
        $("#opcion2").removeAttr('class');
        $("#opcion3").removeAttr('class');
        $("#opcion4").removeAttr('class');
        $("#opcion5").removeAttr('class');
        $("#opcion6").removeAttr('class');
        


        $("#opcion8").attr("class","active");

        });

       

        $("#boton_buscar_expediente").click(function(){

          var identidad = document.getElementById("numero_de_identidad").value;

              

          $.ajax({

                  type: "POST",
                  url: "pages-modules/medical_consultations/cargar_expediente_y_preclinica.php",
                  dataType: "json",
                  cache: "false",
                  data: {"id" : identidad},

                  success: function(data){
                      
                  
                       var info_ex = "<div><h4><i><strong><u>Codigo de Expediente:</strong></i></u>  <h4><h5>   "+data["iden"]+"</h5></div><div><h4><i><strong><u>Nombre:  </u></i></strong><h4><h5>   "+data["nombre"]+"</h5></div><div><h4><i><strong><u>Fecha:  </i></strong></u><h4><h5>   "+data["fecha"]+"</h5></div><div><h4><i><u><strong>Sexo:  </i></u></strong><h4><h5>   "+data["sexo"]+"</h5></div><div><h4><u><i><strong>Lugar:  </i></u></strong><h4><h5>   "+data["Lugar"]+"</h5></div>";
                       $("#info_expediente").html(info_ex);
                       var preclinica = data["preclinica"];

                       $("#resultado_preclinica").html(preclinica);
                       // $("#infoExpediente").html(data);
                        
                  },
                  error: function (xhRequest, ErrorText, thrownError){
                  alert("a ocurrido un error: "+xhRequest+"  "+ErrorText+"    "+thrownError+"   ");
            

            }

          });




        });


      $("#enviarConsulta").click(function(){

         
        
          var codigoExpediente = document.getElementById("numero_de_identidad").value;
          var motivo = document.getElementById("motivo_de_consulta").value;
          var examenFisico = document.getElementById("efisico").value;
          var diag = document.getElementById("txtDiagnostico").value;
          var trata = document.getElementById("txtTratamiento").value;
          var codE = document.getElementById("codE").value;

          
          $.ajax({
            url: "pages-modules/medical_consultations/subir_consulta.php",
            type: "POST",
            data: {"expediente" : codigoExpediente, "motivo" : motivo, "examenFisico" : examenFisico, "diagnostico" : diag, "tratamiento" : trata , "codEmpleado" : codE},
            
            success: function(data){
            
              alert("Se inserto Correctamente la Consulta");
            
            },
            
            error: function(xhRequest, ErrorText, thrownError){
                alert(xhRequest+" " + ErrorText+" "+thrownError);
            }

          });
          



      });

//Procedimietos para el modulo de Ver Expedientes

        //Procedimiento para buscar el expediente y cargar las distintas consultas al menu.

    $("#buscarExpediente3").click(function(){
                        
          var identidad = document.getElementById("buscadorExpediente3").value;
        
           $.ajax({

                  type: "POST",
                  url: "pages-modules/medical_consultations/cargar_expediente_consultas.php",
                  data: {"id" : identidad},

                  success: function(data){
                      
                      
                         $("#selectorConsultas").html(data);
                    
                     
                  
                },
                  error: function (xhRequest, ErrorText, thrownError){
                  alert("a ocurrido un error: "+xhRequest+"  "+ErrorText+"    "+thrownError+"   ");
            

            }

          });


        });

//Procedimientos para el modulo de Control de Citas


$("#buscarCita").click(function(){

        $("#crearCita").removeAttr('class');
        
        $("#borrarCita").removeAttr('class');

        $("#buscarCita").removeAttr('class');

        $("#buscarCita").attr("class","active");

        $("#formulario_nueva_cita").css("display","none");

        $("#resultadoBusqueda").css("display","none");

        $("#cancelarCita").css("display","none");

         $("#busca").css("display","block");



});

$("#crearCita").click(function(){

        $("#crearCita").removeAttr('class');
        
        $("#borrarCita").removeAttr('class');

        $("#buscarCita").removeAttr('class');

        $("#crearCita").attr("class","active");

        $("#resultadoBusqueda").css("display","none");
        $("#busca").css("display","none");
        $("#cancelarCita").css("display","none");

        $("#formulario_nueva_cita").css("display","block");


});

$("#borrarCita").click(function(){
    

        $("#crearCita").removeAttr('class');
        
        $("#borrarCita").removeAttr('class');

        $("#buscarCita").removeAttr('class');

        $("#borrarCita").attr("class","active");

        $("#formulario_nueva_cita").css("display","none");

        $("#resultadoBusqueda").css("display","none");

        $("#busca").css("display","none");

        $("#cancelarCita").css("display","block");

        $("#cancelar").css("display","block");

        $("#busca2").css("display","block");


});

$("#guardarCita").click(function(){


 
    var p_nombre = document.getElementById("p_nombre").value;
  
    var s_nombre = document.getElementById("s_nombre").value;

    var p_apellido = document.getElementById("p_apellido").value;

    var s_apellido = document.getElementById("s_apellido").value;
   
    var telefono =  document.getElementById("telefono").value;
   
    var fecha = document.getElementById("fecha_nueva_cita").value;
   
    var hora = document.getElementById("hora").value;

    var codigoEmpleado = document.getElementById("codEmp").value;


   
   if(fecha==""){

             alert("Error: No se ha especificado la fecha de la Cita");
   
             }
            else{
                  
                    if(hora==""){
                                
                                alert("Error: No se ha especificado la hora de la Cita");
                                }
                    else{

                        $.ajax({

                            url: "pages-modules/medical_consultations/conexion_nueva_cita.php", 

                            type: "POST",
            //Obtener el codigo del medico a partir del usuario que esta logueado
                            data:{"p_nombre" : p_nombre, "s_nombre" : s_nombre, "p_apellido" : p_apellido, "s_apellido" : s_apellido, "telefono" : telefono, "fecha" : fecha, "hora" : hora, "codEmpleado" : codigoEmpleado},

                            success: function(resp){
                                        alert("Se agrego correctamente");

                                        },
        
                            error: function(jqXHR,estado,error){
                
                                        console.log(jqXHR+" Estado: "+estado+" Error: "+error);
                                        alert(jqXHR+" Estado: "+estado+" Error: "+error);
                                        
                                        },
                            complete: function(estado){
                                        
                                        console.log("Finalizo el proceso de Insertar Cita: "+ estado);


                                          document.getElementById("p_nombre").value = "";
  
                                            document.getElementById("s_nombre").value ="";

                                         document.getElementById("p_apellido").value = "";

                                          document.getElementById("s_apellido").value= "";
   
                                          document.getElementById("telefono").value = "";
   
                                         document.getElementById("fecha_nueva_cita").value = "";
   
                                        document.getElementById("hora").value = "";
   
                                        }
                        })

                     }
                }

 
});

$("#btn_borrar").click(function(){


    var id = document.getElementById("seleccionarCita").value;
   
    if(id==""){
        alert("Busque la cita que desea Eliminar");
    }
    else
    {
        $.ajax({
        url:"pages-modules/medical_consultations/conexion_eliminar_cita.php", 
            type: "POST",
            data: {"id" : id},
            success : function(resp){

                alert("Se elimino correctamente");
                $("#seleccionarCita").html("");    
               
            }, 

            error: function(jqXHR,estado,error){
                console.log(estado);
                console.log(error);

              
            },

            complete: function(jqXHR,error){
                console.log(error);

                document.getElementById("seleccionarCita").value = "";
                document.getElementById("buscar_fecha2").value = ""; 
            }
    })
    }
    
});

$("#btn_enviar_fecha2").click(function(){
     var fecha = document.getElementById("buscar_fecha2").value;
     var codigoEmpleado = document.getElementById("codEmp").value;
     

     $.ajax({
            url:"pages-modules/medical_consultations/conexion_combobox.php", 
            type: "POST",
            data: {"fe" : fecha, "codigoEmp" : codigoEmpleado},
            success : function(resp){

                    if(resp == ""){
                        alert("No hay citas para esta fecha");
                        $("#seleccionarCita").html(resp);
                    
                    }
                    else{
                         $("#seleccionarCita").html(resp);
                    }
                    
               
            }, 

            error: function(jqXHR,estado,error){
                console.log(estado);
                console.log(error);

              
            },

            complete: function(jqXHR,error){
                console.log(error);
            }
     })
});

$("#btn_enviar_fecha").click(function(){
    
    var fecha = "";
    fecha = document.getElementById("buscar_fecha").value;
    var codigoEmpleado = document.getElementById("codEmp").value;

    if(fecha == ""){

        //mostrar el div de alerta
        alert("Error: Seleccione una fecha para buscar las citas");

              

        $("#resultadoBusqueda").css("display","none");


    }
    else{
      
        $("#resultadoBusqueda").css("display","block");
    
        $.ajax({

        
            url:"pages-modules/medical_consultations/conexion_control_de_citas.php", 
            type: "POST",
            data: {"fe" : fecha, "codEmpleado" : codigoEmpleado},
            success : function(resp){

                    if(resp == ""){
                        alert("No hay citas para esta fecha");
                        $("#resultado").html(resp);
                        //$("#resultadoBusqueda").css("display","none");
                    
                    }
                    else{
                         $("#resultado").html(resp);
                    }
                    
               
            }, 

            error: function(jqXHR,estado,error){
                console.log(estado);
                console.log(error);

              
            },

            complete: function(jqXHR,error){
                console.log(error);
            }
           
        })

       

    
        }
    });

          
    
    
  
});

 