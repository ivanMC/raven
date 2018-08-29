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

  /*if ($fechaTurno >= '06:00' && $fechaTurno<= '14:29') {
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
  }*/

  //Turnos de 12 horas

  if ($fechaTurno >= '07:00' && $fechaTurno<= '19:00') {
    //$arrTurno = array('07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00','15:00', '16:00', '17:00', '18:00', '19:00');
    $arrTurno = array('07:00-08:00', '08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00', '12:00-13:00', '13:00-14:00','14:00-15:00','15:00-16:00', '16:00-17:00', '17:00-18:00', '18:00-19:00');
    $turno = "1";
    //valTurno("Mañana",$arrTurno);
  //}else if ($fechaTurno >= '19:00' && $fechaTurno<= '07:00') {
  }else {
    //$arrTurno = array('19:00', '20:00', '21:00', '22:00','23:00','00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00','07:00');
    $arrTurno = array('19:00-20:00', '20:00-21:00', '21:00-22:00','22:00-23:00','23:00-00:00', '00:00-01:00', '01:00-02:00', '02:00-03:00','03:00-04:00', '04:00-05:00', '05:00-06:00','06:00-07:00');
     $turno = "2";
    //$btn_reg = valTurno("Tarde",$arrTurno);
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
                            <!--<a href="https://api.whatsapp.com/send?phone=+528119005942&text=I'm%20interested%20in%20your%20services" target="_blank">  Click to WhatsApp Chat</a>!-->
                              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <select class="form-control" id="empresa">
                                  <option disabled selected>Selecciona Empresa</option>
                                  <option >RR</option>
                                  <option >AZ</option>
                                </select>
                              </div>                               
                              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <select class="form-control" id="showTiempo">
                                  <option disabled selected>Selecciona Tiempo</option>
                                  <option value='0'>Turno</option>
                                  <option value='1'>Día</option>
                                  <option value='2'>Semana</option>
                                  <option value='3'>Mes</option>
                                </select>
                              </div>                                
                              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <select class="form-control" id='resumen'>
                                  <option disabled selected>Selecciona Resumen</option>
                                  <option >Operador</option>
                                  <option >No.Parte</option>
                                  <option >Empresa</option>
                                  <option >Maquina</option>
                                </select>
                              </div>                                
                              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <select class="form-control" id="indicador">
                                  <option disabled selected>Selecciona Indicador</option>
                                  <option >Eficiencia</option>
                                  <option >Scrap</option>
                                  <option >Tiempo Muerto</option>
                                  <option >Producción</option>
                                </select>
                              </div>                             
                            </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12" id="selectTurno" hidden>
                        <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                          <select class="form-control"  id="turno">
                            <option disabled selected>Selecciona Turno</option>
                            <option value='1'>Turno de Día</option>
                            <option value='2'>Turno de Tarde</option>
                            <option value='3' >Turno de Noche</option>
                          </select>
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
                                    <th class="column-title" id="columnTime">Turno</th>
                                    <th class="column-title" id="column">Operador</th>
                                    <th class="column-title" id='columnIndicador'>Scrap</th>

                                    </th>
                                    <th class="bulk-actions" colspan="7">
                                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                  </tr>
                                </thead>

                                <tbody id="tableResult">
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
               table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].maquina+"</td> <td class= ''>"+obj[i].eficiencia+"</td> <td><a href='#' onclick='detalle_dia("+obj[i].mes+","+obj[i].dia+",1)'>Ver</a></td></tr>";
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

               table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].id_maquina+"</td> <td class= ''>"+obj[i].eficiencia+"</td></tr>";
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
      empresa : empresa
    }
    var table = "";
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
    }
    hora = [];
    for (var groupName in groups) {
    console.log(groups);  

      hora.push({maquina: groupName, hora: groups[groupName]});
    }


    /*obj.forEach(function (elemento, indice, array) {
        console.log(array);
    });*/

    switch(turno) {
      case "1":
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].hora1+"</td><td class= ''>"+obj[i].hora2+"</td><td class= ''>"+obj[i].hora3+"</td><td class= ''>"+obj[i].hora4+"</td><td class= ''>"+obj[i].hora5+"</td><td class= ''>"+obj[i].hora6+"</td><td class= ''>"+obj[i].hora7+"</td><td class= ''>"+obj[i].hora8+"</td><td class= ''>"+obj[i].hora9+"</td></tr>";
          }      
          break;
      case "2":
      console.log("turno2");
        for (i= 0; i < obj.length; i++) {
          table += "<tr class='even pointer'> <td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].hora1+"</td><td class= ''>"+obj[i].hora2+"</td><td class= ''>"+obj[i].hora3+"</td><td class= ''>"+obj[i].hora4+"</td><td class= ''>"+obj[i].hora5+"</td><td class= ''>"+obj[i].hora6+"</td><td class= ''>"+obj[i].hora7+"</td><td class= ''>"+obj[i].hora8+"</td><td class= ''>"+obj[i].hora9+"</td><td class= ''>"+obj[i].hora10+"</td></tr>";
        }
          break;
      case "3":
        for (i= 0; i < obj.length; i++) {
          table += "<tr class='even pointer'> <td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].hora1+"</td><td class= ''>"+obj[i].hora2+"</td><td class= ''>"+obj[i].hora3+"</td><td class= ''>"+obj[i].hora4+"</td><td class= ''>"+obj[i].hora5+"</td><td class= ''>"+obj[i].hora6+"</td><td class= ''>"+obj[i].hora7+"</td></tr>";
        }
          break;
      default:
      console.log("turnoDefault");
        for (i= 0; i < obj.length; i++) {
          table += "<tr class='even pointer'> <td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].hora1+"</td><td class= ''>"+obj[i].hora2+"</td><td class= ''>"+obj[i].hora3+"</td><td class= ''>"+obj[i].hora4+"</td><td class= ''>"+obj[i].hora5+"</td><td class= ''>"+obj[i].hora6+"</td><td class= ''>"+obj[i].hora7+"</td><td class= ''>"+obj[i].hora8+"</td><td class= ''>"+obj[i].hora9+"</td><td class= ''>"+obj[i].hora10+"</td></tr>";
        }
    }
        document.getElementById('tablaEficienciaDiaria').innerHTML= table;
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


