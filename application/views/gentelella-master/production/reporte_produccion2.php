
<?php
  //$date.timezone =America/Mexico_City
if( ! ini_get('date.timezone') )
  {
    //date_default_timezone_set('America/Monterrey');
    ini_set("date.timezone","America/Monterrey");
  }
  $date_db= date("Y-m-d H:i:s");
  //$date= date("d/m");
  $date= date("Y-m-d H:i:s");

  $fechaTurno = strtotime ( '-5 hour' , strtotime ( $date ) ) ;
  $fechaNow = date ( 'Y-m-d H:i:s' , $fechaTurno );
  $dateNow = date ( 'Y-m-d' , $fechaTurno );
  $fechaTurno = date ( 'H:i' , $fechaTurno );

  /*if ($fechaTurno >= '06:00' && $fechaTurno<= '14:29') {
    $arrTurno = array('07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '14:30');
    $turno = "1";
    //valTurno("Mañana",$arrTurno);
  }else if ($fechaTurno >= '14:30' && $fechaTurno<= '22:29') {
    $arrTurno = array('15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:30');
     $turno = "2";
    //$btn_reg = valTurno("Tarde",$arrTurno);
  }else {
    $arrTurno = array('11:00', '12:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00');
     $turno = "3";
    //valTurno("Noche",$arrTurno);
  }*/

  //Turnos de 12 horas
  if ($fechaTurno >= '07:00' && $fechaTurno<= '19:00') {
    $arrTurno = array('08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00','15:00', '16:00', '17:00', '18:00', '19:00');
    $turno = "1";
    //valTurno("Mañana",$arrTurno);
  }else{
    $arrTurno = array('19:00', '20:00', '21:00', '22:00','23:00','00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00','07:00');
     $turno = "2";
    //$btn_reg = valTurno("Tarde",$arrTurno);
  }

  $btn_reg = "<div class='col-md-12 col-sm-12 col-xs-12' style='text-align: center;'>";
  foreach ($arrTurno as $key => $value) {
    $btn_reg .= "<a class='btn btn-primary' id='".$key."' onclick='regHora(".$key.")'>".$value."</a>";
  }
  $btn_reg .= "</div>";


/*function valTurno($turno,$reg){
  $btn_reg = "<div class='col-md-6 col-sm-6 col-xs-12 col-md-offset-3'>";
  foreach ($reg as $key => $value) {
    $btn_reg += "<button class='form-control'>".$value."</button>";
  }
  $btn_reg += "</div>";

  return $btn_reg;
}*/

?>
<style type="text/css">
  .wizard {
    margin: 20px auto;
    background: #fff;
}

    .wizard .nav-tabs {
        position: relative;
        margin: 40px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #2a3f56;
    
}
.wizard li.active span.round-tab i{
    color: #2a3f56;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 25%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #2a3f56;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #2a3f56;
}

.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 50px;
}

