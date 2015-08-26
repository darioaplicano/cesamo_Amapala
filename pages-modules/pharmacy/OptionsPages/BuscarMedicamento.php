<?php
header("Content-Type: text/javascript; charset=utf-8");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../../../conection/conection.php';

$statment = $db->prepare("CALL SP_Inventario()");
$statment->execute();

$contadorFilas = $statment->rowCount();

if($contadorFilas >= 1){
    $tabla = $statment->fetchAll(PDO::FETCH_ASSOC);
}

$statment->nextRowSet();
$statment->closeCursor();
?>

<link rel="stylesheet" type="text/css" href="pages-modules/pharmacy/OptionsPages/Style.css">
<script src="pages-modules/pharmacy/OptionsPages/AlmacenarSalidasMedicamentosRecetaScript.php"></script>

<script type="text/javascript">
    var matrix = <?php echo json_encode($tabla); ?>;
</script>

<div class="page-header">
    <h3>Buscar Medicamento</h3>
</div>

<div class="container-fluid">
    <div class="form-inline">
        <input id="txtMedicamentoBM" type="text" class="form-control" placeholder="Nombre del medicamento">
        <button id="btnBuscarMedicamentoBM" class="btn btn-success">Buscar Medicamento</button>
    </div>
    
    <div style="margin-top: 30px; border: 1px solid gainsboro; border-radius: 5px; padding-top: 10px; padding-bottom: 10px " class="row"><!--Ojo con el uso de row para el uso de col-md-4 -->        
        <div class="col-md-4">
            <span class="label label-default col-md-12"><h6>Seleccione el Medicamento</h6></span>
            <select multiple id="selectpicker" class="form-control" style="height: 150px; margin-top: 10px">
                <!--Se llena con codigo javascript-->
            </select>
        </div>
        <div class="col-md-8 form-horizontal">
            <span class="label label-default">Agregue los Datos sobre el Medicamento</span>
            <div class="row form-horizontal" style="margin-top: 10px"><!--IMPORTANTE PARA QUE NO SE GENENRE PADDING EN LE DIV AGREGAR ROW-->
                <div class="col-md-7">
                    <div class="input-group">
                        <label>Cantidad de Medicamento</label>
                        <input id="cantMedicamento" type="number" class="form-control" min="0" placeholder="Cantidad">
                        <label>Fecha de Vencimiento del Medicamento</label>
                        <input id="expMedicamento" type="date" class="form-control" placeholder="Fecha de Vencimiento">
                    </div>
                </div>
                
                <div class="col-md-5">
                    <button id="addMedicamento" class="btn btn-success" style="width: 100%; margin-top: 25px; margin-bottom: 25px" type="button">Agregar Medicamento</button>
                    <button id="btnnuevoMedicamento" class="btn btn-success" style="width: 100%;">Nuevo Medicamento</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="well row">
        <div style="height: 300px; overflow: auto; overflow-x: visible; margin-bottom: 10px">
            <table id="tablaMedicamentosEntrada" class="table table-bordered table-striped table-responsive">
                <tr id="tr">
                    <th style="width: 35px;">Cod.</th>
                    <th>Medicamento</th>
                    <th>Fecha Exp</th>
                    <th class="cantEntregada">Cantidad</th>
                </tr>
                <!--Se llena con jquery-->
            </table>
        </div>
        <button class="btn btn-success" id="btnRegistrarEntradaMedicamentos">Registrar Entrada de Medicamentos</button>
    </div>
    
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <!-- Botón para cerrar la ventana -->
                    <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                    </button>
            <!-- Título de la ventana -->
                    <h3 class="title">Nuevo Medicamento</h3>
          </div>

          <div class="modal-body">
              <div role="form" class="form-group form-horizontal">
                  <label class="label label-default">Nombre Medicamento</label>
                    <input style="margin-bottom: 10px; margin-top: 5px; width: 300px" class="form-control" id="txtNombreMedicamento" type="text">
                    
                    <label class="label label-default">Nombre Fabricante</label>
                    <input style="margin-bottom: 10px; margin-top: 5px; width: 300px" class="form-control" id="txtNombreFabricante" type="text">
                  
                    <label class="label label-default">Unidad de Medida</label>
                    <input style="margin-bottom: 10px; margin-top: 5px; width: 300px" class="form-control" id="txtUnidadMedida" type="text">                    
                    
                    <label class="label label-default">Descripcion del Medicamento</label>
                    <textarea id="txtDescMedicamento" style="margin-bottom: 10px; margin-top: 5px; height: 100px" class="form-control"></textarea>
                    
              </div>
          </div>
            
            <div class="modal-footer">
                <button id="btnIngresarMedicamento" class="btn btn-success">Ingresar Medicamento</button>
            </div>
        </div>
      </div>
    </div>
</div>
<script src="pages-modules/pharmacy/js/BuscarMedicamentojs.js" type="text/javascript"></script>