$( "#showTiempo" ).change(function() {
  var option="<div class='col-md-3 col-sm-6 col-xs-12 form-group has-feedback'><select class='form-control' id='selectSemana'><option disabled selected>Selecciona...</option>";
  var opTiempo = $("#showTiempo option:selected").text();

  $('#selectTurno').removeAttr('hidden');

  if (opTiempo == 'Turno') {
    document.getElementById('selectTurno').innerHTML = "<div class='col-md-3 col-sm-6 col-xs-12 form-group has-feedback'><select class='form-control' id='select_turno' ><option disabled selected>Selecciona Turno</option><option value='1'>Turno de Día</option><option value='2'>Turno de Tarde</option><option value='3'>Turno de Noche</option></select></div><div class='col-md-3 col-sm-6 col-xs-12 form-group has-feedback'><button class='btn btn-success btn-block' onclick='showTable(1)'>Ir</button></div>";
  }else if(opTiempo == 'Día'){
    document.getElementById('selectTurno').innerHTML = "<div class='col-md-3 col-sm-6 col-xs-12 form-group has-feedback'><input type='date' class='form-control' id='fechaReporte'></div><div class='col-md-3 col-sm-6 col-xs-12 form-group has-feedback'><button class='btn btn-success btn-block' onclick='showTable(2)'>Ir</button></div>";
  }else if( opTiempo == 'Semana' ){
    var semana = ['2018-01-01','2018-01-08','2018-01-15','2018-01-22','2018-01-29', '2018-02-05','2018-02-12','2018-02-19','2018-02-26', '2018-03-05','2018-03-12','2018-03-19','2018-03-26', '2018-04-02','2018-04-09','2018-04-16','2018-04-23','2018-04-30', '2018-05-07','2018-05-14','2018-05-21','2018-05-28', '2018-06-04','2018-06-11','2018-06-18','2018-06-25', '2018-07-02','2018-07-09','2018-07-16','2018-07-23','2018-04-30', '2018-08-06','2018-08-13','2018-08-20','2018-08-27', '2018-09-03','2018-09-10','2018-09-17','2018-09-24', '2018-10-01','2018-10-08','2018-10-15','2018-10-22','2018-10-29', '2018-11-05','2018-11-12','2018-11-19','2018-11-26', '2018-12-03','2018-12-10','2018-12-17','2018-12-24','2018-12-231']; 
    for (i= 1; i < 52; i++) {
        option += "<option value="+semana[i]+">"+i+"</option>";
    }
    option += "</select></div><div class='col-md-3 col-sm-6 col-xs-12 form-group has-feedback'><button class='btn btn-success btn-block' onclick='showTable(3)'>Ir</button></div>";
    document.getElementById('selectTurno').innerHTML = option;
  }else if(opTiempo == 'Mes'){
    document.getElementById('selectTurno').innerHTML = "<div class='col-md-3 col-sm-6 col-xs-12 form-group has-feedback'><select class='form-control' id='select_mes'><option disabled selected>Selecciona Mes</option><option value='01'>Enero</option><option value='02'>Febrero</option><option value='03'>Marzo</option><option value='04'>Abril</option><option value='05'>Mayo</option><option value='06'>Junio</option><option value='07'>Julio</option><option value='08'>Agosto</option><option value='09'>Septiembre</option><option value='10'>Octubre</option><option value='11'>Noviembre</option><option value='12'>Diciembre</option></select></div><div class='col-md-3 col-sm-6 col-xs-12 form-group has-feedback'><button class='btn btn-success btn-block' onclick='showTable(4)'>Ir</button></div>";    
  }
});