.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}
</style>         
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
         <script src="<?=base_url();?>application/views/assets/js/ajaxRaven.js"></script>
          <!-- page content -->
          <div class="right_col" role="main" >


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph">

                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3>Reporte de Producción <?= $fechaTurno?></h3>
                    </div>
                    <div class="col-md-6" hidden >
                      <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                      </div>
                    </div>
                    <div class="col-md-6"  >
                      <div  class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span><?= $date;?></span> <b class="caret"></b>
                      </div>
                    </div>                    
                  </div>

                  <div class="x_content">
           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_title" hidden>
                    <h2>Reporte de Producción  - Fecha: <?= $date?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li ><a class="close-link"><i class="fa fa-close" hidden></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" >
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento">Maquina:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="maquina" onchange="getMaquinaParte();">
                              <option value="" selected disabled>Selecciona una maquina</option>
                            <?php
                            foreach ($maquina as $key => $value) {
                              echo "<option value='".$value['maquina']."'>".$value['maquina']."</option>";
                            }
                            ?>
                            </select>
                          </div>
                        </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="maquinaParte">No. Parte <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="maquinaParte" onchange="getMaquinaInfo();">
                              
                            </select>                          
                        </div>
                      </div>                        
                      <div class="form-group" hidden>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_maquina">No. Orden <span class="required" value="NA">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="id_maquina"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>                       
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_orden">No. Orden <span class="required" value="NA">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="no_orden" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_lote_materia"># Lote materia prima <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="no_lote_materia" name="no_lote_materia" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_molde">No. Molde <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="no_molde" name="no_molde" required="required" class="form-control col-md-7 col-xs-12" disabled>
                        </div>
                      </div>                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cavidades">Cavidades <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="cavidades" name="cavidades" required="required" class="form-control col-md-7 col-xs-12" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="materia_prima">No. Materia Prima <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="materia_prima" name="materia_prima" required="required" class="form-control col-md-7 col-xs-12" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="objetivo_hora">Objetivo X Hora <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="objetivo_hora" name="objetivo_hora" required="required" class="form-control col-md-7 col-xs-12" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num_operador">No. Operador <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="num_operador" name="num_operador" required="required" class="form-control col-md-7 col-xs-12" value="<?=$num_empleado;?>" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num_inspeccion">No Verificador <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="num_inspeccion" name="num_inspeccion" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num_lider">No Lider <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="num_lider" name="num_lider" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group" style="text-align: center;">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button  class="btn btn-success btn-block" id="guardar">Guardar</button>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

               </div> 
                  </div>

                  <div class="clearfix"></div>
                </div>
              </div>

            </div>
            <br />
              <div class="alert alert-success" role="alert" id="alert" hidden>
                <strong>Registro Exitoso!</strong> <a href="#" class="alert-link"></a>
              </div>

              <div class="alert alert-danger" role="alert" id="alert_danger" hidden>
                <strong>No Registrado !</strong> <a href="#" class="alert-link"></a>
              </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel tile fixed_height_320">
                  <div class="x_title">
                    <h2>Registro de Máquinas</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive table-fixed" style="overflow-y: auto;">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Maquina</th>
                            <th class="column-title"># Molde</th>
                            <th class="column-title"># Lote Materia Prima </th>
                            <th class="column-title">Empleado </th>
                            <th class="column-title">Registro </th>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody id='table_response'>
                        </tbody>
                      </table>
                    </div>

                  </div>

                  </div>
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12" hidden>
                <div class="x_panel tile fixed_height_320 overflow_hidden">
                  <div class="x_title">
                    <h2>Device Usage</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="" style="width:100%">
                      <tr>
                        <th style="width:37%;">
                          <p>Top 5</p>
                        </th>
                        <th>
                          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <p class="">Device</p>
                          </div>
                          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <p class="">Progress</p>
                          </div>
                        </th>
                      </tr>
                      <tr>
                        <td>
                          <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                        </td>
                        <td>
                          <table class="tile_info">
                            <tr>
                              <td>
                                <p><i class="fa fa-square blue"></i>IOS </p>
                              </td>
                              <td>30%</td>
                            </tr>
                            <tr>
                              <td>
                                <p><i class="fa fa-square green"></i>Android </p>
                              </td>
                              <td>10%</td>
                            </tr>
                            <tr>
                              <td>
                                <p><i class="fa fa-square purple"></i>Blackberry </p>
                              </td>
                              <td>20%</td>
                            </tr>
                            <tr>
                              <td>
                                <p><i class="fa fa-square aero"></i>Symbian </p>
                              </td>
                              <td>15%</td>
                            </tr>
                            <tr>
                              <td>
                                <p><i class="fa fa-square red"></i>Others </p>
                              </td>
                              <td>30%</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>


              <div class="col-md-4 col-sm-4 col-xs-12" hidden>
                <div class="x_panel tile fixed_height_320">
                  <div class="x_title">
                    <h2>Quick Settings</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="dashboard-widget-content">
                      <ul class="quick-list">
                        <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                        </li>
                        <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                        </li>
                        <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                        <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                        </li>
                        <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                        <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                        </li>
                        <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                        </li>
                      </ul>

                      <div class="sidebar-widget">
                          <h4>Profile Completion</h4>
                          <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
                          <div class="goal-wrapper">
                            <span id="gauge-text" class="gauge-value pull-left">0</span>
                            <span class="gauge-value pull-left">%</span>
                            <span id="goal-text" class="goal-value pull-right">100%</span>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>


            <div class="row" hidden>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Recent Activities <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="dashboard-widget-content">

                      <ul class="list-unstyled timeline widget">
                        <li>
                          <div class="block">
                            <div class="block_content">
                              <h2 class="title">
                                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                            </h2>
                              <div class="byline">
                                <span>13 hours ago</span> by <a>Jane Smith</a>
                              </div>
                              <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                              </p>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="block">
                            <div class="block_content">
                              <h2 class="title">
                                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                            </h2>
                              <div class="byline">
                                <span>13 hours ago</span> by <a>Jane Smith</a>
                              </div>
                              <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                              </p>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="block">
                            <div class="block_content">
                              <h2 class="title">
                                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                            </h2>
                              <div class="byline">
                                <span>13 hours ago</span> by <a>Jane Smith</a>
                              </div>
                              <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                              </p>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="block">
                            <div class="block_content">
                              <h2 class="title">
                                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                            </h2>
                              <div class="byline">
                                <span>13 hours ago</span> by <a>Jane Smith</a>
                              </div>
                              <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                              </p>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-8 col-sm-8 col-xs-12">



                <div class="row">

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Visitors location <small>geo-presentation</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div class="dashboard-widget-content">
                          <div class="col-md-4 hidden-small">
                            <h2 class="line_30">125.7k Views from 60 countries</h2>

                            <table class="countries_list">
                              <tbody>
                                <tr>
                                  <td>United States</td>
                                  <td class="fs15 fw700 text-right">33%</td>
                                </tr>
                                <tr>
                                  <td>France</td>
                                  <td class="fs15 fw700 text-right">27%</td>
                                </tr>
                                <tr>
                                  <td>Germany</td>
                                  <td class="fs15 fw700 text-right">16%</td>
                                </tr>
                                <tr>
                                  <td>Spain</td>
                                  <td class="fs15 fw700 text-right">11%</td>
                                </tr>
                                <tr>
                                  <td>Britain</td>
                                  <td class="fs15 fw700 text-right">10%</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="row">


                  <!-- Start to do list -->
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>To Do List <small>Sample tasks</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">

                        <div class="">
                          <ul class="to_do">
                            <li>
                              <p>
                                <input type="checkbox" class="flat"> Schedule meeting with new client </p>
                            </li>
                            <li>
                              <p>
                                <input type="checkbox" class="flat"> Create email address for new intern</p>
                            </li>
                            <li>
                              <p>
                                <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                            </li>
                            <li>
                              <p>
                                <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                            </li>
                            <li>
                              <p>
                                <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                            </li>
                            <li>
                              <p>
                                <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                            </li>
                            <li>
                              <p>
                                <input type="checkbox" class="flat"> Create email address for new intern</p>
                            </li>
                            <li>
                              <p>
                                <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                            </li>
                            <li>
                              <p>
                                <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End to do list -->
                  
                  <!-- start of weather widget -->
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Daily active users <small>Sessions</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="temperature"><b>Monday</b>, 07:30 AM
                              <span>F</span>
                              <span><b>C</b></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="weather-icon">
                              <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                            </div>
                          </div>
                          <div class="col-sm-8">
                            <div class="weather-text">
                              <h2>Texas <br><i>Partly Cloudy Day</i></h2>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="weather-text pull-right">
                            <h3 class="degrees">23</h3>
                          </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row weather-days">
                          <div class="col-sm-2">
                            <div class="daily-weather">
                              <h2 class="day">Mon</h2>
                              <h3 class="degrees">25</h3>
                              <canvas id="clear-day" width="32" height="32"></canvas>
                              <h5>15 <i>km/h</i></h5>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="daily-weather">
                              <h2 class="day">Tue</h2>
                              <h3 class="degrees">25</h3>
                              <canvas height="32" width="32" id="rain"></canvas>
                              <h5>12 <i>km/h</i></h5>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="daily-weather">
                              <h2 class="day">Wed</h2>
                              <h3 class="degrees">27</h3>
                              <canvas height="32" width="32" id="snow"></canvas>
                              <h5>14 <i>km/h</i></h5>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="daily-weather">
                              <h2 class="day">Thu</h2>
                              <h3 class="degrees">28</h3>
                              <canvas height="32" width="32" id="sleet"></canvas>
                              <h5>15 <i>km/h</i></h5>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="daily-weather">
                              <h2 class="day">Fri</h2>
                              <h3 class="degrees">28</h3>
                              <canvas height="32" width="32" id="wind"></canvas>
                              <h5>11 <i>km/h</i></h5>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="daily-weather">
                              <h2 class="day">Sat</h2>
                              <h3 class="degrees">26</h3>
                              <canvas height="32" width="32" id="cloudy"></canvas>
                              <h5>10 <i>km/h</i></h5>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- end of weather widget -->
                </div>
              </div>
            </div>
          </div>
          <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    
  
  </body>
