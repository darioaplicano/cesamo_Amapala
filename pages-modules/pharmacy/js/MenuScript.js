/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $("#optBuscarReceta").on("click",function(){
        $("#optInventario").removeClass("active");
        $("#optBuscarMedicamentos").removeClass("active");
        $(this).addClass("active");
        $("#adminArea").load("pages-modules/pharmacy/OptionsPages/BuscarReceta.php");
    });
    
    $("#optBuscarMedicamentos").on("click", function(){
        $("#optBuscarReceta").removeClass("active");
        $("#optInventario").removeClass("active");
        $(this).addClass("active");
        $("#adminArea").load("pages-modules/pharmacy/OptionsPages/BuscarMedicamento.php");
    });
    
    $("#optInventario").on("click", function(){
        $("#optBuscarMedicamentos").removeClass("active");
        $("#optBuscarReceta").removeClass("active");
        $(this).addClass("active");
        $("#adminArea").load("pages-modules/pharmacy/OptionsPages/Inventario.php");
    });
});


