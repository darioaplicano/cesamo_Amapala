<script type="text/javascript"> 
	$("#btnControlDeCitas1").click(function(event){
			
			$("#ContenedorRecepcion").load("pages-modules/reception/control_de_citas.php?");
	});
        
        $("#btnControlDeCitas2").click(function(event){
			
			$("#ContenedorRecepcion").load("pages-modules/reception/BuscarEmpleado.php?");
	});
        
        
        
</script>



<div class="span3 col-sm-3">
    <nav>
                    <ul class="nav nav-pills nav-stacked">
                        <li id="btnControlDeCitas1" role="button" onclick="loadXMLdoc(this.id)">
                           <a href="#">Control De Citas<span class="glyphicon glyphicon-chevron-right pull-right"></span></a>
                        </li>
                        <li id="btnControlDeCitas2" role="button" onclick="loadXMLdoc(this.id)">
                           <a href="#">Control De Empleados<span class="glyphicon glyphicon-chevron-right pull-right"></span></a>
                        </li>
                    </ul>
                </nav>
</div>