</html>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modal_header">Piezas Scrap</h4>
        </div>
        <div class="modal-body" id="resp_modal">


          <select class='form-control' id="select_defecto">
            
          </select>
          <br>
          <select class='form-control' id="select_check">
            
          </select> 
          <br>
          <input type="text" id="cantidad" class="form-control" placeholder="Scrap">
          <br>
          <button class="btn-primary">Guardar</button>         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="myModalTiempo" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modal_header">Tiempos Muertos</h4>
        </div>
        <div class="modal-body" id="resp_modal">
          <select class='form-control' id="select_departamento">
            
          </select>
          <br>
          <select class='form-control' id="select_motivo">
            
          </select>
          <br>
          <input type="text" id="tiempo" class="form-control" placeholder="Tiempo Muerto">
          <br>
          <button class="btn-primary">Guardar</button>         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="cambioModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modal_header">Cambios</h4>
        </div>
        <div class="modal-body" id="resp_modal">
          <input type="text" id="new_molde" class="form-control" placeholder="# Molde">
          <br>
          <input type="text" id="new_lote" class="form-control" placeholder="# Lote Materia Prima">
          <br>
          <button class="btn btn-primary btn-block">Guardar</button>         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>  
<script type="text/javascript">



var fechaNow = "<?= $fechaNow?>";
var num_operador = "<?= $num_empleado?>";
var dateNow = "<?= $dateNow?>";
  showDataTurno(num_operador,dateNow);

