<style type="text/css">
         table {
            width: 100%;
        }

        thead, tbody, tr, td, th { display: block; }

        tr:after {
            content: ' ';
            display: block;
            visibility: hidden;
            clear: both;
        }

        thead th {
            height: 30px;

            /*text-align: left;*/
        }

        tbody {
            height: 200px;
            overflow-y: auto;
        }

        thead {
            /* fallback */
        }


        tbody td, thead th {
            width: 16%;
            float: left;
        }

        @media screen and (min-width: 700px) {
          tbody {
              height: 140px;
              overflow-y: auto;
          }
        }        
       </style> 
</style>       

         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
          <!-- page content -->
          <div class="right_col" role="main" >


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph">

                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3>Crear Usuario</h3>
                    </div>
                    <div class="col-md-6" hidden>
                      <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                      </div>
                    </div>
                  </div>

                  <div class="x_content">
                    <br />
                    <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="numEmpleado">Número de Empleado <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="numEmpleado" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nombre" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="psswd">Contraseña <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="psswd" name="psswd" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento">Departamento:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="departamento" class="form-control" required>
                              <option value="" selected disabled>Selecciona Departamento</option>
                              <option value="Operador">Operador</option>
                              <option value="Produccion">Producción</option>
                              <option value="Mantenimiento">Mantenimiento</option>
                              <option value="Procesos">Procesos</option>
                              <option value="RH">RH</option>
                              <option value="Materiales">Materiales</option>
                              <option value="Seguridad">Seguridad</option>
                              <option value="Proyectos">Proyectos</option>
                            </select>
                          </div>
                        </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categoria">Categoria:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="categoria" class="form-control" required>
                              <option value="" selected disabled>Selecciona Categoria</option>
                              <option value="Produccion">Entrenador</option>
                              <option value="Operador">Operador</option>
                              <option value="Mantenimiento">Lider</option>
                            </select>
                          </div>
                        </div>                        
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento">Empresa:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="empresa" class="form-control" required>
                              <option value="" selected disabled>Selecciona Empresa</option>
                              <option value="RR">RR</option>
                              <option value="AZ">AZ</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="razon">Razon Social <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="razon" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group" hidden>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Empresa</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div  class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="empresa" value="AZ"> &nbsp; AZ &nbsp;
                            </label>
                            <label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="empresa" value="Raven"> Raven
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button  class="btn btn-success" onclick="guardarEmpleado()">Guardar</button>
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
                <strong>Empleado Registrado Correctamente!</strong> <a href="#" class="alert-link"></a>
              </div>

              <div class="alert alert-danger" role="alert" id="alert_danger" hidden>
                <strong>Empleado No Registrado !</strong> <a href="#" class="alert-link"></a>
              </div>
            <div class="row">


              <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel tile fixed_height_320">
                  <div class="x_title">
                    <h2>Usuarios Registrados</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive table-fixed" style="overflow-y: auto;">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title"># Empleado</th>
                            <th class="column-title">Contraseña </th>
                            <th class="column-title">Departamento </th>
                            <th class="column-title">Empresa </th>
                            <th class="column-title">Activo </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody id='response'>
                          <?php
                          /*foreach ($empleados as $key => $value) {
                          echo "<tr class='even pointer'>";
                            echo "<td class='a-center '>";
                              echo "<div class='icheckbox_flat-green' style='position: relative;'><input type='checkbox' class='flat' name='table_records' style='position: absolute; opacity: 0;'><ins class='iCheck-helper' style='position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;'></ins></div>";
                           echo  "</td>";
                            echo "<td class= ''>".$value['num_empleado']."</td>";
                            echo "<td class= ''>".$value['password']."</td>";
                            echo "<td class= ''>".$value['departamento']."</td>";
                            echo "<td class= ''>".$value['empresa']."</td>";
                            echo "<td class= ''>".$value['activo']."</td>";
                            echo "<td class=' last'><a href='#'>View</a>";
                            echo "</td>";
                          echo "</tr>";
                          }*/

                          ?>
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
          <h4 class="modal-title" id="modal_header">Modal Header</h4>
        </div>
        <div class="modal-body" id="resp_modal">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<script type="text/javascript">

  $(document).ready(function () 
  {
    var table = "";
    $.ajax({
            url: '<?= base_url();?>index.php/home/get_empleados',
            cache: false,
            type: "POST",
            dataType:"text",
            data: "get_empleados",

            success: function(data){
              var obj = $.parseJSON(data);
              for (i= 0; i < obj.length; i++) {

                 table += "<tr class='even pointer'> <td class= ''>"+obj[i].num_empleado+"</td> <td class= ''>"+obj[i].password+"</td> <td class= ''>"+obj[i].departamento+"</td> <td class= ''>"+obj[i].empresa+"</td> <td class= ''>"+obj[i].activo+"</td> <td class=' last'><a href='#' data-toggle='modal' data-target='#myModal' onclick='showEmpleado("+obj[i].id_empleado+")'>Editar</a> </td> </tr>"; 
              }
              document.getElementById('response').innerHTML= table;
            },
            error: function(e){
              console.log(e);
              alert('No hay información disponible.');
              return false;
            }
         });
  });

  function guardarEmpleado()
  {
    var num_empleado = document.getElementById('numEmpleado').value;
    var contrasena = document.getElementById('psswd').value;
    var departamento = document.getElementById('departamento').value;
    var empresa = document.getElementById('empresa').value;
    var nombre = document.getElementById('nombre').value;
    var razon = document.getElementById('razon').value;

    var datos_empleado = {
      num_empleado :num_empleado,
      contrasena : contrasena,
      departamento:departamento,
      empresa:empresa,
      nombre : nombre,
      razon : razon
    }
    console.log(datos_empleado);
    $.ajax({
          url: '<?= base_url();?>index.php/home/guardarEmpleado',
          cache: false,
          type: "POST",
          dataType:"text",
          data: datos_empleado,

          success: function(data){
            $('#alert').removeAttr('hidden');
            setTimeout(window.location.replace("<?=base_url()?>index.php/home/ajustes"), 3000);
            //$( "alert-success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });
  }


  function showEmpleado(id_empleado)
  {
    $.ajax({
          url: '<?= base_url();?>index.php/home/showEmpleado',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {id_empleado},

          success: function(data){
              var obj = $.parseJSON(data);
              console.log(obj);

              var resp_modal = "<label>Contraseña: </label><input type='text'  class='form-control' name='psswd' id='contrasena_upd' value='"+obj[0].password+"'  style='text-align:center;'><label>Departamento:</label><input type='text' class='form-control' name='departamento' id='departamento_upd' value='"+obj[0].departamento+"'  style='text-align:center;'<label>Empresa:</label><input type='text' class='form-control' name='empresa' id='empresa_upd' value='"+obj[0].empresa+"'  style='text-align:center;'><label>Activo:</label><input type='text' class='form-control' name='activo' id='activo_upd' value='"+obj[0].activo+"'  style='text-align:center;'><br><button class='btn btn-success btn-block' onclick='updateEmpleado("+obj[0].id_empleado+")'>Editar</button>";

              document.getElementById('modal_header').innerHTML = "Editando Empleado : "+obj[0].num_empleado;
              document.getElementById('resp_modal').innerHTML = resp_modal;
            },
          error: function(e){
            console.log(e);
            return false;
          }
       });
  }

  function updateEmpleado(id_empleado)
  {
    var contrasena = document.getElementById('contrasena_upd').value;
    var departamento = document.getElementById('departamento_upd').value;
    var empresa = document.getElementById('empresa_upd').value;
    var activo = document.getElementById('activo_upd').value;

    var datos_empleado = {
      id_empleado :id_empleado,
      contrasena : contrasena,
      departamento:departamento,
      empresa:empresa,
      activo: activo
    }
    console.log(datos_empleado);
    $.ajax({
          url: '<?= base_url();?>index.php/home/updateEmpleado',
          cache: false,
          type: "POST",
          dataType:"text",
          data: datos_empleado,

          success: function(data){
            $('#alert').removeAttr('hidden');
            setTimeout(window.location.replace("<?=base_url()?>index.php/home/ajustes"), 3000);
            //$( "alert-success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       }); 
  }

</script>