function showTable(opTiempo){
  console.log(opTiempo);

  var empresa = document.getElementById('empresa').value;
  var opcion_tiempo = document.getElementById('showTiempo').value;
  var resumen = document.getElementById('resumen').value;
  var indicador = document.getElementById('indicador').value;
  

  var datos = {};
  datos.empresa =  empresa
  datos.opcion_tiempo =  opcion_tiempo
  datos.resumen =  resumen
  datos.indicador =  indicador;
  


  if (opcion_tiempo == 0 && indicador=='Scrap') {
    //turno
    var turno = document.getElementById('select_turno').value;
    datos.turno = turno;
    datos.dateNow = dateNow;
    showSrapTable(datos);
    console.log(datos);

  }else if (opcion_tiempo == 1 && indicador=='Scrap') {
    //dia
    var fechaReporte = document.getElementById('fechaReporte').value;
    datos.fechaReporte = fechaReporte;
    showSrapTable(datos);
    console.log(datos);
  }else if(opcion_tiempo == 2 && indicador=='Scrap'){
    //semana
    var numero_semana = $("#selectSemana option:selected").text()
    datos.numero_semana = numero_semana;
    showSrapTable(datos);
    console.log(datos);
  }else if(opcion_tiempo == 3 && indicador=='Scrap'){
    var numero_mes = document.getElementById('select_mes').value;
    datos.numero_mes = numero_mes;
    showSrapTable(datos);
    console.log(datos);
  }else  if (opcion_tiempo == 0 && indicador=='Eficiencia') {
    //turno
    var turno = document.getElementById('select_turno').value;
    datos.turno = turno;
    datos.dateNow = dateNow;
    showEficienciaTable(datos);
    console.log(datos);

  }else if (opcion_tiempo == 1 && indicador=='Eficiencia') {
    //dia
    var fechaReporte = document.getElementById('fechaReporte').value;
    datos.fechaReporte = fechaReporte;
    showEficienciaTable(datos);
    console.log(datos);
  }else if(opcion_tiempo == 2 && indicador=='Eficiencia'){
    //semana
    var numero_semana = $("#selectSemana option:selected").text()
    datos.numero_semana = numero_semana;
    showEficienciaTable(datos);
    console.log(datos);
  }else if(opcion_tiempo == 3 && indicador=='Eficiencia'){
    var numero_mes = document.getElementById('select_mes').value;
    datos.numero_mes = numero_mes;
    showEficienciaTable(datos);
    console.log(datos);
  }else  if (opcion_tiempo == 0 && indicador=='Tiempo Muerto') {
    //turno
    var turno = document.getElementById('select_turno').value;
    datos.turno = turno;
    datos.dateNow = dateNow;
    showTiempoTable(datos);
    console.log(datos);

  }else if (opcion_tiempo == 1 && indicador=='Tiempo Muerto') {
    //dia
    var fechaReporte = document.getElementById('fechaReporte').value;
    datos.fechaReporte = fechaReporte;
    showTiempoTable(datos);
    console.log(datos);
  }else if(opcion_tiempo == 2 && indicador=='Tiempo Muerto'){
    //semana
    var numero_semana = $("#selectSemana option:selected").text()
    datos.numero_semana = numero_semana;
    showTiempoTable(datos);
    console.log(datos);
  }else if(opcion_tiempo == 3 && indicador=='Tiempo Muerto'){
    var numero_mes = document.getElementById('select_mes').value;
    datos.numero_mes = numero_mes;
    showTiempoTable(datos);
    console.log(datos);
  }else  if (opcion_tiempo == 0 && indicador=='Producción') {
    //turno
    var turno = document.getElementById('select_turno').value;
    datos.turno = turno;
    datos.dateNow = dateNow;
    showProduccionTable(datos);
    console.log(datos);

  }else if (opcion_tiempo == 1 && indicador=='Producción') {
    //dia
    var fechaReporte = document.getElementById('fechaReporte').value;
    datos.fechaReporte = fechaReporte;
    showProduccionTable(datos);
    console.log(datos);
  }else if(opcion_tiempo == 2 && indicador=='Producción'){
    //semana
    var numero_semana = $("#selectSemana option:selected").text()
    datos.numero_semana = numero_semana;
    showProduccionTable(datos);
    console.log(datos);
  }else if(opcion_tiempo == 3 && indicador=='Producción'){
    var numero_mes = document.getElementById('select_mes').value;
    datos.numero_mes = numero_mes;
    showProduccionTable(datos);
    console.log(datos);
  }


}

