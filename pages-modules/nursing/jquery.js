   $(document).ready(function() {
   
    $("#btnBuscarExpedientes").click(function(event) {
        event.preventDefault(); 
         
           $("#ContenedorEnfermeria").load("pages-modules/nursing/BuscarExpedientes.php?" );
         
           
    });
    
    $("#btnPreclinica").click(function(event) {
        event.preventDefault(); 
           $("#ContenedorEnfermeria").load("pages-modules/nursing/CrearFormularioPreclinica.php?" );
          
    });   
}); 
