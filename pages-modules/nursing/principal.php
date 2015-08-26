<!DOCTYPE html>
<!--
Ingeniería del software
-->
<?php
    require_once 'menuOptions.php';
?>
<head>
    <script src="pages-modules/nursing/jquery.js" type="text/javascript" language="javascript">
    </script>
</head>
<!-- Main -->
<div class="container-fluid" >
    <div class="row">
        <div class="col-sm-9"> 
            <div class="row">
                <div class="col-md-12">
                    <div class="featurette">
                        <div class="alert alert-success" id="ContenedorEnfermeria">
                            <div id="ContenedorEnfermeria2">
                                
                            </div>
                        </div>
                  </div>
                </div>
            </div>
        </div>   
    </div>
</div>
<div id="probar">
    
</div>

<script>
  $(document).ready(function(){
     $("#ContenedorEnfermeria").load("pages-modules/nursing/BuscarExpedientes.php" );
  });
</script>