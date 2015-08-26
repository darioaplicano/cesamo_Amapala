<!doctype html>
<html>
<head>
<title></title>

<script type="text/javascript">

    window.addEventListener('load', inicio, false);

    function inicio() {
        document.getElementById("formulario1").addEventListener('submit', validar, false);
    }

    function validar(evt) {
        var cla1 = document.getElementById("clave1").value;
        var cla2 = document.getElementById("clave2").value;
        if (cla1!=cla2) {
            alert('Las claves ingresadas son distintas');
            evt.preventDefault();
        }
    }

</script>

</head>
<body>

<form method="post" action="procesar.php" id="formulario1">
Ingrese clave:
<input type="password" id="clave1" name="clave1" size="20" required>
<br>
Repita clave:
<input type="password" id="clave2" name="clave2" size="20" required>
<br>
<input type="submit" id="confirmar" name="confirmar" value="Confirmar">
</form>

</body>
</html>
