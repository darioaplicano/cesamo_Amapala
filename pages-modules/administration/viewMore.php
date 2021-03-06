<?php
    $codE = $_GET['codE'];
    include '../../conection/conection.php';
    $stmt = $db->prepare("CALL  viewUser(?)");
    $stmt->execute(array($codE));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row){
        $userName       = $row['userName'];
        $creationdate   = $row['creationdate'];
        $datemodified   = $row['datemodified'];
        $disablingdate  = $row['disablingdate'];
        $status         = $row['status'];
        $log            = $row['log'];
        $nameC          = $row['nameC'];
        $image = $codE.".jpg";
        echo 
<<<HTML
        <div class="profile-header-container">
                <img class="img-circle" src="images/profile/$image" id="profile"/>
                <div class="rank-label-container">
HTML;
                    if($log == 1)
                        echo "<span class='badge alert-success'>Conectado</div>";
                    else
                        echo "<span class='badge alert-danger'>Desconectado</div>";
        echo
<<<HTML
        </div>
            <h3>$nameC</h3>
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="formGroup">
                        Usuario
                    </label>
                    <div class="col-sm-6">
                        <label class="form-control">$userName</label>
                        <input id="userName" value=$codE hidden>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="formGroup">
                        Fecha de creación
                    </label>
                    <div class="col-sm-6">
                        <label class="form-control">$creationdate</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="formGroup">
                        Fecha de modificación
                    </label>
                    <div class="col-sm-6">
                        <label class="form-control">$datemodified</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="formGroup">
                        Estado
                    </label>
                    <div class="input-group col-sm-6" style="padding-left: 14px;">
HTML;
                    if($status == 1)
                        echo 
<<<HTML
                        <label class='form-control' id="status">Activo</label>
                        <span class="input-group-addon alert-danger disabling"
                            role="button" id="action">
                            <i class="fa fa-power-off"></i>
                        </span>
HTML;
                    
                    else
                        echo 
<<<HTML
                        <label class='form-control' id="status">
                            Deshabilitado - $disablingdate
                        </label>
                        <span class="input-group-addon alert-success active"
                            role="button" id="action">
                            <i class="fa fa-power-off"></i>
                        </span>
HTML;
        echo
<<<HTML
                    </div>
                </div>
HTML;
    }
?>
<script>
    $(document).ready(function() {
        $('.active').tooltip({
            placement: 'rigth',
            title: 'Activar usuario'
        });
        $('.active').click(function(){
            action = 2;
            username = $("#userName").val();
            status = 1;
            $.get('pages-modules/administration/actions.php',{ user: username, status: status, action: action}, function(html){
                $("#status").html(html);
                $("#action").removeClass("active");
                $("#action").addClass("disabling");
                $("#action").removeClass("alert-success");
                $("#action").addClass("alert-danger");
            });
        });
        $('.disabling').tooltip({
            placement: 'rigth',
            title: 'Desactivar usuario'
        });
        $('.disabling').click(function(){
            action = 2;
            username = $("#userName").val();
            status = 0;
            $.get('pages-modules/administration/actions.php',{ user: username, status: status, action: action}, function(html){
                $("#status").html(html);
                $("#action").removeClass("disabling");
                $("#action").addClass("active");
                $("#action").removeClass("alert-danger");
                $("#action").addClass("alert-success");
            });
        });
    });
</script>