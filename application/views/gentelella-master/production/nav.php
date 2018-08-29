<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Raven Rubber Home </title>

    <!-- Bootstrap -->
    <link href="<?= base_url();?>application/views/gentelella-master/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url();?>application/views/gentelella-master/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url();?>application/views/gentelella-master/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?= base_url();?>application/views/gentelella-master/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?= base_url();?>application/views/gentelella-master/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?= base_url();?>application/views/gentelella-master/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?= base_url();?>application/views/gentelella-master/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url();?>application/views/gentelella-master/build/css/custom.min.css" rel="stylesheet">
  </head>
  <script type="text/javascript">
    var variable = Array();
    variable['num_empleado'] = '<?=$num_empleado?>'; 
  </script>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?= base_url();?>index.php/home" class="site_title"> <span><?=$empresa;?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?= base_url();?>application/views/gentelella-master/images/img.jpg" alt="..." class="img-circle profile_img" hidden>
              </div>
              <div class="profile_info">
                <h2>Bienvenido, <?= $nombre?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <?php
                    $dashboardOperador = "<li><a href='".base_url()."index.php/home/dashboardOperador'><i class='fa fa-bar-chart-o'></i> Dashboard Operador</a>";

                    $presentacion = "<li><a href='".base_url()."index.php/home/presentacion'><i class='fa fa-play-circle'></i> Presentación </a>";
                    $presentacionAdmin = "<li><a href='".base_url()."index.php/home/presentacionAdmin'><i class='fa fa-play-circle'></i> Presentación Admin </a>";

                    $dashboardGeneral = "<li><a><i class='fa fa-bar-chart-o'></i> Dashboard<span class='fa fa-chevron-down'> </span></a><ul class='nav child_menu'><li><a href='".base_url()."index.php/home/dashboardGeneral'>Dashboard General</a></li><li><a href='".base_url()."index.php/home/dashboardGeneralFiltro'>Dashboard Filtros</a></li></ul>";

                    $reporteProduccion = " <li><a><i class='fa fa-edit'></i> Reporte de Producción <span class='fa fa-chevron-down'></span></a> <ul class='nav child_menu'> <li><a href='".base_url()."index.php/home/reporte_produccion'>Registro de Máquina</a></li> <li><a href='".base_url()."index.php/home/reporte_produccion_hr'>Registro Hora x Hora</a></li> </ul> </li>";

                    $Descargas = "<li><a><i class='fa fa-cloud-download'></i> Descargas <span class='fa fa-chevron-down'></span></a> <ul class='nav child_menu'> <li><a href='".base_url()."index.php/home/descargas'>Reporte Producción</a></li><li><a href='".base_url()."index.php/home/descargaScrap'>Reporte Scrap</a></li><li><a href='".base_url()."index.php/home/descargaTiempo'>Reporte TM</a></li> </ul> </li>";

                    $Ajustes = "<li><a><i class='fa fa-cogs'></i> Ajustes <span class='fa fa-chevron-down'></span></a> <ul class='nav child_menu'> <li><a href='".base_url()."index.php/home/matriz_maquinas'>Matriz Maquinas</a></li><li><a href='".base_url()."index.php/home/ajustes'>Empleados</a></li><li><a href='".base_url()."index.php/home/modulo_modificacion'>Modificación de Registros</a></li> </ul> </li>";

                    $ajustesEmpleados = '<a> <span  >&nbsp;</span> </a>';

                  if ($departamento == 'OPERADOR' || $departamento == 'Operador') {
                    echo $reporteProduccion;
                    echo $dashboardOperador;
                    echo $dashboardGeneral;
                    echo $presentacion;
                    echo $presentacionAdmin;
                  }else if ($departamento == 'Admin') {
                    $ajustesEmpleados = "<a data-toggle='tooltip' data-placement='top' title='Ajustes' href='".base_url()."index.php/home/ajustes'> <span class='glyphicon glyphicon-cog' aria-hidden='true'></span> </a>";
                    echo $dashboardGeneral;
                    echo $Descargas;
                    echo $Ajustes;
                  }else{
                    echo $dashboardGeneral;
                    echo $Descargas;
                  }
                  ?>


                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <?= $ajustesEmpleados;?>
              <a>
                <span  >&nbsp;</span>
              </a>
              <a>
                <span  >&nbsp;</span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= base_url();?>index.php/login/logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""><?= $empresa?>/<?= $departamento?> : <?= $num_empleado;?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
                      <a href="<?= base_url();?>index.php/home/ajustes">
                        <span>Ajustes</span>
                      </a>
                    </li>
                    <li><a href="<?= base_url();?>index.php/login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

