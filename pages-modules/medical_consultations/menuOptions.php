<script type="text/javascript"> 
	$("#buscar").click(function(event){
			
			$("#escritorio").load("pages-modules/medical_consultations/control_de_citas.php");
			$("#opc2").removeAttr('class');
        	$("#opc3").removeAttr('class');
        	$("#opc4").removeAttr('class');
        	$("#opc1").removeAttr('class');

        	$("#opc1").attr("class","active");
        	
	});

	$("#buscarDos").click(function(event){
		
		$("#escritorio").load("pages-modules/medical_consultations/Consulta.php");
			$("#opc1").removeAttr('class');
			$("#opc2").removeAttr('class');
			$("#opc3").removeAttr('class');
        	$("#opc4").removeAttr('class');

        	$("#opc3").attr("class","active");
        	
	});

	$("#buscarTres").click(function(event){
		$("#escritorio").load("pages-modules/medical_consultations/generar_receta.php");
			$("#opc1").removeAttr('class');
			$("#opc2").removeAttr('class');
			$("#opc3").removeAttr('class');
        	$("#opc4").removeAttr('class');

        	$("#opc4").attr("class","active");
	});

	$("#buscarCuatro").click(function(event){
		$("#escritorio").load("pages-modules/medical_consultations/ver_expediente.php");
			$("#opc1").removeAttr('class');
			$("#opc2").removeAttr('class');
			$("#opc3").removeAttr('class');
        	$("#opc4").removeAttr('class');

        	$("#opc2").attr("class","active");
	});

</script>

<div class="span3 col-sm-2">
    <ul  class="nav nav-pills nav-stacked">
        <li role="presentation"  class="active" id="opc1"><a id="buscar" class="button">Control De Citas</a></li>
        <li role="presentation" id="opc2"><a id="buscarCuatro" class="button">Ver Expediente</a></li>
        <li role="presentation" id="opc3"><a id="buscarDos" class="button">Consulta</a></li>
        <li role="presentation" id="opc4"><a id="buscarTres" class="button">Generar Receta</a></li>

    </ul>
</div>