function showSrapTable(datos){
    var table = '';
    var column = '';
    var columnTime = '';
    $.ajax({
    url: '<?= base_url();?>index.php/home/showSrapTable',
    cache: false,
    type: "POST",
    dataType:"text",
    data: datos,

    success: function(data){
    var obj = $.parseJSON(data);
    console.log(obj);

    


      
      //
      if (datos.empresa == 'AZ') {
if (obj[0].num_operador) {
      column = 'Operador';
      if (obj[0].turno) {
        
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }
        columnTime = 'Turno'

                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }
         

    }else if(obj[0].no_parte){
      column = 'No.Parte';
      if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }


    }else if(obj[0].empresa){
      column = 'Empresa';
       if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }  
         
    }else if (obj[0].maquina) {
      column = 'Maquina';
       if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Incompleta_Falta_com+"</td> <td class= ''>"+obj[i].Rotas_Quebradas+"</td> <td class= ''>"+obj[i].Rafagas+"</td> <td class= ''>"+obj[i].Flap_Robot+"</td> <td class= ''>"+obj[i].Exceso_de_rebaba+"</td> <td class= ''>"+obj[i].Grietas+"</td> <td class= ''>"+obj[i].Manchas+"</td> <td class= ''>"+obj[i].Piezas_en_el_piso+"</td> <td class= ''>"+obj[i].Mala_impresion+"</td> <td class= ''>"+obj[i].Brilo_fuera_de_espec+"</td> <td class= ''>"+obj[i].Color_fuera_de_espec+"</td><td>"+obj[i].Dimension_fuera_de_e+"</td><td>"+obj[i].Contaminado+"</td><td>"+obj[i].Setup_Ajustes+"</td><td>"+obj[i].Quemado+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }  
         
    }        
            document.getElementById('columnas').innerHTML= "<th class='column-title' >"+columnTime+"</th><th class='column-title' >"+column+"</th><th class='column-title' >Scrap</th><th class='column-title' >Incompleta_Falta com</th> <th class='column-title' >Rotas_Quebradas</th> <th class='column-title' >Rafagas</th> <th class='column-title' >Flap_Robot</th> <th class='column-title' >Exceso Rebaba</th> <th class='column-title' >Grietas</th> <th class='column-title' >Manchas</th> <th class='column-title' >Pzas en el piso</th> <th class='column-title' >Mala impresion</th> <th class='column-title' >Brillo fuera de espec</th> <th class='column-title' >Color fuera de espec</th><th class='column-title' >Dimension fuera de e</th><th class='column-title' >Contaminado</th><th class='column-title' >Setup_Ajustes</th><th class='column-title' >Quemado</th>";
      }else{
if (obj[0].num_operador) {
      column = 'Operador';
      if (obj[0].turno) {
        
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }
        columnTime = 'Turno'

                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }
         

    }else if(obj[0].no_parte){
      column = 'No.Parte';
      if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }


    }else if(obj[0].empresa){
      column = 'Empresa';
       if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }  
         
    }else if (obj[0].maquina) {
      column = 'Maquina';
       if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].scrap+"</td><td class= ''>"+obj[i].Burbuja+"</td> <td class= ''>"+obj[i].Piezas_en_el_Piso+"</td> <td class= ''>"+obj[i].Contaminacion+"</td> <td class= ''>"+obj[i].Cruda+"</td> <td class= ''>"+obj[i].Deforme+"</td> <td class= ''>"+obj[i].Despegada+"</td> <td class= ''>"+obj[i].Grieta+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Incompleta+"</td> <td class= ''>"+obj[i].Rebaba_Moldeada+"</td> <td class= ''>"+obj[i].Rota+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }  
         
    }        
            document.getElementById('columnas').innerHTML= "<th class='column-title' >"+columnTime+"</th><th class='column-title' >"+column+"</th><th class='column-title' >Scrap</th><th class='column-title' >Burbuja</th> <th class='column-title' >Piezas en el Piso</th> <th class='column-title' >Contaminacion</th> <th class='column-title' >Cruda</th> <th class='column-title' >Deforme</th> <th class='column-title' >Despegada</th> <th class='column-title' >Grieta</th> <th class='column-title' >Material de empaque</th> <th class='column-title' >Incompleta</th> <th class='column-title' >Rebaba Moldeada</th> <th class='column-title' >Rota</th>";  
      }

      document.getElementById('tableResult').innerHTML= table;
 
    },
    error: function(e){
      console.log(e);
      $('#alert_danger').removeAttr('hidden');
      return false;
    }
 });  

}