$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

//Detalle de maquina

function getMaquinaInfo(){
  var no_maquina = document.getElementById('maquina').value;
  var maquinaParte = document.getElementById('maquinaParte').value;
  var maquina = no_maquina+"-"+maquinaParte;
  $.ajax({
      url: '<?= base_url();?>index.php/home/getMaquinaInfo',
      cache: false,
      type: "POST",
      dataType:"text",
      data: {maquina},

      success: function(data){
        var obj = $.parseJSON(data);
        console.log(obj[0].no_parte);
        document.getElementById('id_maquina').value =obj[0].id_maquina;
        document.getElementById('no_molde').value =obj[0].no_molde;
        document.getElementById('cavidades').value =obj[0].cavidades;
        document.getElementById('materia_prima').value =obj[0].materia_prima;
        document.getElementById('objetivo_hora').value =obj[0].objetivo_hora;
        //$('#alert').removeAttr('hidden');
        //setTimeout(window.location.replace("<?=base_url()?>index.php/home/ajustes"), 3000);
      },
      error: function(e){
        console.log(e);
        $('#alert_danger').removeAttr('hidden');
        return false;
      }
   });
}

//Get Parte Maquina
function getMaquinaParte(){
  var maquina = document.getElementById('maquina').value;
  var empresa = "<?= $empresa?>";
  
  var select = "<option selected disabled>Selecciona No.Parte</option>";
  $.ajax({
      url: '<?= base_url();?>index.php/home/getMaquinaParte',
      cache: false,
      type: "POST",
      dataType:"text",
      data: {maquina,empresa},

      success: function(data){
        var obj = $.parseJSON(data);
        console.log(obj[0].no_parte);
        for (i= 0; i < obj.length; i++) {
          select +="<option>"+obj[i].no_parte+"</option>";
        }
        document.getElementById('maquinaParte').innerHTML=select;        
        //$('#alert').removeAttr('hidden');
        //setTimeout(window.location.replace("<?=base_url()?>index.php/home/ajustes"), 3000);
      },
      error: function(e){
        console.log(e);
        $('#alert_danger').removeAttr('hidden');
        return false;
      }
   });
}

