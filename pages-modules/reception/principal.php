<!DOCTYPE html>
<!--
Ingeniería del software
-->
<?php
    session_start();
    if(isset($_GET['content'])){
        $content = $_GET['content'];
    }
    else{
        $content = 'reception';
    }
    require_once 'menuOptions.php';
?>

<!-- Main -->
<div class="container-fluid" >
    <div class="row">
        <div class="col-sm-9"> 
            <div class="row">
                <div class="col-md-12">
                    <div class="featurette">
                        <div id="ContenedorRecepcion" class="alert alert-success">
                          <!--<h1>Esta es la Seccion de las enfermeras si Edwin vos estas aqui</h1>-->
                        </div>
                  </div>
                </div>
            </div>
        </div>   
    </div>
</div>

<script>
  $(document).ready(function(){
     $("#ContenedorRecepcion").load("pages-modules/reception/control_de_citas.php" );
  });
</script>