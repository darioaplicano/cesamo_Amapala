<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../../../conection/conection.php';

$statment = $db->prepare('CALL SP_Inventario()');
$statment->execute();

$contadorFilas = $statment->rowCount();

if($contadorFilas >= 1){
    $tabla = $statment->fetchAll(PDO::FETCH_ASSOC);
}

$statment->nextRowSet();
$statment->closeCursor();

?>

<link rel="stylesheet" href="pages-modules/pharmacy/OptionsPages/Style.css">
<script src="pages-modules/pharmacy/js/sunnywalker-jQuery.FilterTable-d31cd14/jquery.filtertable.js"></script>
<script src="pages-modules/pharmacy/js/Inventariojs.js"></script>


<style>
.filter-table .quick { margin-left: 0.5em; font-size: 0.8em; text-decoration: none; }
.fitler-table .quick:hover { text-decoration: underline; }
td.alt { background-color: #ffc; background-color: rgba(255, 255, 0, 0.2); }
</style>

<div class="page-header">
    <h2>Inventario</h2>
</div>

<div class="well container-fluid">
    <div style="margin-top: 30px; height: 510px; overflow: auto; overflow-x: auto;">
        <table id="tablaInventario" class="table table-bordered table-striped table-responsive table-hover table-condensed fitler-table" style="width: 1000px">
            <thead>
            <tr>
                <th style="width: 80px">Cod.</th>
                <th style="width: 250px">Nombre</th>
                <th style="width: 250px">Fabricante</th>
                <th style="width: 300px">Descripci&oacute;n</th>
                <th style="width: 70px">Existencia</th>
                <th style="width: 190px">Unidad de Medida</th>
            </tr>
            </thead>
            <?php
            echo '<tbody>';
            foreach ($tabla as $fila) {
                echo '<tr class="active">'.
                        '<td>'.$fila['CodMedicamento'].'</td>'.
                        '<td>'.$fila['NombreMedicamento'].'</td>'.
                        '<td>'.$fila['NombreFabricante'].'</td>'.
                        '<td>'.$fila['Descripcion'].'</td>'.
                        '<td>'.$fila['Existencia'].'</td>'.
                        '<td>'.$fila['UnidadMedida'].'</td>'.
                        '</tr>';
            }
            echo '</tbody>';
            ?>
        </table>
    </div>
</div>