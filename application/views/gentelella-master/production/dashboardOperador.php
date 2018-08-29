
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

  $fechaTurno = strtotime ( '-6 hour' , strtotime ( $date ) ) ;
  $fechaNow = date ( 'Y-m-d H:i:s' , $fechaTurno );
  $dateNow = date ( 'Y-m-d' , $fechaTurno );
  $fechaTurno = date ( 'H:i' , $fechaTurno );

  if ($fechaTurno >= '06:00' && $fechaTurno<= '14:29') {
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
  }

  $btn_reg = "<div class='col-md-12 col-sm-12 col-xs-12' style='text-align: center;'>";
  foreach ($arrTurno as $key => $value) {
    $btn_reg .= "<a class='btn btn-primary' id='".$key."' onclick='regHora(".$key.")'>".$value."</a>";
  }
  $btn_reg .= "</div>";
if (!isset($eficiencia)) {
    $eficiencia_val[] = 0;
    $hora_val[] =0;
    $tiempo_val[] = 0;

    $scrap_val[] = 0;

}else{

  foreach ($eficiencia -> result() as $value) {
    $eficiencia_val[] = $value->eficiencia;
    $hora_val[] = $value->hora;
  } 


  foreach ($tiempo -> result() as $value) {
  	if ($value->tiempo_muerto_total < 0) {
  		$tiempo_val[] = 0;
  	}else{
		$tiempo_val[] = $value->tiempo_muerto_total;
  	}
    
  }

  foreach ($scrap -> result() as $value) {
    if ($value->scrap < 0  || is_null($value->scrap)) {
      $scrap_val[] = 0;
    }else{
      $scrap_val[] = $value->scrap;
    }
    
  }
  

  



}

/*function valTurno($turno,$reg){
  $btn_reg = "<div class='col-md-6 col-sm-6 col-xs-12 col-md-offset-3'>";
  foreach ($reg as $key => $value) {
    $btn_reg += "<button class='form-control'>".$value."</button>";
  }
  $btn_reg += "</div>";

  return $btn_reg;
}*/

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
                      <h3>Eficiencia por hora y acumulado</h3>
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
                              <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                  <tr class="headings">
                                    <th class="column-title">Hora</th>
                                    <th class="column-title">Objetivo</th>
                                    <th class="column-title">Pzas Buenas</th>
                                    <th class="column-title">%Eficiencia </th>
                                    <th class="column-title">Pzas Verificadas </th>
                                    <th class="column-title">%Eficiencia Verificada</th>
                                    </th>
                                    <th class="bulk-actions" colspan="7">
                                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                  </tr>
                                </thead>

                                <tbody id="tablaEficiencia">
                                </tbody>
                              </table>                              
                            </div>
                          </div>
                      </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">

                          <div class="x_content">
                            <br />
                            <div id="graficoEficiencia">
           
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
                    <div class="col-md-6">
                      <h3>Tiempo muerto por hora y acumulado</h3>
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
                    <div class="col-md-7 col-sm-7 col-xs-7">

                          <div class="x_content">
                            <br />
                            <div >
                              <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                  <tr class="headings">
                                    <th class="column-title">Hora</th>
                                    <th class="column-title">% Tiempo Muerto</th>
                                    <th class="column-title">Min Perdidios</th>
                                    </th>
                                    <th class="bulk-actions" colspan="7">
                                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                  </tr>
                                </thead>

                                <tbody id="tablaTiempoMuerto">
                                </tbody>
                              </table>       
                              
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
                      <h3>Piezas scrap por hora y acumulado</h3>
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
                    <div class="col-md-7 col-sm-7 col-xs-7">

                          <div class="x_content">
                            <br />
                            <div>
                              <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                  <tr class="headings">
                                    <th class="column-title">Hora</th>
                                    <th class="column-title">Pzas Buenas</th>
                                    <th class="column-title">Pzas Scrap</th>
                                    <th class="column-title">% Scrap </th>
                                    </th>
                                    <th class="bulk-actions" colspan="7">
                                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                  </tr>
                                </thead>

                                <tbody id="tablaPiezasScrap">
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
  var eficiencia_obj =  <?php echo json_encode($eficiencia_val); ?>;
  var hora_obj =  <?php echo json_encode($hora_val); ?>;

  var tiempo_obj =  <?php echo json_encode($tiempo_val); ?>;

  var scrap_obj =  <?php echo json_encode($scrap_val); ?>;

  var hora_arr = $.map(hora_obj, function(value, index) {
  return [value];
  });  

  var eficiencia_arr = $.map(eficiencia_obj, function(value, index) {
  return [value];
  });  
 

  var tiempo_arr = $.map(tiempo_obj, function(value, index) {
  return [value];
  });  


  var scrap_arr = $.map(scrap_obj, function(value, index) {
  return [value];
  });

  for(var i=0; i<eficiencia_arr.length; i++) { eficiencia_arr[i] = parseInt(eficiencia_arr[i], 10); } 

  for(var i=0; i<tiempo_arr.length; i++) { tiempo_arr[i] = parseInt(tiempo_arr[i], 10); } 

  for(var i=0; i<scrap_arr.length; i++) { scrap_arr[i] = parseInt(scrap_arr[i], 10); } 



