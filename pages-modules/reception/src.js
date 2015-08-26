$.ajax({

        
            url:"pages-modules/reception/ConsultaMedico.php", 
            type: "POST",
            data: {},
            success : function(resp){


                    if(resp == ""){
                        alert("no hay medicos");
                        $("#resultadoBusqueda").css("display","none");
                    
                    }
                    else{
                         $("#selectDoctor").html(resp);
                         $("#selectDoctor3").html(resp);
                         $("#SeleccionarMedico").html(resp);
                         
                        
                    }
            }, 

            error: function(jqXHR,estado,error){
                console.log(estado);
                console.log(error);

              
            },

            complete: function(jqXHR,error){
                console.log(error);
            }
           
        });



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
    
    
  
    
    
$("#btn_enviar_Empleado").click(function(){
   var nombre = document.getElementById("buscar_Empleado1").value;
   if(nombre==""){
       alert("Espacio Vacio");
   }
   else{
        $("#resultadoBusqueda1").css("display","block");
        $.ajax({
                 
                  url: "pages-modules/reception/Conexion_Busquedad_Empleado.php",
                  type: "POST",
                  data: {"nombre" : nombre},
                 
            success: function(data){  
                      if(data ==""){
                          alert("No existe el empleado, O esta mal escrito su nombre");
                           
                      }
                      else{
                       $("#resultado").html(data);
                            
                      }
                  },
                  error: function (xhRequest, ErrorText, thrownError){
                  console.log("a ocurrido un error: "+xhRequest+"  "+ErrorText+"    "+thrownError+"   ");
            }
          });
       
   }
   
   
});    


$("#resultadoBusqueda1").css("display","none");
    
$("#buscarCita").click(function(){
         $("#Selector2").css("display","block");
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
    
    
  
   
   
        $("#Selector2").css("display","none");
        $("#crearCita").removeAttr('class');
        
        $("#borrarCita").removeAttr('class');

        $("#buscarCita").removeAttr('class');


        $("#crearCita").attr("class","active");

    
    $("#resultadoBusqueda").css("display","none");
    
    $("#busca").css("display","none");
    
    $("#cancelarCita").css("display","none");
    
    $("#cancelarCita").css("display","none");   
      
    $("#formulario_nueva_cita").css("display","block");
      
        


});

$("#borrarCita").click(function(){
         
        
    
        $("#Selector2").css("display","none");
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




$("#guardarCita1").click(function(){
 
    var p_nombre = document.getElementById("p_nombre").value;
  
    var s_nombre = document.getElementById("s_nombre").value;

    var p_apellido = document.getElementById("p_apellido").value;
    var s_apellido = document.getElementById("s_apellido").value;
    var telefono =  document.getElementById("telefono").value;
    var fecha = document.getElementById("fecha_nueva_cita").value;
    var hora = document.getElementById("hora").value;  
    var codMedico = document.getElementById("selectDoctor3").value;
//    var codigo = document.getElementById("selectDoctor").value;
     if(p_nombre==""){
         alert("Escriba su primer nombre");
     }
     else{
         if(s_nombre==""){
             alert("Escriba su segundo nombre");
         }
         else{
             if(p_apellido==""){
                 alert("Escriba su primer apellido");
             }
             else{
                 if(s_apellido){alert("Escriba su segundo apellido");}
                 else{
                     if(telefono==""){alert("Escriba el numero de telefono");}
                     else{
                         if(fecha==""){alert("Escriba la fecha para la creacion de cita");}
                         else{
                             if(hora==""){alert("Escriba la hora en que se realizara la cita");}
                             else{
                                 $.ajax({
 
        url: "pages-modules/reception/conexion_nueva_cita.php",
 
         type: "POST",
 
         data:{"p_nombre" : p_nombre, "s_nombre" : s_nombre, "p_apellido" : p_apellido, "s_apellido" : s_apellido, "telefono" : telefono, "fecha" : fecha, "hora" : hora, "codMedico" : codMedico},
 
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
     document.getElementById("fecha_nueva_cita").value = "";
     document.getElementById("hora").value = "";
     document.getElementById("txtCodigoDeMedico").value="";
     document.getElementById("telefono");
    
                
         }
  
         });
                                 
                                 
                             }
                         }
                     }
                 }
             }
         }
        
     }
});

$("#btn_borrar").click(function(){
    var id = document.getElementById("seleccionarCita").value;
    var codMedico = document.getElementById("SeleccionarMedico").value;
//    alert(id);
    if(id==""){
        alert("Busque la cita que desea Eliminar");
    }
    else
    {
        $.ajax({
        url:"pages-modules/medical_consultations/conexion_eliminar_cita.php", 
            type: "POST",
            data: {"id" : id ,"codMedico":codMedico},
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
    });
    }
    
});

$("#btn_enviar_fecha2").click(function(){
     var fecha = document.getElementById("buscar_fecha2").value;
     var codMedico = document.getElementById("SeleccionarMedico").value;
     //alert(codMedico);
//     CancelarCitaCodMedico
     alert(fecha);

     $.ajax({
            url:"pages-modules/reception/conexion_combobox.php", 
            type: "POST",
            data: {"fe" : fecha,"codMedico":codMedico},
            success : function(resp){

                    if(resp == ""){
                        alert("No hay citas para esta fecha");
                       
                    
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
     });
});

$("#btn_enviar_fecha").click(function(){
    
   // document.getElementById("selectDoctor").value="";
    var fecha = document.getElementById("buscar_fecha").value;
    var codigo = document.getElementById("selectDoctor").value;
     
     //alert(codigo);
    if(fecha == ""){
        alert("Seleccione una fecha para buscar las citas");
        $("#resultadoBusqueda").css("display","none");


    }
    else{
      
        $("#resultadoBusqueda").css("display","block");
    
        $.ajax({

        
            url:"pages-modules/reception/conexion_control_de_citas.php", 
            type: "POST",
            data: {"fe" : fecha,"codigo":codigo},
            success : function(resp){

                    if(resp == ""){
                        alert("No hay citas para esta fecha");
                        $("#resultadoBusqueda").css("display","none");
                    
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
           
        });

       

    
        }
    });
});

 