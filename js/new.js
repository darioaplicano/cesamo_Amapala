$(document).ready(function() {
    $("#homes").click(function(event) {
        event.preventDefault();
        $("#principalContainer" ).load("carousel.php");
    });
});