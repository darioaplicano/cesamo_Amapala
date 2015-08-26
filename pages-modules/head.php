<!DOCTYPE html>
<!--
Ingeniería del software
-->
<?php
    //Se incluye el archivo para la conexión con la base de datos
    include 'conection/conection.php';
    
    /*
     *Se captura el rol y el codigo de usuario ya logueado para optener el
     * nombre del empleado con este codigo
     */
    $rol = $_SESSION['codRole'];
    $user = $_SESSION['codEmpleado'];
    
    //Se prepara la llamada al procedimiento, se ejecuta y captura el nombre
    $stmt = $db->prepare("CALL selectEmployed(?)");
    $stmt->execute(array($user));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row){
        $user = $row['name'];
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>CESAMO AMAPALA</title>
        <meta name = "viewport" content = "width = device-whidth, initial-scale=1">
        <!-- Estilos css -->
        <!-- Estilos de bootstrap -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        
        <!-- Estilos personales -->
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/style2.css" rel="stylesheet" type="text/css"/>
        <link href="css/style3.css" rel="stylesheet" type="text/css"/>
        <link href="css/style4.css" rel="stylesheet" type="text/css"/>
        <link href="css/style6.css" rel="stylesheet" type="text/css"/>
        <!-- Iconos -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        
        <!-- Validador de contraseñas -->
        <link href="bootstrap/css/site-demos.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header page-scroll">
                    <button type='button' class='navbar-toggle'
                        data-toggle='collapse' data-target='#headNavbar'>
                        <span class="sr-only">Navegación responsiva</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand page-scroll" href="#" rel="popover"
                       data-placement="bottom" data-content=""
                       data-original-title="">
                        <i class="fa fa-th"></i>
                    </a>
                    <a class="navbar-brand page-scroll" role="button" id="homes">CESAMO <small>AMAPALA</small></a>
                </div>
                <div class="collapse navbar-collapse" id="headNavbar">
                    <ul class="nav navbar-nav navbar-left">
                    <!-- Generacion del navbar  -->
                    <?php
                        // --------------------------------------------------------------
                        // pagina del - de la recepcionista
                        if($rol == 2){
                            echo <<<HTML
                                <li><a class="pages-scroll" role="button" id="reception">Recepcionista</a></li>
HTML;
                        }else{
                            echo <<<HTML
                                <li class="disabled"><a class="pages-scroll" role="button">Recepcionista</a></li>
HTML;
                        }
                        // --------------------------------------------------------------  
                        // página del médico
                        if($rol == 3){
                            echo <<<HTML
                                <li><a  class="pages-scroll" role="button" id="medical">Médico</a></li>
HTML;
                        }else{
                            echo <<<HTML
                                <li class="disabled"><a  class="pages-scroll" role="button">Médico</a></li>
HTML;
                        }
                        // --------------------------------------------------------------  
                        // página del regente de farmacia
                        if($rol == 4){
                            echo <<<HTML
                                <li><a  class="pages-scroll" role="button" id="regente">Regente de farmacia</a></li>
HTML;
                        }else{
                            echo <<<HTML
                                <li class="disabled"><a  class="pages-scroll" role="button">Regente de farmacia</a></li>
HTML;
                        }
                        // --------------------------------------------------------------  
                        // página de RRHH
                        if($rol == 5){
                            echo <<<HTML
                                <li><a  class="pages-scroll" role="button" id="resources">Recursos Humanos</a></li>
HTML;
                        }else{
                            echo <<<HTML
                                <li class="disabled"><a  class="pages-scroll" role="button">RR HH</a></li>
HTML;
                        }
                        
                        if($rol == 6){
                            echo <<<HTML
                                <li><a  class="pages-scroll" role="button" id="nursings">Enfermería</a></li>
HTML;
                        }else{
                            echo <<<HTML
                                <li class="disabled"><a  class="pages-scroll" role="button">Enfermería</a></li>
HTML;
                        }
                        // --------------------------------------------------------------
                    ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        //En esta parte se carga la del usuario según su rol
                        if($rol == 1){
                            echo <<<HTML
                                    <li class="dropdown">   
                                        <a id ="admin" role="button" class="fa fa-cogs" >
                                                Administración
                                        </a>
                                    </li> 
HTML;
                        }
                        ?>
                        <li class="dropdown">
                            <a id="user" role="button" class="fa fa-user">
                                <?php echo " ".$user; ?>
                            </a>
                        </li>
                        <li class="dropdown" >
                            <a href="login/login.php" role="button">
                               <i class="glyphicon glyphicon-log-out"></i> Salir
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <script src="bootstrap/js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <script src="js/functionsNavbar.js" type="text/javascript"></script>
        <script src="js/otherFunctionsNavbar.js" type="text/javascript"></script>
        <script src="js/other.js" type="text/javascript"></script>
        <script src="js/new.js" type="text/javascript"></script>
        <!-- Gráficos -->
        <script src="Highcharts/js/highcharts.js" type="text/javascript"></script>
        <!-- Validador de contraseñas -->
        <script src="bootstrap/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/jquery.validate.min.js" type="text/javascript"></script>
        <!-- Utililzado para encriptar y desencriptar contraseñas -->
        <script src="js/encrypt.js" type="text/javascript"></script>
        
        <script>
            $(function(){
                $('[rel=popover]').popover({ 
                    html : true, 
                    content: function() {
                      return $('#popover_content_wrapper').html();
                    }
                });
            });
        </script>

<div id="popover_content_wrapper" style="display: none;">
    <div class="col-sm-6">
        <div class="thumbnail alert-success" id="reception">
            <div class="profile-header-container" role="button"
                 >
                <span class="fa fa-pencil-square-o fa-5x"></span>
                <div class="rank-label-container">
                    <br>
                    <span class='badge alert-info'>Recepción</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="thumbnail alert-info">
            <div class="profile-header-container btn_add" role="button"
            data-toggle="modal" data-target="#addUser">
                <span class="fa fa-user-md fa-5x"></span>
                <div class="rank-label-container">
                    <br>
                    <span class='badge alert-info'>Médico</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="thumbnail alert-link">
            <div class="profile-header-container btn_add" role="button"
                 data-toggle="modal" data-target="#addUser">
                <span class="fa fa-medkit fa-5x"></span>
                <div class="rank-label-container">
                    <br>
                    <span class='badge alert-info'>Farmacia</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="thumbnail alert-warning">
                <div class="profile-header-container btn_add" role="button"
                    data-toggle="modal" data-target="#addUser">
                    <span class="fa fa-users  fa-5x"></span>
                    <div class="rank-label-container">
                        <br>
                        <span class='badge alert-info'>RRHH</span>
                    </div>
                </div>
        </div>
    </div>
</div>
    </body>
</html>
