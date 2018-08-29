
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
    $arrTurno = array('06:00-07:00', '07:00-08:00', '08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00', '12:00-13:00', '13:00-14:00', '14:00-14:30');
    $turno = "1";
    //valTurno("Mañana",$arrTurno);
  }else if ($fechaTurno >= '14:30' && $fechaTurno<= '22:29') {
    $arrTurno = array('14:30-15:00', '15:00-16:00', '16:00-17:00', '17:00-18:00', '18:00-19:00', '19:00-20:00', '20:00-21:00', '21:00-22:00','22:00-22:30');
     $turno = "2";
    //$btn_reg = valTurno("Tarde",$arrTurno);
  }else {
    $arrTurno = array('22:30-23:00','23:00-00:00', '00:00-01:00', '01:00-02:00', '02:00-03:00','03:00-04:00', '04:00-05:00', '05:00-06:00');
     $turno = "3";
    //valTurno("Noche",$arrTurno);
  }*/

  //Turnos de 12 horas
  if ($fechaTurno >= '07:00' && $fechaTurno<= '19:00') {
    //$arrTurno = array('07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00','15:00', '16:00', '17:00', '18:00', '19:00');
    $arrTurno = array('07:00-08:00', '08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00', '12:00-13:00', '13:00-14:00','14:00-15:00','15:00-16:00', '16:00-17:00', '17:00-18:00', '18:00-19:00');
    $turno = "1";
    //valTurno("Mañana",$arrTurno);
  }else {
    //$arrTurno = array('19:00', '20:00', '21:00', '22:00','23:00','00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00','07:00');
    $arrTurno = array('19:00-20:00', '20:00-21:00', '21:00-22:00','22:00-23:00','23:00-00:00', '00:00-01:00', '01:00-02:00', '02:00-03:00','03:00-04:00', '04:00-05:00', '05:00-06:00','06:00-07:00');
     $turno = "2";
    //$btn_reg = valTurno("Tarde",$arrTurno);
  }

  /*else {
    $arrTurno = array('23:00','00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00');
     $turno = "3";
    //valTurno("Noche",$arrTurno);
  }*/



  $th = "<th class='column-title'>Máquina</th>";
  foreach ($arrTurno as $key => $value) {
    $th .= "<th class='column-title'>".$value."</th>";
  }
  $th .= "</th>";




if (!isset($eficiencia)) {

}else{


  foreach ($eficiencia -> result() as $value) {
    $eficiencia_val[] = $value->eficiencia;
    $dia_val[] = $value->dia;
    $maquina_val[] = $value->maquina;
  }


}


