$(document).ready(function() {
    $("#nursings").click(function(event) {
        event.preventDefault();
        $("#principalContainer" ).load("pages-modules/nursing/principal.php" );
    });
});

