<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../../../conection/conection.php';

$codReceta;

if(isset($_POST["codReceta"])){
    $codReceta = $_POST["codReceta"];
    $statment = $db->prepare("CALL selectDataRecipe(?)");

    $statment->bindValue(1, $codReceta);
    $statment->execute();
    $contadorFilas = $statment->rowCount();
    
    $bandera = FALSE;
    
    if($contadorFilas == 0){
        echo '<h4>La receta con ese codigo no existe!</h4>';
        $codReceta = "-------";
        $codConsulta = "-------";
        $fecha = "-------";
        $nombreMedico = "-------";
    }
    else{
        if($contadorFilas == 1){
            $filas = $statment->fetchAll(PDO::FETCH_ASSOC);
            foreach ($filas as $fila){
                $codRecetabd = $fila['CodReceta'];
                $codConsulta = $fila['codconsulta'];
                $fecha = $fila['fecha'];
                $nombreMedico = $fila['firma'];
            }
            $statment->nextRowSet();
            $statment->closeCursor();
        
        
            $statment2 = $db->prepare("CALL tablaMedicamentoReceta(?)");
            $statment2->bindValue(1, $codReceta);
            $statment2->execute();
        
            $contadorFilasTabla = $statment2->rowCount();
        
            if($contadorFilasTabla >= 1){
                $filasTablas = $statment2->fetchAll(PDO::FETCH_ASSOC);
                $bandera = TRUE;
            }
            else{
                $bandera = FALSE;
            }
        
            if($contadorFilasTabla == 0){
                echo 'No existen registro de recetas medicas'; 
            }
        
            if($codRecetabd == NULL){
                echo 'No existe la receta con el codigo dado';
            }
        }
    }
}
else{
    echo 'Error con el codigo enviado';
}


//if(isset($_POST['matriz'])){
//    echo 'Hola Mundo';
//    //$matriz = $_POST['k'];
////    echo $matriz[0][0];
//}
?>

<link rel="stylesheet" href="pages-modules/pharmacy/OptionsPages/Style.css">
<script src="pages-modules/pharmacy/js/jsBuscarReceta.js"></script>

<div class="page-header">
    <h3>Receta Medica</h3>
</div>

<div id="divDatosReceta" class="form-group text-muted container-fluid">
    <!--Columna 1-->
    <div class="col-sm-6">
        <div class="divClass">
            C&oacute;digo de Receta: <label id="CodReceta"><?php echo $codReceta;?></label>
        </div>
        <div>
            C&oacute;digo de Consulta: <label id="CodConsulta"><?php echo $codConsulta;?></label>
        </div>
    </div>
    <!--Columna 2-->
    <div class="col-sm-6">
        <div class="divClass">
            Medico: <label id="nombreMedico"><?php echo $nombreMedico;?></label>
        </div>
        <div>
            Fecha: <label id="fecha"><?php echo $fecha;?></label>
        </div>
    </div>
</div>

<div id="TablaMedicamentos" class="well">
    <div class="text-center" style="margin-top: -10px">
        <h4>Medicamentos</h4>
    </div>
    <table id="tablaMedicamentosReceta" class="table table-bordered table-striped">
        <tr>
            <th style="width: 35px;">Cod.</th>
            <th>Medicamento</th>
            <th class="cantEntregada">Cantidad</th>
            <th class="cantEntregada">Cantidad Entregada</th>
        </tr>
        <?php
            if($bandera == TRUE){
                foreach ($filasTablas as $filaTabla){
                    echo '<tr>'
                        .'<td>'.$filaTabla['codmedicamento'].'</td>'
                        .'<td>'.$filaTabla['nombremedicamento'].'</td>'
                        .'<td>'.$filaTabla['cantidad'].'</td>'
                        .'<td><input min="0" type="number" class="form-control inputTablaMedicamento"></td>'
                    .'</tr>';
                }
            }
            else
            {
                echo'<tr>'
                    .'<td>No Hay medicamentos</td>'
                    .'<td>No Hay medicamentos</td>'
                    .'<td>No Hay medicamentos</td>'
                    .'<td>No Hay medicamentos</td>'
                . '</tr>';
            }
        ?>
    </table>
    <button class="btn btn-success" id="btnRegistrarSalidaMedicamentos">Registrar Salida de Medicamentos</button>
</div>