?>
        
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

        <script src="<?= base_url();?>application/views/assets/js/highcharts/highlight.js"></script>
        <script src="<?= base_url();?>application/views/assets/js/highcharts/highcharts.src.js"></script>
        <script src="<?= base_url();?>application/views/assets/js/highcharts/exporting.js"></script>
        <script src="<?= base_url();?>application/views/assets/js/highcharts/data.js"></script>
        <script src="<?= base_url();?>application/views/assets/js/highcharts/drilldown.js"></script>

         <script src="<?=base_url();?>application/views/assets/js/ajaxRaven.js"></script>
          <!-- page content -->
          <div class="right_col" role="main" >


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph">

                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3>Eficiencia por Máquina</h3>
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
                    <div class="col-md-6 col-sm-12 col-xs-12">

                          <div class="x_content">
                            <br />
                            <div >
                              <h5>RR</h5>
                              <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                  <tr class="headings">
                                    <th class="column-title">Mes</th>
                                    <th class="column-title">%Eficiencia </th>
                                    <th class="column-title">Detalle</th>
                                    </th>
                                    <th class="bulk-actions" colspan="7">
                                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                  </tr>
                                </thead>

                                <tbody id="tablaEficienciaRR">
                                </tbody>
                              </table>                              
                            </div>
                          </div>
                      </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">

                          <div class="x_content">
                            <br />
                                <h5>AZ</h5>
                                <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                  <tr class="headings">
                                    <th class="column-title">Mes</th>
                                    <th class="column-title">%Eficiencia</th>
                                    <th class="column-title">Detalle</th>
                                    </th>
                                    <th class="bulk-actions" colspan="7">
                                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                  </tr>
                                </thead>

                                <tbody id="tablaEficienciaAZ">
                                </tbody>
                              </table>           
                          </div>
                      </div>

                       </div> 
                  </div>

                  <div class="clearfix"></div>
                </div>
              </div>

            </div>


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph">

                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3>Eficiencia Diaria hra x hra</h3>
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
                      <div class="col-md-6 col-sm-6 col-xs-12 "  >
                        <button class="btn btn-success btn-block" onclick="eficienciaDiaria('<?= $turno;?>','<?= $dateNow;?>','RR')">Raven</button>
                    </div> 
                      <div class="col-md-6 col-sm-6 col-xs-12 "  >
                        <button class="btn btn-success btn-block" onclick="eficienciaDiaria('<?= $turno;?>','<?= $dateNow;?>','AZ')">AZ</button>
                    </div> 
                          <div class="x_content">
                            <br />
                            <div >
                              <h5 id="empresaNom"></h5>
                              <div class="table-responsive">
                              <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                  <tr class="headings">
                                    <?= $th;?>
                                  </tr>
                                </thead>

                                <tbody id="tablaEficienciaDiaria">
                                </tbody>
                              </table>       
                              </div>
                            </div>
                          </div>
                      </div>
                    <div class="col-md-5 col-sm-5 col-xs-5">

                          <div class="x_content">
                            <br />
                            <div id="graficoTiempo"></div>
                          </div>
                      </div>

                       </div> 
                  </div>

                  <div class="clearfix"></div>
                </div>
              </div>

            </div>


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                
                <div class="dashboard_graph">

                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3>Minutos Tiempo Muerto</h3>
                    </div>
 
                    <div class="col-md-6"  >
                      <div  class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span><?= $date;?></span> <b class="caret"></b>
                      </div>
                    </div>                    
                  </div>
               <div class="col-md-6 col-sm-6 col-xs-12 "  >
                    <button class="btn btn-success btn-block" onclick="minutosTM('<?= $turno;?>','<?= $dateNow;?>','RR')">Raven</button>
                </div> 
                  <div class="col-md-6 col-sm-6 col-xs-12 "  >
                    <button class="btn btn-success btn-block" onclick="minutosTM('<?= $turno;?>','<?= $dateNow;?>','AZ')">AZ</button>
                </div> 
                  <div class="x_content">
                   <div class="row">
                    <div class="col-md-7 col-sm-7 col-xs-7">

                          <div class="x_content">
                            <br />
                            <div>
                              <h5 id="empresaNomTiempo"></h5>
                              <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                  <tr class="headings">
                                    <th class="column-title">Máquina</th>
                                    <th class="column-title">Calidad</th>
                                    <th class="column-title">Mantenimiento</th>
                                    <th class="column-title">Materiales</th>
                                    <th class="column-title">Procesos</th>
                                    <th class="column-title">Produccion</th>
                                    <th class="column-title">Proyectos</th>
                                    <th class="column-title">RH</th>
                                    <th class="column-title">Seguridad</th>
                                    </th>
                                    <th class="bulk-actions" colspan="7">
                                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                  </tr>
                                </thead>

                                <tbody id="tablaTM">
                                </tbody>
                              </table> 
                            </div>
                          </div>
                      </div>
                    <div class="col-md-5 col-sm-5 col-xs-5">

                          <div class="x_content">
                            <br />
                            <div id="graficoScrap"></div>
                          </div>
                      </div>

                       </div> 
                  </div>

                  <div class="clearfix"></div>
                </div>
              </div>

            </div>
            <br />
            <div class="row" hidden>
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
          <h4 class="modal-title" id="modal_header"></h4>
        </div>
        <div class="modal-body" id="resp_modal">
          <table class="table table-striped jambo_table bulk_action">
            <thead>
              <tr class="headings">
                <th class="column-title">Mes</th>
                <th class="column-title">Máquina</th>
                <th class="column-title">%Eficiencia</th>
                <th class="column-title" id="detalle">Detalle</th>
                </th>
                <th class="bulk-actions" colspan="7">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
              </tr>
            </thead>

            <tbody id="tablaEficienciaDia">
            </tbody>
          </table>
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

var turno = "<?= $turno;?>"; 
var dateNow = "<?= $dateNow;?>"; 
var empresa = "<?= $empresa;?>"; 
var fechaTurno = "<?= $fechaTurno;?>"; 

getEficienciaRR();
getEficienciaAZ();
eficienciaDiaria(turno,dateNow,empresa);
minutosTM(turno,dateNow,empresa);

