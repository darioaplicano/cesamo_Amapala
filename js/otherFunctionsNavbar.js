$(document).ready(function() {
    // Evento dado para el módulo de RRHH
    $("#resources").click(function(event) {
        event.preventDefault();
        $("#principalContainer" ).load("pages-modules/humanResources/principal.php" );
    });
});