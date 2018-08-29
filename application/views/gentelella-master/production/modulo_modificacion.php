<style type="text/css">
  #table{
    overflow: scroll; /* Scrollbar are always visible */
    overflow: auto;
  }
</style>
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

  if ($fechaTurno >= '06:00' && $fechaTurno<= '14:29') {
    $arrTurno = array('06:00-07:00', '07:00-08:00', '08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00', '12:00-13:00', '13:00-14:00', '14:00-14:30');
    $turno = "1";
    //valTurno("Mañana",$arrTurno);
  }else if ($fechaTurno >= '14:30' && $fechaTurno<= '23:29') {
    $arrTurno = array('14:30-15:00', '15:00-16:00', '16:00-17:00', '17:00-18:00', '18:00-19:00', '19:00-20:00', '20:00-21:00', '21:00-22:00','22:00-23:00', '23:00-23:30');
     $turno = "2";
    //$btn_reg = valTurno("Tarde",$arrTurno);
  }else {
    $arrTurno = array('23:30-00:00', '00:00-01:00', '01:00-02:00', '03:00-04:00', '04:00-05:00', '05:00-06:00');
     $turno = "3";
    //valTurno("Noche",$arrTurno);
  }




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
                    <div class="col-md-12 col-sm-12 col-xs-12">

                          <div class="x_content">
                            <br />
                            <div >

                              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <select class="form-control" id="empresa" onchange="get_produccion()">
                                  <option disabled selected>Selecciona Empresa</option>
                                  <option >RR</option>
                                  <option >AZ</option>
                                </select>
                              </div> 

                              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <input type="number" name="num_empleado" id="num_empleado" class="form-control" placeholder="Número Empleado" onkeyup="buscarEmpleado()">
                              </div>
                              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <button class="btn btn-success btn-block">Buscar</button>
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




            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph">

                  <div class="row x_title">                    
                  </div>

                  <div class="x_content">
                   <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                          <div class="x_content">
                            <br />
                            <div >                              
                                
                            
                            </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="table" >
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                              <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                  <tr class="headings" id='columnas'>
                                    <th class="column-title" id="columnTime">Hora registro</th>
                                    <th class="column-title" id="column">Objetivo</th>
                                    <th class="column-title" id='columnIndicador'>Piezas Buenas</th>
                                    <th class="column-title" id='columnIndicador'>Eficiencia</th>
                                    <th class="column-title" id='columnIndicador'>Tiempo Muerto</th>
                                    <th class="column-title" id='columnIndicador'>Tiempo Muerto Total</th>
                                    <th class="column-title" id='columnIndicador'>Empleado</th>
                                    <th class="column-title" id='columnIndicador'>Pzas Verif</th>
                                    <th class="column-title" id='columnIndicador'>Editar</th>

                                    </th>
                                    <th class="bulk-actions" colspan="7">
                                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                  </tr>
                                </thead>

                                <tbody id="table_produccion">
                                </tbody>
                              </table> 
                        </div>                        
                      </div>                      
                     </div> 
                  </div>

                  <div class="clearfix"></div>
                </div>
              </div>






            <br />


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
  <div class="modal fade" id="modalModificacion" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modal_header">Modificación de Datos</h4>
        </div>
        <div class="modal-body" id="resp_modal">
          <h6 id="titulo"></h6>
          <table class="table table-striped jambo_table bulk_action">
            <thead>
              <tr class="headings" id='columnas'>
                <th class="column-title" id='columnIndicador'>Hora Registro</th>
                <th class="column-title" id='columnIndicador'>Objetivo</th>
                <th class="column-title" id='columnIndicador'>Piezas Buenas</th>
                <th class="column-title" id='columnIndicador'>Eficiencia</th>
                <th class="column-title" id='columnIndicador'>Tiempo Muerto</th>
                <th class="column-title" id='columnIndicador'>Tiempo Muerto Total</th>
                <th class="column-title" id='columnIndicador'>Acción</th>

                </th>
                <th class="bulk-actions" colspan="7">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
              </tr>
            </thead>

            <tbody id="table_prodMod">
            </tbody>
          </table>
          <br>
        
          <br>
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