function getEficienciaRR(){
          var table = '';
          $.ajax({
          url: '<?= base_url();?>index.php/home/getEficienciaRRmes',
          cache: false,
          type: "POST",
          dataType:"text",
          data: "eficienciaRR",

          success: function(data){
          var obj = $.parseJSON(data);

            for (i= 0; i < obj.length; i++) {



               table += "<tr class='even pointer'> <td class= ''>"+obj[i].dia+"</td><td class= ''>"+obj[i].eficiencia+"</td> <td><a href='#' onclick='detalle_mes("+obj[i].dia+",1)'>Ver</a></td></tr>";
            }

            document.getElementById('tablaEficienciaRR').innerHTML= table;
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });

}

function getEficienciaAZ(){
          var table = '';
          $.ajax({
          url: '<?= base_url();?>index.php/home/getEficienciaAZmes',
          cache: false,
          type: "POST",
          dataType:"text",
          data: "eficienciaRR",

          success: function(data){
          var obj = $.parseJSON(data);

            for (i= 0; i < obj.length; i++) {



               table += "<tr class='even pointer'> <td class= ''>"+obj[i].dia+"</td><td class= ''>"+obj[i].eficiencia+"</td> <td><a href='#' onclick='detalle_mes("+obj[i].dia+",2)'>Ver</a></td></tr>";
            }

            document.getElementById('tablaEficienciaAZ').innerHTML= table;
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });

}


function detalle_mes(mes,empresa){
            var table = '';
            var tableAvg = '';
          var datos = { 
            mes : mes,
            empresa :empresa
          }
          $.ajax({
          url: '<?= base_url();?>index.php/home/getEficienciaDetalle',
          cache: false,
          type: "POST",
          dataType:"text",
          data: datos,

          success: function(data){
          var obj = $.parseJSON(data);
          console.log(obj);


            for (i= 0; i < obj.length; i++) {
               table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].maquina+"</td> <td class= ''>"+obj[i].eficiencia+"</td> <td><a href='#' onclick='detalle_dia("+obj[i].mes+","+obj[i].dia+","+empresa+")'>Ver</a></td></tr>";
            }
            $('#myModal').modal('show');
            $('#detalle').show();
            document.getElementById('tablaEficienciaDia').innerHTML= table;
            document.getElementById('modal_header').innerHTML= 'Detalle Mes';
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });
}

function detalle_dia(mes,dia,empresa){
            var table = '';
            var datos = { 
            mes : mes,
            dia : dia,
            empresa :empresa
          }
          $.ajax({
          url: '<?= base_url();?>index.php/home/getEficienciaDetalleDia',
          cache: false,
          type: "POST",
          dataType:"text",
          data: datos,

          success: function(data){
          var obj = $.parseJSON(data);
          console.log(obj);


            for (i= 0; i < obj.length; i++) {

               table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].maquina+"</td> <td class= ''>"+obj[i].eficiencia+"</td></tr>";
            }
            $('#detalle').hide();
            document.getElementById('modal_header').innerHTML= "<a href='#' onclick='detalle_mes("+mes+","+empresa+")'><i class='fa fa-arrow-circle-left'></i></a>  Detalle Día";
            document.getElementById('tablaEficienciaDia').innerHTML= table;
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });
}

  function eficienciaDiaria(turno,dateNow,empresa='RR'){
    var datos = { 
      turno : turno,
      dateNow : dateNow,
      empresa : empresa,
      fechaTurno : fechaTurno
    }
    var table = "";
    var tableAvg = "";
    var prom_hora1 = 0;
    var prom_hora2= 0;
    var prom_hora3= 0;
    var prom_hora4= 0;
    var prom_hora5= 0;
    var prom_hora6= 0;
    var prom_hora7= 0;
    var prom_hora8= 0;
    var prom_hora9= 0;
    var prom_hora10= 0;
    var prom_hora11= 0;
    var prom_hora12= 0;

    var val_hora1= 0;
    var val_hora2= 0;
    var val_hora3= 0;
    var val_hora4= 0;
    var val_hora5= 0;
    var val_hora6= 0;
    var val_hora7= 0;
    var val_hora8= 0;
    var val_hora9= 0;
    var val_hora10= 0;
    var val_hora11= 0;
    var val_hora11= 0;
    var val_hora12= 0;
    var a = 1;

    var hora = [];
    $.ajax({
      url: '<?= base_url();?>index.php/home/eficienciaDiaria',
      cache: false,
      type: "POST",
      dataType:"text",
      data: datos,

      success: function(data){
      var obj = $.parseJSON(data);


     var groups = {};
    for (var i = 0; i < obj.length; i++) {
      var groupName = obj[i].maquina;
      if (!groups[groupName]) {
        groups[groupName] = [];
        
      }

      groups[groupName].push(obj[i].hora1);
      groups[groupName].push(obj[i].hora2);
      groups[groupName].push(obj[i].hora3);
      groups[groupName].push(obj[i].hora4);
      groups[groupName].push(obj[i].hora5);
      groups[groupName].push(obj[i].hora6);
      groups[groupName].push(obj[i].hora7);
      groups[groupName].push(obj[i].hora8);
      groups[groupName].push(obj[i].hora9);
      groups[groupName].push(obj[i].hora10);
      groups[groupName].push(obj[i].hora11);
      groups[groupName].push(obj[i].hora12);
      groups[groupName].push(obj[i].hora13);
    console.log(groups);  

    }
    hora = [];

    for (var groupName in groups) {

      hora.push({maquina: groupName, hora: groups[groupName]});
    }


    /*obj.forEach(function (elemento, indice, array) {
        console.log(array);
    });*/

    switch(turno) {
      case "1":
          for (i= 0; i < obj.length; i++) {


             table += "<tr class='even pointer'> <td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].hora1+"</td><td class= ''>"+obj[i].hora2+"</td><td class= ''>"+obj[i].hora3+"</td><td class= ''>"+obj[i].hora4+"</td><td class= ''>"+obj[i].hora5+"</td><td class= ''>"+obj[i].hora6+"</td><td class= ''>"+obj[i].hora7+"</td><td class= ''>"+obj[i].hora8+"</td><td class= ''>"+obj[i].hora9+"</td><td class= ''>"+obj[i].hora10+"</td><td class= ''>"+obj[i].hora11+"</td><td class= ''>"+obj[i].hora12+"</td></tr>";

             if (obj[i].hora1) {
              obj[i].hora1=obj[i].hora1;
              val_hora1 += a;

             }else{
              obj[i].hora1 = 0;
             }

             if (obj[i].hora2) {
              obj[i].hora2=obj[i].hora2;
              val_hora2 += a;
             }else{
              obj[i].hora2 = 0;
             }             

             if (obj[i].hora3) {
              obj[i].hora3=obj[i].hora3;
              val_hora3 += a; 
             }else{
              obj[i].hora3 = 0;
             }

             if (obj[i].hora4) {
              obj[i].hora4=obj[i].hora4;
              val_hora4 += a; 
             }else{
              obj[i].hora4 = 0;
             }             

             if (obj[i].hora5) {
              obj[i].hora5=obj[i].hora5;
              val_hora5 += a; 
             }else{
              obj[i].hora5 = 0;
             }

             if (obj[i].hora6) {
              obj[i].hora6=obj[i].hora6;
              val_hora6 += a; 
             }else{
              obj[i].hora6 = 0;
             }             

             if (obj[i].hora7) {
              obj[i].hora7=obj[i].hora7;
              val_hora7 += a; 
             }else{
              obj[i].hora7 = 0;
             }

             if (obj[i].hora8) {
              obj[i].hora8=obj[i].hora8;
              val_hora8 += a; 
             }else{
              obj[i].hora8 = 0;
             }             

             if (obj[i].hora9) {
              obj[i].hora9=obj[i].hora9;
              val_hora9 += a; 
             }else{
              obj[i].hora9 = 0;
             }

             if (obj[i].hora10) {
              obj[i].hora10=obj[i].hora10;
              val_hora10 += a; 
             }else{
              obj[i].hora10 = 0;
             }             

             if (obj[i].hora11) {
              obj[i].hora11=obj[i].hora11;
              val_hora11 += a; 
             }else{
              obj[i].hora11 = 0;
             }

             if (obj[i].hora12) {
              obj[i].hora12=obj[i].hora12;
              val_hora12 += a; 
             }else{
              obj[i].hora12 = 0;
             }







            prom_hora1 += Math.round(parseInt(obj[i].hora1));
            prom_hora2 += Math.round(parseInt(obj[i].hora2));
            prom_hora3 += Math.round(parseInt(obj[i].hora3));
            prom_hora4 += Math.round(parseInt(obj[i].hora4));
            prom_hora5 += Math.round(parseInt(obj[i].hora5));
            prom_hora6 += Math.round(parseInt(obj[i].hora6));
            prom_hora7 += Math.round(parseInt(obj[i].hora7));
            prom_hora8 += Math.round(parseInt(obj[i].hora8));
            prom_hora9 += Math.round(parseInt(obj[i].hora9));
            prom_hora10 += Math.round(parseInt(obj[i].hora10));
            prom_hora11 += Math.round(parseInt(obj[i].hora11));
            prom_hora12 += Math.round(parseInt(obj[i].hora12));

          }  

          tableAvg = "<tr class='even pointer'> <td class= ''>Eficiencia x hora</td><td class= ''>"+Math.round(prom_hora1/val_hora1)+"</td><td class= ''>"+Math.round(prom_hora2/val_hora2)+"</td><td class= ''>"+Math.round(prom_hora3/val_hora3)+"</td><td class= ''>"+Math.round(prom_hora4/val_hora4)+"</td><td class= ''>"+Math.round(prom_hora5/val_hora5)+"</td><td class= ''>"+Math.round(prom_hora6/val_hora6)+"</td><td class= ''>"+Math.round(prom_hora7/val_hora7)+"</td><td class= ''>"+Math.round(prom_hora8/val_hora8)+"</td><td class= ''>"+Math.round(prom_hora9/val_hora9)+"</td><td class= ''>"+Math.round(prom_hora10/val_hora10)+"</td><td class= ''>"+Math.round(prom_hora11/val_hora11)+"</td><td class= ''>"+Math.round(prom_hora12/val_hora12)+"</td></tr>"; 
          break;
      case "2":
          for (i= 0; i < obj.length; i++) {


             table += "<tr class='even pointer'> <td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].hora1+"</td><td class= ''>"+obj[i].hora2+"</td><td class= ''>"+obj[i].hora3+"</td><td class= ''>"+obj[i].hora4+"</td><td class= ''>"+obj[i].hora5+"</td><td class= ''>"+obj[i].hora6+"</td><td class= ''>"+obj[i].hora7+"</td><td class= ''>"+obj[i].hora8+"</td><td class= ''>"+obj[i].hora9+"</td><td class= ''>"+obj[i].hora10+"</td><td class= ''>"+obj[i].hora11+"</td><td class= ''>"+obj[i].hora12+"</td></tr>";

             if (obj[i].hora1) {
              obj[i].hora1=obj[i].hora1;
              val_hora1 += a;

             }else{
              obj[i].hora1 = 0;
             }

             if (obj[i].hora2) {
              obj[i].hora2=obj[i].hora2;
              val_hora2 += a;
             }else{
              obj[i].hora2 = 0;
             }             

             if (obj[i].hora3) {
              obj[i].hora3=obj[i].hora3;
              val_hora3 += a; 
             }else{
              obj[i].hora3 = 0;
             }

             if (obj[i].hora4) {
              obj[i].hora4=obj[i].hora4;
              val_hora4 += a; 
             }else{
              obj[i].hora4 = 0;
             }             

             if (obj[i].hora5) {
              obj[i].hora5=obj[i].hora5;
              val_hora5 += a; 
             }else{
              obj[i].hora5 = 0;
             }

             if (obj[i].hora6) {
              obj[i].hora6=obj[i].hora6;
              val_hora6 += a; 
             }else{
              obj[i].hora6 = 0;
             }             

             if (obj[i].hora7) {
              obj[i].hora7=obj[i].hora7;
              val_hora7 += a; 
             }else{
              obj[i].hora7 = 0;
             }

             if (obj[i].hora8) {
              obj[i].hora8=obj[i].hora8;
              val_hora8 += a; 
             }else{
              obj[i].hora8 = 0;
             }             

             if (obj[i].hora9) {
              obj[i].hora9=obj[i].hora9;
              val_hora9 += a; 
             }else{
              obj[i].hora9 = 0;
             }

             if (obj[i].hora10) {
              obj[i].hora10=obj[i].hora10;
              val_hora10 += a; 
             }else{
              obj[i].hora10 = 0;
             }             

             if (obj[i].hora11) {
              obj[i].hora11=obj[i].hora11;
              val_hora11 += a; 
             }else{
              obj[i].hora11 = 0;
             }

             if (obj[i].hora12) {
              obj[i].hora12=obj[i].hora12;
              val_hora12 += a; 
             }else{
              obj[i].hora12 = 0;
             }







            prom_hora1 += Math.round(parseInt(obj[i].hora1));
            prom_hora2 += Math.round(parseInt(obj[i].hora2));
            prom_hora3 += Math.round(parseInt(obj[i].hora3));
            prom_hora4 += Math.round(parseInt(obj[i].hora4));
            prom_hora5 += Math.round(parseInt(obj[i].hora5));
            prom_hora6 += Math.round(parseInt(obj[i].hora6));
            prom_hora7 += Math.round(parseInt(obj[i].hora7));
            prom_hora8 += Math.round(parseInt(obj[i].hora8));
            prom_hora9 += Math.round(parseInt(obj[i].hora9));
            prom_hora10 += Math.round(parseInt(obj[i].hora10));
            prom_hora11 += Math.round(parseInt(obj[i].hora11));
            prom_hora12 += Math.round(parseInt(obj[i].hora12));

          }  

          tableAvg = "<tr class='even pointer'> <td class= ''>Eficiencia x hora</td><td class= ''>"+Math.round(prom_hora1/val_hora1)+"</td><td class= ''>"+Math.round(prom_hora2/val_hora2)+"</td><td class= ''>"+Math.round(prom_hora3/val_hora3)+"</td><td class= ''>"+Math.round(prom_hora4/val_hora4)+"</td><td class= ''>"+Math.round(prom_hora5/val_hora5)+"</td><td class= ''>"+Math.round(prom_hora6/val_hora6)+"</td><td class= ''>"+Math.round(prom_hora7/val_hora7)+"</td><td class= ''>"+Math.round(prom_hora8/val_hora8)+"</td><td class= ''>"+Math.round(prom_hora9/val_hora9)+"</td><td class= ''>"+Math.round(prom_hora10/val_hora10)+"</td><td class= ''>"+Math.round(prom_hora11/val_hora11)+"</td><td class= ''>"+Math.round(prom_hora12/val_hora12)+"</td></tr>"; 
          break;
      case "3":
        for (i= 0; i < obj.length; i++) {
          table += "<tr class='even pointer'> <td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].hora1+"</td><td class= ''>"+obj[i].hora2+"</td><td class= ''>"+obj[i].hora3+"</td><td class= ''>"+obj[i].hora4+"</td><td class= ''>"+obj[i].hora5+"</td><td class= ''>"+obj[i].hora6+"</td><td class= ''>"+obj[i].hora7+"</td><td class= ''>"+obj[i].hora8+"</td></tr>";
        }
          break;
      default:
      console.log("turnoDefault");
        for (i= 0; i < obj.length; i++) {
          table += "<tr class='even pointer'> <td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].hora1+"</td><td class= ''>"+obj[i].hora2+"</td><td class= ''>"+obj[i].hora3+"</td><td class= ''>"+obj[i].hora4+"</td><td class= ''>"+obj[i].hora5+"</td><td class= ''>"+obj[i].hora6+"</td><td class= ''>"+obj[i].hora7+"</td><td class= ''>"+obj[i].hora8+"</td><td class= ''>"+obj[i].hora9+"</td><td class= ''>"+obj[i].hora10+"</td></tr>";
        }
    }
        document.getElementById('tablaEficienciaDiaria').innerHTML= tableAvg+table;
        document.getElementById('empresaNom').innerHTML= empresa;
      },
      error: function(e){
        console.log(e);
        $('#alert_danger').removeAttr('hidden');
        return false;
      }
    });    

  }




  function minutosTM(turno,dateNow,empresa='RR'){
    var datos = { 
      turno : turno,
      dateNow : dateNow,
      empresa : empresa
    }
    var table = "";
    var hora = [];
    $.ajax({
      url: '<?= base_url();?>index.php/home/minutosTM',
      cache: false,
      type: "POST",
      dataType:"text",
      data: datos,

      success: function(data){
      var obj = $.parseJSON(data);

        for (i= 0; i < obj.length; i++) {

           table += "<tr class='even pointer'> <td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].Calidad+"</td> <td class= ''>"+obj[i].Mantenimiento+"</td><td class= ''>"+obj[i].Materiales+"</td><td class= ''>"+obj[i].Procesos+"</td><td class= ''>"+obj[i].Produccion+"</td><td class= ''>"+obj[i].Proyectos+"</td><td class= ''>"+obj[i].RH+"</td><td class= ''>"+obj[i].Seguridad+"</td></tr>";
        }


        document.getElementById('tablaTM').innerHTML= table;
        document.getElementById('empresaNomTiempo').innerHTML= empresa;
      },
      error: function(e){
        console.log(e);
        $('#alert_danger').removeAttr('hidden');
        return false;
      }
    });    

  }




















  

</script>