function showEficienciaTable(datos){
    var table = '';
    var column = '';
    var columnTime = '';
    $.ajax({
    url: '<?= base_url();?>index.php/home/showEficienciaTable',
    cache: false,
    type: "POST",
    dataType:"text",
    data: datos,

    success: function(data){
    var obj = $.parseJSON(data);
    console.log(obj);

    if (obj[0].num_operador) {
      column = 'Operador';
      if (obj[0].turno) {
        
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }
        columnTime = 'Turno'

                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }
         

    }else if(obj[0].no_parte){
      column = 'No.Parte';
      if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }


    }else if(obj[0].empresa){
      column = 'Empresa';
       if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }  
         
    }else if (obj[0].maquina) {
      column = 'Maquina';
       if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].eficiencia+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }  
         
    }


      document.getElementById('tableResult').innerHTML= table;
      
      
      document.getElementById('columnas').innerHTML= "<th class='column-title' >"+columnTime+"</th><th class='column-title' >"+column+"</th><th class='column-title' >Eficiencia</th>"; 
    },
    error: function(e){
      console.log(e);
      $('#alert_danger').removeAttr('hidden');
      return false;
    }
 });  

}


function showTiempoTable(datos){
var table = '';
    var column = '';
    var columnTime = '';
    $.ajax({
    url: '<?= base_url();?>index.php/home/showTiempoTable',
    cache: false,
    type: "POST",
    dataType:"text",
    data: datos,

    success: function(data){
    var obj = $.parseJSON(data);
    console.log(obj);

    if (obj[0].num_operador) {
      column = 'Operador';
      if (obj[0].turno) {
        
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }
        columnTime = 'Turno'

                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }
         

    }else if(obj[0].no_parte){
      column = 'No.Parte';
      if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }


    }else if(obj[0].empresa){
      column = 'Empresa';
       if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }  
         
    }else if (obj[0].maquina) {
      column = 'Maquina';
       if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].tiempo+"</td><td class= ''>"+obj[i].Falla_de_maquina+"</td> <td class= ''>"+obj[i].Falla_de_suministros+"</td> <td class= ''>"+obj[i].Falta_de_materia_pri+"</td> <td class= ''>"+obj[i].Materia_prima_fuera+"</td> <td class= ''>"+obj[i].Falta_de_material_de+"</td> <td class= ''>"+obj[i].Material_de_empaque+"</td> <td class= ''>"+obj[i].Ciclo_de_maquina_may+"</td> <td class= ''>"+obj[i].Ajuste_de_procesos+"</td> <td class= ''>"+obj[i].Falla_de_molde+"</td> <td class= ''>"+obj[i].Cambio_de_molde+"</td> <td class= ''>"+obj[i].Arranque+"</td> <td class= ''>"+obj[i].Ausentismo+"</td>  <td class= ''>"+obj[i].Falta_de_Programa+"</td> <td class= ''>"+obj[i].Personal_en_WC_Comid+"</td> <td class= ''>"+obj[i].Personal_sin_habilid+"</td> <td class= ''>"+obj[i].Pruebas_de_nuevos_pr+"</td> <td class= ''>"+obj[i].Falta_completar_plan+"</td> <td class= ''>"+obj[i].Falta_de_equipo_de_p+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }  
         
    }


      document.getElementById('tableResult').innerHTML= table;
      
      
      document.getElementById('columnas').innerHTML= "<th class='column-title' >"+columnTime+"</th><th class='column-title' >"+column+"</th><th class='column-title' >Tiempo Muerto</th><th>Falla de maquina</th> <th>Falla de suministros</th> <th>Falta de materia pri</th> <th>Materia prima fuera</th> <th>Falta de material de</th> <th>Material de empaque</th> <th>Ciclo de maquina may</th> <th>Ajuste de procesos</th> <th>Falla de molde</th> <th>Cambio de molde</th> <th>Arranque</th> <th>Ausentismo</th> <th>Falta de Programa</th> <th>Personal en WC Comid</th> <th>Personal sin habilid</th> <th>Pruebas de nuevos pr</th> <th>Falta completar plan</th> <th>Falta de equipo de p</th>";
    },
    error: function(e){
      console.log(e);
      $('#alert_danger').removeAttr('hidden');
      return false;
    }
 });    

}

