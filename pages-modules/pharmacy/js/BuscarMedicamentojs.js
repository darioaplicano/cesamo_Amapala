/* global matrix */

$(document).ready(function(){  

    for(var i = 0; i < matrix.length; i++){
        $("#selectpicker").append("<option>"+matrix[i].NombreMedicamento+"</option>");
    }
    
    $("#addMedicamento").click(function(){
        var index = $("#selectpicker").find(":selected").index();
        if(!$.trim($("#cantMedicamento").val()) || !$.trim($("#expMedicamento").val())){
            alert("Introduzca la cantidad del medicamento y la fecha de experación del mismo");
        }
        else{
            $("#tablaMedicamentosEntrada").append("<tr><td>"+matrix[index].CodMedicamento+"</td><td>"+
                matrix[index].NombreMedicamento+"</td><td>"+$("#expMedicamento").val()+"</td><td>"+$("#cantMedicamento").val()+"</td></tr>");
        }
    });
    
    $("#btnRegistrarEntradaMedicamentos").click(function(){
        var matrizEntradaMedicamento = [, ];                 
        
        var i = 0;
        var j = 0;
        
        $('#tablaMedicamentosEntrada tr').each(function () {
            $(this).find('td').each(function(){
                matrizEntradaMedicamento[i, j] = $(this).text();
                //alert(matriz[i, j]);
                j++;
            });
            i++;
        });
        
        $.post("pages-modules/pharmacy/OptionsPages/AlmacenarSalidasMedicamentosRecetaScript.php", {matrizEntradaMedicamento: matrizEntradaMedicamento});
        
    });
    
    $("#btnBuscarMedicamentoBM").click(function(){
        var nombreMedicamento = $("#txtMedicamentoBM").val();
        
        $("#selectpicker option").filter(function() {
            return $(this).text().toLowerCase() == nombreMedicamento.toLowerCase(); 
        }).prop('selected', true);
    });
    
    $("#btnnuevoMedicamento").click(function(){

        $("#myModal").modal("show");
        
        $("#txtNombreMedicamento").val(null);
        $("#txtNombreFabricante").val(null);
        $("#txtUnidadMedida").val(null);
        $("#txtDescMedicamento").val(null);
    });
    
    var bandera = false;
    
    $("#btnIngresarMedicamento").click(function(){
        if(!$.trim($("#txtNombreMedicamento").val()) || !$.trim($("#txtNombreFabricante").val()) || 
                !$.trim($("#txtUnidadMedida").val()) || !$.trim($("#txtDescMedicamento").val())){
            alert("Introduzca todos los Datos");
        }
        else{
            var matrizNuevoMedicamento = [$("#txtNombreMedicamento").val(), $("#txtNombreFabricante").val(), $("#txtUnidadMedida").val()
                , $("#txtDescMedicamento").val()];
            
            $("#myModal").modal("hide");
           
            $.post("pages-modules/pharmacy/OptionsPages/AlmacenarSalidasMedicamentosRecetaScript.php", {matrizNuevoMedicamento: matrizNuevoMedicamento}, function(data){
                //alert("data: " + data);
                matrix = $.parseJSON(data);
                
                $("#selectpicker").append("<option>"+matrix[matrix.length - 1].NombreMedicamento+"</option>");
                
                //alert(matrix.length - 1);
            });
        }
    });
});