/* 
Ingeniería del software
*/
$(document).ready(function() {
    $("#usersAdmin").click(function(event) {
        event.preventDefault();
        $("#contentAdministration").load("pages-modules/administration/usersAdministration.php" );
    });

    $("#usersLogs").click(function(event) {
        event.preventDefault();
        $("#contentAdministration").load("pages-modules/administration/logs.php" );
    });
    
    $("#binnacle").click(function(event) {
        event.preventDefault();
        $("#contentAdministration").load("pages-modules/administration/binnacle.php" );
    });
});