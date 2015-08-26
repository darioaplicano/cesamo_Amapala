<?php 
    $listaProductos = json_decode($_POST['productos']);
 	$respuesta = "";
    foreach($listaProductos as $producto)
    {
        $respuesta = $respuesta."<tr><td>".$producto->codigo."</td><td>".$producto->nombre."</td><td>".$producto->cantidad."</td><td>".$producto->tratamiento."</td></tr>";
    }
    echo $respuesta;
?>