//Insertar piezas buenas
function regHora(id){
  //alert(id);
  document.getElementById('fechaReporte').value = fechaNow;
}

//Insertar scrap

function scrapModal(){
  $('#myModal').modal('show');  
  var select = "<option selected disabled>Selecciona Defecto</option>";
    $.ajax({
      url: '<?= base_url();?>index.php/home/getDefectos',
      cache: false,
      type: "POST",
      dataType:"text",
      data: 'defectos',

      success: function(data){
        var obj = $.parseJSON(data);

        for (i= 0; i < obj.length; i++) {
          select +="<option>"+obj[i].defecto+"</option>";
        }
        //$('#alert').removeAttr('hidden');
        //setTimeout(window.location.replace("<?=base_url()?>index.php/home/ajustes"), 3000);
        document.getElementById('select_defecto').innerHTML=select;
      },
      error: function(e){
        console.log(e);
        $('#alert_danger').removeAttr('hidden');
        return false;
      }
   });

}

    $("#select_defecto").change(function(){
        var val_defecto = $(this).val();
        var select_check = "<option selected disabled>Selecciona Check</option>";
        $.ajax({
          url: '<?= base_url();?>index.php/home/getDefectosCheck',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {val_defecto},

          success: function(data){
            var obj = $.parseJSON(data);
            console.log(obj);
            var newArray = new Array();          
            /*select_check ="<option>"+obj[0].check1+"</option>";
            select_check +="<option>"+obj[0].check2+"</option>";
            select_check +="<option>"+obj[0].check3+"</option>";
            select_check +="<option>"+obj[0].check4+"</option>";*/
            //select_check +="<option>"+obj[0].check5+"</option>";
            select_check +=(obj[0].check1) ? ("<option>"+obj[0].check1+"</option>") : ("<option disabled>"+obj[0].check1+"</option>");
            select_check +=(obj[0].check2) ? ("<option>"+obj[0].check2+"</option>") : ("<option disabled>"+obj[0].check2+"</option>");
            select_check +=(obj[0].check3) ? ("<option>"+obj[0].check3+"</option>") : ("<option disabled>"+obj[0].check3+"</option>");
            select_check +=(obj[0].check4) ? ("<option>"+obj[0].check4+"</option>") : ("<option disabled>"+obj[0].check4+"</option>");
            select_check +=(obj[0].check5) ? ("<option>"+obj[0].check5+"</option>") : ("<option disabled>"+obj[0].check5+"</option>");
            /*for (i= 0; i < obj.length; i++) {
              select_check +="<option>"+obj[i].check1+"</option>";
            }*/
            console.log(newArray);
            //$('#alert').removeAttr('hidden');
            //setTimeout(window.location.replace("<?=base_url()?>index.php/home/ajustes"), 3000);
            document.getElementById('select_check').innerHTML=select_check;
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });
    });

    //Tiempo Muerto

    function tiempoModal(){
      $('#myModalTiempo').modal('show');
        var select = "<option selected disabled>Selecciona Departamento</option>";
          $.ajax({
            url: '<?= base_url();?>index.php/home/getDepartamento',
            cache: false,
            type: "POST",
            dataType:"text",
            data: 'departamento',

            success: function(data){
              var obj = $.parseJSON(data);
              for (i= 0; i < obj.length; i++) {
                select +="<option>"+obj[i].departamento+"</option>";
              }
              //$('#alert').removeAttr('hidden');
              //setTimeout(window.location.replace("<?=base_url()?>index.php/home/ajustes"), 3000);
              document.getElementById('select_departamento').innerHTML=select;
            },
            error: function(e){
              console.log(e);
              $('#alert_danger').removeAttr('hidden');
              return false;
            }
         });      
    }

      $("#select_departamento").change(function(){
        var val_defecto = $(this).val();
        var select_motivo = "<option selected disabled>Selecciona Motivo</option>";
        $.ajax({
          url: '<?= base_url();?>index.php/home/getMotivos',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {val_defecto},

          success: function(data){
            var obj = $.parseJSON(data);
            console.log(obj);


            for (i= 0; i < obj.length; i++) {
              select_motivo +="<option>"+obj[i].motivo+"</option>";
            }
            document.getElementById('select_motivo').innerHTML=select_motivo;
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });
    });

  $("#guardar").click(function(){
      var id_maquina = document.getElementById('id_maquina').value;
      if (!id_maquina) {
        alert("Seleccionar Maquina y No. Parte");
        return false;
      }else{
        validate_reporte();
      }
  });

function validate_reporte(){
  var urlTurno = "<?= base_url();?>index.php/home/regTurno";
  var num_operador = document.getElementById('num_operador').value;
  var dateNow = "<?=$dateNow?>";

  var val_datos = {
    num_operador : num_operador,
    dateNow : dateNow
  }

  regTurno(urlTurno,val_datos);
}

function insert_reporte(folio){

  var id_maquina = document.getElementById('id_maquina').value;
  var num_operador = document.getElementById('num_operador').value;
  var no_lote_materia = document.getElementById('no_lote_materia').value;
  var no_orden = document.getElementById('no_orden').value;
  var num_inspeccion = document.getElementById('num_inspeccion').value;
  var num_lider = document.getElementById('num_lider').value;
  var turno = "<?=$turno ?>";
  var fecha_registro = "<?=$fechaNow ?>";
  var empresa = "<?=$empresa?>";
  var dateNow = "<?=$dateNow?>";



  if (folio == '0') {
    console.log("folio: "+folio+", se genera insert");
    var url = "<?= base_url();?>index.php/home/insertTurnoProd";
    var datos = {
      id_maquina : id_maquina,
      num_operador : num_operador,
      turno : turno,
      fecha_registro : fecha_registro,
      empresa : empresa,
      dateNow : dateNow,
      no_lote_materia : no_lote_materia,
      no_orden : no_orden,
      num_inspeccion : num_inspeccion,
      num_lider : num_lider
    }
  insertData(url,datos);
  }else{
    console.log("folio: "+folio+", se genera update");
    var url = "<?= base_url();?>index.php/home/insertTurnoProdFolio";
    var datos = {
      folio : folio,
      id_maquina : id_maquina,
      num_operador : num_operador,
      turno : turno,
      fecha_registro : fecha_registro,
      empresa : empresa,
      dateNow : dateNow,
      no_lote_materia : no_lote_materia,
      no_orden : no_orden,
      num_inspeccion : num_inspeccion,
      num_lider : num_lider
    }

    insertData(url,datos);    

  }
  setTimeout(window.location.replace("<?=base_url()?>index.php/home/reporte_produccion_hr"), 5000);



  showDataTurno(num_operador,dateNow);


}



function showDataTurno(num_operador,dateNow){
          var table = '';
          $.ajax({
          url: '<?= base_url();?>index.php/home/showDataTurno',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {num_operador,dateNow},

          success: function(data){
            var obj = $.parseJSON(data);
            console.log(obj);
              for (i= 0; i < obj.length; i++) {

                 table += "<tr class='even pointer'> <td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].no_molde+"</td> <td class= ''>"+obj[i].lote_materia_prima+"</td> <td class= ''>"+obj[i].num_operador+"</td> <td class= ''>"+obj[i].fecha_registro+"</td> </tr>"; 
              }
              document.getElementById('table_response').innerHTML= table;
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });

}


function cambio(){
  $('#cambioModal').modal('show'); 
}



  

</script>