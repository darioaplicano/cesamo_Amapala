$(document).ready(function() {
    $("#buscar").click(function(event) {
        event.preventDefault();
        $("#contenidoAdministracion").load("pages-modules/administration/index.php" );
    });
});