var fechaNow = "<?= $fechaNow?>";
var num_operador = "<?= $num_empleado?>";
var dateNow = "<?= $dateNow?>";
getDashEficiencia(num_operador,dateNow);

variable['arr_eficiencia'] = [];
variable['arr_hora'] = [];
variable['arr_prueba'] = Array();

$(document).ready(function () {

});

function getDashEficiencia(num_operador,dateNow){
          var table = '';
          var acumulado_objetivo=0;
          var acumulado_piezas_buenas=0;
          var acumulado_eficiencia=0;
          var acumulado_piezas_verificadas=0;
          var acumulado_eficiencia_inspeccion=0;
          var arr_eficiencia = [];
          var arr_hora = [];
          var arr_prueba ="";
          var header = 'Eficiencia por Hora';

          $.ajax({
          url: '<?= base_url();?>index.php/home/getDashEficiencia',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {num_operador,dateNow},

          success: function(data){
          var obj = $.parseJSON(data);

            for (i= 0; i < obj.length; i++) {
              if (obj[i].eficiencia) {
                obj[i].eficiencia = Number(obj[i].eficiencia);
                console.log( typeof obj[i].eficiencia);

              }


            }

            //console.log( typeof obj);

            var obj = $.parseJSON(data);


            for (i= 0; i < obj.length; i++) {

               table += "<tr class='even pointer'> <td class= ''>"+obj[i].hora+"</td><td class= ''>"+obj[i].objetivo_hr+"</td> <td class= ''>"+obj[i].piezas_buenas+"</td> <td class= ''>"+obj[i].eficiencia+"</td><td class= ''>"+obj[i].piezas_verificadas+"</td><td class= ''>"+Math.round(obj[i].piezas_verificadas/obj[i].piezas_buenas*100)+"</td> </tr>";
               arr_eficiencia.push(obj[i].eficiencia); 
               arr_hora.push(obj[i].hora); 
               variable['arr_hora'].push(obj[i].hora); 
               variable['arr_eficiencia'].push(Number(obj[i].eficiencia)); 
 
               acumulado_objetivo += parseInt(obj[i].objetivo_hr);
               acumulado_piezas_buenas += parseInt(obj[i].piezas_buenas);
               acumulado_piezas_verificadas += parseInt(obj[i].piezas_verificadas);
            }

            acumulado_eficiencia = Math.round((acumulado_piezas_buenas/acumulado_objetivo)*100);
            acumulado_eficiencia_inspeccion = Math.round((acumulado_piezas_verificadas/acumulado_piezas_buenas)*100);
            table += "<tr class='even pointer'> <td class= ''><strong>Eficiencia acumulada</strong></td><td class= ''><strong>"+acumulado_objetivo+"</strong></td> <td class= ''><strong>"+acumulado_piezas_buenas+"</strong></td> <td class= ''><strong>"+acumulado_eficiencia+"</strong></td><td class= ''><strong>"+acumulado_piezas_verificadas+"</strong></td><td class= ''><strong>"+acumulado_eficiencia_inspeccion+"</strong></td> </tr>";
            getDashTiempo(num_operador,dateNow);

            document.getElementById('tablaEficiencia').innerHTML= table;
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });

}

/*function getDashEficienciaGraph(num_operador,dateNow){
          var table = '';
          var acumulado_objetivo=0;
          var acumulado_piezas_buenas=0;
          var acumulado_eficiencia=0;
          var arr_eficiencia = [];
          var arr_hora = [];
          var header = 'Eficiencia por Hora';

          $.ajax({
          url: '<?= base_url();?>index.php/home/getDashEficienciaGraph',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {num_operador,dateNow},

          success: function(data){
            var obj = $.parseJSON(data);
            $.each(obj, function(i,value){
              if (value.eficiencia) {obj[i].eficiencia = parseInt(value.eficiencia);}
            });

            variable['arr_prueba'] = obj;

            console.log(obj);

            //for (i= 0; i < data.length; i++) {
              //if (data.eficiencia) {data[i].eficiencia = parseInt(data.eficiencia);}

            //}
            


          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });

}*/

function getDashTiempo(num_operador,dateNow){
          var table = '';
          var acumulado_tiempo_muerto=0;
          var acumulado_tiempo_muerto_total=0;
          var arr_eficiencia = [];
          var arr_hora = [];
          var header = 'Eficiencia por Hora';
          $.ajax({
          url: '<?= base_url();?>index.php/home/getDashTiempo',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {num_operador,dateNow},

          success: function(data){
            var obj = $.parseJSON(data);
            //console.log(obj);

            for (i= 0; i < obj.length; i++) {

               table += "<tr class='even pointer'> <td class= ''>"+obj[i].hora+"</td><td class= ''>"+obj[i].tiempo_muerto+"</td> <td class= ''>"+obj[i].tiempo_muerto_total+"</td></tr>";
               acumulado_tiempo_muerto += parseInt(obj[i].tiempo_muerto);
               acumulado_tiempo_muerto_total += parseInt(obj[i].tiempo_muerto_total);
            }           
            table += "<tr class='even pointer'> <td class= ''><strong>% Tiempo Muerto Acumulado</strong></td><td class= ''><strong>"+acumulado_tiempo_muerto+"</strong></td> <td class= ''><strong>"+acumulado_tiempo_muerto_total+"</strong></td> </tr>";
            getDashScrap(num_operador,dateNow);
            document.getElementById('tablaTiempoMuerto').innerHTML= table;
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });

}
function getDashScrap(num_operador,dateNow){
          var table = '';
          var acumulado_piezas_buenas=0;
          var acumulado_scrap_individual=0;
          var acumulado_scrap=0;
          var arr_eficiencia = [];
          var arr_hora = [];
          var header = 'Eficiencia por Hora';
          $.ajax({
          url: '<?= base_url();?>index.php/home/getDashScrap',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {num_operador,dateNow},

          success: function(data){
            var obj = $.parseJSON(data);
            //console.log(obj);

            for (i= 0; i < obj.length; i++) {

              if (obj[i].scrap_individual) {
                obj[i].scrap_individual =obj[i].scrap_individual;
              }else{
                obj[i].scrap_individual = 0;
              }

              if (obj[i].scrap) {
                obj[i].scrap =obj[i].scrap;
              }else{
                obj[i].scrap = 0;
              }              

               table += "<tr class='even pointer'> <td class= ''>"+obj[i].hora+"</td><td class= ''>"+obj[i].piezas_buenas+"</td> <td class= ''>"+obj[i].scrap_individual+"</td> <td class= ''>"+obj[i].scrap+"</td> </tr>";
               acumulado_piezas_buenas += parseInt(obj[i].piezas_buenas);
               acumulado_scrap_individual += parseInt(obj[i].scrap_individual);
               acumulado_scrap += parseInt(obj[i].scrap);

            }           
            table += "<tr class='even pointer'> <td class= ''><strong>Producción acumulada</strong></td><td class= ''><strong>"+acumulado_piezas_buenas+"</strong></td> <td class= ''><strong>"+acumulado_scrap_individual+"</strong></td> <td class= ''><strong>"+acumulado_scrap+"</strong></td></tr>";

            document.getElementById('tablaPiezasScrap').innerHTML= table;
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });

}





      var Data = [{
        "name": "Series1",
        "data": [86]
    }];
var array = $.map(variable['arr_prueba'], function(value, index) {
    return [value];
});

//console.log(array);

$('#graficoEficiencia').highcharts({
              chart: {
                type: 'column'
              },
              title: {
                text: 'Eficiencia por hora'
              },
              xAxis: {
                  categories: hora_arr
                  // categories: mes
              },
              yAxis: {    
                plotLines: [{
                  color: 'red', // Color value
                  dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                  value: 85, // Value of where the line will appear
                  width: 2 // Width of the line 
                  }],
                title: {
                  text: 'Eficiencia'
                }
              },
              plotOptions: {
                line: {
                  dataLabels: {
                    enabled: true
                  },
                  enableMouseTracking: false
                }
              },
              series: [{
                name: 'Eficiencia',
                data: eficiencia_arr
              }]
          });

$('#graficoTiempo').highcharts({
              chart: {
                type: 'column'
              },
              title: {
                text: 'Tiempo muerto por hora'
              },
              xAxis: {
                  categories: hora_arr
                  // categories: mes
              },
              yAxis: {
                title: {
                  text: 'Tiempo Muerto'
                }
              },
              plotOptions: {
                line: {
                  dataLabels: {
                    enabled: true
                  },
                  enableMouseTracking: false
                }
              },
              series: [{
                name: 'Tiempo muerto',
                data: tiempo_arr
              }]
          });

$('#graficoScrap').highcharts({
              chart: {
                type: 'column'
              },
              title: {
                text: '% Scrap por hora'
              },
              xAxis: {
                  categories: hora_arr
                  // categories: mes
              },
              yAxis: {
                title: {
                  text: 'Eficiencia'
                }
              },
              plotOptions: {
                line: {
                  dataLabels: {
                    enabled: true
                  },
                  enableMouseTracking: false
                }
              },
              series: [{
                name: '% Scrap',
                data: scrap_arr
              }]
          });





$(document).ready(function () {
//console.log(variable['arr_eficiencia']);
//console.log(typeof variable['arr_eficiencia']);


var array = $.map(variable['arr_eficiencia'], function(value, index) {
    console.log(index + "perro" + value);
    //return [value];
});

//console.log(array);

//console.log(typeof array);

      var eficiencia = [{

        "name": "Series2",
        "data": array
    }];






    

});









  

</script>