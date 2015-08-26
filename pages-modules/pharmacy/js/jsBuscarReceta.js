/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global fila */

$(document).ready(function(){
    var codReceta;
    var fila;
    
    //solo sirve para inicializar fila
//    $.post("pages-modules/pharmacy/OptionsPages/AlmacenarSalidasMedicamentosRecetaScript.php", {codMedicamento: 1}, function(data){
//        //alert("data: " + data);
//        fila = $.parseJSON(data);
//        //alert(existenciaMedicamento);
//    });
    
    var existenciaMedicamento;
    
    $('input').keydown(function(e) {    
        // Admite [0-9], BACKSPACE y TAB  
        if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode != 8 && e.keyCode != 9)  
        e.preventDefault();  
    });  

    $("#btnBuscarReceta").click(function(){
        if(!$.trim($("#codReceta").val()).length){
            alert("Introduzca el codigo de la Receta de forma correcta.");
        }
        else{
            codReceta = $("#codReceta").val();           
            $("#adminArea").load("pages-modules/pharmacy/OptionsPages/Receta.php", {codReceta: codReceta});
        }
    });

    
    $("#btnRegistrarSalidaMedicamentos").click(function(){
        var matriz = [, ];                 
        
        var fallo = false;
        var i = 0;
        var j = 0;
        var numCol = 0;
        
        $('#tablaMedicamentosReceta tr').each(function () {
            $(this).find('td').each(function(){
                matriz[i, j] = $(this).text();
                
                if(numCol == 0){
                    var value = matriz[i, j];
                    $.post("pages-modules/pharmacy/OptionsPages/AlmacenarSalidasMedicamentosRecetaScript.php", {codMedicamento: value}, function(data){
                        //alert("data: " + data);
                        fila = $.parseJSON(data);
                        //alert(existenciaMedicamento);
                    });
                }
                
                existenciaMedicamento = fila[0].Existencia;
                
                if(numCol == 3){
                    if($(this).find('input').val().length == 0){
                        //alert($(this).find('input').val().length);
                        fallo = true;
                        
                        return false;
                    }else{
                        //alert(!$.trim($(this).find('input').val().length) + $(this).find('input').val());
                        var cantEntregar = $(this).find('input').val();
                        
                        //alert((fila[0].Existencia < cantEntregar)+ " "+fila[0].Existencia +" "+cantEntregar);
                        if(existenciaMedicamento < cantEntregar){
                            fallo = true;
                            alert("La existencia del medicamento es menor que la cantidad que se quiere entregar! " + "Existencia actual del medicamento: " + "Cod: " + fila[0].codMedicamento +" Existencia "+ fila[0].Existencia);
                            return false;
                        }else{
                            matriz[i, j] = $(this).find('input').val();
                            fallo = false;
                        }
                    }
                }
                //alert(matriz[i, j]);
                j++;
                numCol++;
            });
            
            if(fallo){
                return false;
            }
            
            numCol = 0;
            i++;
        });
        if(fallo){
            alert("Introduzca las cantidades de los medicamentos de forma correcta. No se enviaron los datos a la base de datos.");
        }
        else{
            alert("Datos guardados.");
            
            $.post("pages-modules/pharmacy/OptionsPages/AlmacenarSalidasMedicamentosRecetaScript.php", {matriz: matriz});
        
            $("#adminArea").load("pages-modules/pharmacy/OptionsPages/BuscarReceta.php");
        }
    });
});