<!DOCTYPE html>
<!--
Ingeniería del software

Este archivo manejará de forma dinámica todo el funcionamiento del sistema
-->

<!--
- Aqui se maneja un evento tal que si se cierra una pestaña o el navegador
    se deslogue el usuario en la base de datos
-->
<!--
<script language="JavaScript" type="text/javascript">
    window.onbeforeunload = out;
    
    function out()
    {
	$.ajax("login/close.php");
    }
</script>
-->

<!---
- Se incluye el archivo security.php donde se valida la seguridad del sistema
- Se convina la pagina index.php con las paginas head.php y home.php
--->
<div class="container">
<?php
    include 'login/security.php';
    require_once 'pages-modules/head.php';
?>

<!---
Este será el div donde se colocará toda la información del sistema dinamicamente
--->
<div id="principalContainer">
    <?php    require_once 'carousel.php' ?>
</div>

<!---
Se convina además con el archivo footer.php
--->
<?php
    require_once 'pages-modules/footer.php';
?>
</div>

<script language="JavaScript" type="text/javascript">
    window.onbeforeunload = accionAntesDeSalir;
    function accionAntesDeSalir()
    {
	$.ajax("login/eventoCerrarPestaña.php");
    }
</script>