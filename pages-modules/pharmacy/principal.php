
<?php
    require_once 'menuOptions.php';
?>

<!-- Main -->
<div class="container-fluid" >
    <div class="row">
        <div class="col-sm-9" id="adminArea"> 
            
        </div>   
    </div>
</div>

<script>
  $(document).ready(function(){
     $("#adminArea").load("pages-modules/pharmacy/OptionsPages/BuscarReceta.php" );
  });
</script>