function get_produccion(){
  var empresa = document.getElementById('empresa').value;
  var table = '';
  $.ajax({
  url: '<?= base_url();?>index.php/home/get_produccion',
  cache: false,
  type: "POST",
  dataType:"text",
  data: {dateNow,empresa},

  success: function(data){
   //var tiempo_muerto_t = document.getElementById('tiempo_muerto_total').value;

    var obj = $.parseJSON(data);
    console.log(obj);
      for (i= 0; i < obj.length; i++) {
         table += "<tr class='even pointer'> <td class= ''>"+obj[i].hora_registro+"</td><td class= ''>"+obj[i].objetivo_hr+"</td> <td class= ''>"+obj[i].piezas_buenas+"</td><td class= ''>"+obj[i].eficiencia+"</td><td class= ''>"+obj[i].tiempo_muerto+"</td><td class= ''>"+obj[i].tiempo_muerto_total+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].piezas_verificadas+"</td><td class=' last'><a  onclick='showProductionData("+obj[i].id_folio_produccion+")'><i class='glyphicon glyphicon-edit'></i></a> </td> </tr>";
            document.getElementById('table_produccion').innerHTML= table;

      }

  },
  error: function(e){
    console.log(e);
    $('#alert_danger').removeAttr('hidden');
    return false;
  }
}); 

}

function buscarEmpleado(){
var input, filter, table, tr, td, i;
  input = document.getElementById("num_empleado");
  filter = input.value.toUpperCase();
  filter = input.value;
  table = document.getElementById("table_produccion");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[6];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }  
}

function showProductionData(id_folio_produccion){
    var empresa = document.getElementById('empresa').value;
    var table = '';
    var titulo='';
    $.ajax({
    url: '<?= base_url();?>index.php/home/get_produccion_data',
    cache: false,
    type: "POST",
    dataType:"text",
    data: {dateNow,empresa,id_folio_produccion},

    success: function(data){
      var obj = $.parseJSON(data);
      console.log(obj);

        for (i= 0; i < obj.length; i++) {
          titulo = "Obj.Hora: "+obj[i].objetivo_hr+"/Empleado: "+obj[i].num_operador;
           table += "<tr class='even pointer'><td>"+obj[i].hora_registro+"</td><td><input type='text' class='form-control' id='objetivo_hr' value="+obj[i].objetivo_hr+"></td><td class= ''><input type='text' class='form-control' id='piezas_buenas' value="+obj[i].piezas_buenas+"></td><td class= ''><input type='text' class='form-control' id='eficiencia' value="+obj[i].eficiencia+"></td><td class= ''><input type='text' class='form-control' id='tiempo_muerto' value="+obj[i].tiempo_muerto+"></td><td class= ''><input type='text' id='tiempo_muerto_total' class='form-control' value="+obj[i].tiempo_muerto_total+"></td><td class= ''><a  onclick='updProductionData("+obj[i].id_reporte_hr+")'><i class='glyphicon glyphicon-refresh'></i></a>|<a  onclick='deleteProductionData("+obj[i].id_reporte_hr+")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
              document.getElementById('titulo').innerHTML= titulo;
              document.getElementById('table_prodMod').innerHTML= table;

        }
      $('#modalModificacion').modal('show');

    },
    error: function(e){
      console.log(e);
      $('#alert_danger').removeAttr('hidden');
      return false;
    }
  });     
}

function updProductionData(id_reporte_hr){
  var piezas_buenas = document.getElementById('piezas_buenas').value;
  var eficiencia = document.getElementById('eficiencia').value;
  var tiempo_muerto = document.getElementById('tiempo_muerto').value;
  var tiempo_muerto_total = document.getElementById('tiempo_muerto_total').value;
  var objetivo_hr = document.getElementById('objetivo_hr').value;

  

    $.ajax({
    url: '<?= base_url();?>index.php/home/updProductionData',
    cache: false,
    type: "POST",
    dataType:"text",
    data: {piezas_buenas,eficiencia,tiempo_muerto,tiempo_muerto_total,id_reporte_hr,objetivo_hr},

    success: function(data){
      alert("Actializacion exitosa");

    },
    error: function(e){
      console.log(e);
      $('#alert_danger').removeAttr('hidden');
      return false;
    }
  });   
}

function deleteProductionData(id_reporte_hr){
    $.ajax({
    url: '<?= base_url();?>index.php/home/deleteProductionData',
    cache: false,
    type: "POST",
    dataType:"text",
    data: {id_reporte_hr},

    success: function(data){
      alert("Registro Eliminado");

    },
    error: function(e){
      console.log(e);
      $('#alert_danger').removeAttr('hidden');
      return false;
    }
  });  
}















  

</script>