function showProduccionTable(datos){
var table = '';
    var column = '';
    var columnTime = '';
    $.ajax({
    url: '<?= base_url();?>index.php/home/showProduccionTable',
    cache: false,
    type: "POST",
    dataType:"text",
    data: datos,

    success: function(data){
    var obj = $.parseJSON(data);
    console.log(obj);

    if (obj[0].num_operador) {
      column = 'Operador';
      if (obj[0].turno) {
        
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }
        columnTime = 'Turno'

                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].num_operador+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }
         

    }else if(obj[0].no_parte){
      column = 'No.Parte';
      if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].no_parte+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }


    }else if(obj[0].empresa){
      column = 'Empresa';
       if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].empresa+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }  
         
    }else if (obj[0].maquina) {
      column = 'Maquina';
       if (obj[0].turno) {
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].turno+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
             columnTime = 'Turno'
          }  
                 
      }else if(obj[0].fecha){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].fecha+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }  
          columnTime = 'Dia'
      }else if(obj[0].semana){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].semana+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }  
          columnTime = 'Semana'
      }else if(obj[0].mes){
          for (i= 0; i < obj.length; i++) {

             table += "<tr class='even pointer'> <td class= ''>"+obj[i].mes+"</td><td class= ''>"+obj[i].maquina+"</td><td class= ''>"+obj[i].produccion+"</td> </tr>";
          }  
          columnTime = 'Mes'
      }  
         
    }


      document.getElementById('tableResult').innerHTML= table;
      
      
      document.getElementById('columnas').innerHTML= "<th class='column-title' >"+columnTime+"</th><th class='column-title' >"+column+"</th><th class='column-title' >Producción</th>";
    },
    error: function(e){
      console.log(e);
      $('#alert_danger').removeAttr('hidden');
      return false;
    }
 }); 
}















  

</script>