<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../../../conection/conection.php';

if(isset($_POST['codMedicamento'])){
    $value = $_POST['codMedicamento'];
    
    $statment = $db->prepare('CALL Existencias(?)');
    $statment->bindValue(1, $value);
    
    $statment->execute();
    
    $contadorFilas = $statment->rowCount();
    if($contadorFilas >= 1){
        $medicamento = $statment->fetchALL(PDO::FETCH_ASSOC);
    }
    
    echo json_encode($medicamento);
    
    $statment->nextRowSet();
    $statment->closeCursor();
}


if(isset($_POST['matrizNuevoMedicamento'])){
    $matrizNuevoMedicamento = $_POST['matrizNuevoMedicamento'];
    
    $stament = $db->prepare("CALL almacenarNuevoMedicamento(?,?,?,?)");
    $stament->bindValue(1, $matrizNuevoMedicamento[0]);
    $stament->bindValue(2, $matrizNuevoMedicamento[1]);
    $stament->bindValue(3, $matrizNuevoMedicamento[3]);
    $stament->bindValue(4, $matrizNuevoMedicamento[2]);
    
    $stament->execute();
    $stament->closeCursor();
    
    
    $statment = $db->prepare("CALL SP_Inventario()");
    $statment->execute();

    $contadorFilasMed = $statment->rowCount();

    if($contadorFilasMed >= 1){
        $tablaMed = $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($tablaMed);
    
    $statment->nextRowSet();
    $statment->closeCursor();
}

if(isset($_POST['matrizEntradaMedicamento'])){
    $matrix = $_POST['matrizEntradaMedicamento'];
    
    $lenght = count($matrix);
    
    $numFilas = $lenght/4;
    
    $index = 0;
    
    for($m = 0; $m < $numFilas; $m++){
        for($n = 0; $n < 4; $n++){
            $arreglo[$m][$n] = $matrix[$index];
            $index++;
            
            echo $arreglo[$m][$n];
            echo ' ';
        }
    }
    
    $stament = $db->prepare('CALL nuevaEntrada()');
    $stament->execute();
    $stament->closeCursor();
    
    for($fila = 0; $fila < $numFilas; $fila++){
        $statmentNuevaEntrada = $db->prepare('CALL insertEntradaMedicamentoInventario(?,?,?)');
        $statmentNuevaEntrada->bindValue(1, $arreglo[$fila][0]);
        $statmentNuevaEntrada->bindValue(2, $arreglo[$fila][3]);
        $statmentNuevaEntrada->bindValue(3, $arreglo[$fila][2]);
        
        $statmentNuevaEntrada->execute();
        
        $statmentNuevaEntrada->closeCursor();
    }
}

if(isset($_POST['matriz'])){
    $matriz = $_POST['matriz'];
    
    $lenght  = count($matriz);
    //echo $lenght;
    
    $numFilas = $lenght/4;
    //echo $numFilas;
    $index = 0;
    
    for($m = 0; $m < $numFilas; $m++){
        for($n = 0; $n < 4; $n++){
            $arreglo[$m][$n] = $matriz[$index];
            $index++;
            //echo $arreglo[$m][$n];
            //echo ' ';
        }
        //echo $matriz[$numFilas];
    }
    
    $statmentNuevaSalida = $db->prepare('CALL SP_nuevaSalida()');
    $statmentNuevaSalida->execute();
    $statmentNuevaSalida->closeCursor();
    
    for($m = 0; $m < $numFilas; $m++){
        $statment = $db->prepare('CALL insertSalidaMedicamentoReceta(?,?)');
        $statment->bindValue(1, $arreglo[$m][0]);
        $statment->bindValue(2, $arreglo[$m][3]);
        
        $statment->execute();
        
        $statment->closeCursor();
    }
}
?>