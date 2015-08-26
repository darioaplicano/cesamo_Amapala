$(document).ready(function() {
    // Evento dado para el módulo de recepción
    $("#reception").click(function(event) {
        event.preventDefault(); 
        $("#principalContainer").load("pages-modules/reception/principal.php" );
    });
    // Evento dado para el módulo de médicos
    $("#medical").click(function(event) {
        event.preventDefault();
        $("#principalContainer" ).load("pages-modules/medical_consultations/principal.php" );
    });
    // Evento dado para el módulo del usuario
    $("#user").click(function(event) {
        event.preventDefault();
        $("#principalContainer" ).load("pages-modules/user/principal.php" );
    });
    // Evento dado para el módulo administrativo
    $("#admin").click(function(event) {
        event.preventDefault();
        $("#principalContainer" ).load("pages-modules/administration/principal.php" );
    });
    // Evento dado para el módulo administrativo
    $("#regente").click(function(event) {
        event.preventDefault();
        $("#principalContainer" ).load("pages-modules/pharmacy/principal.php" );
    });
}); 

