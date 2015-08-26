<!DOCTYPE html>
<!--
Ingeniería del software
-->
<?php
    require_once 'menuOptions.php';
?>


<!-- Main -->
<div class="container-fluid" >
    <div class="row">
        <div class="col-sm-9" id="escritorio"> 
            
        </div>   
    </div>
</div>

<script>
  $(document).ready(function(){
     $("#escritorio").load("pages-modules/medical_consultations/control_de_citas.php" );
  });
</script>