
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

//3 turnos
  /*if ($fechaTurno >= '06:00' && $fechaTurno<= '14:30') {
    $arrTurno = array('07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '14:30');
    $turno = "1";
    //valTurno("Mañana",$arrTurno);
  }else if ($fechaTurno >= '14:31' && $fechaTurno<= '22:29') {
    $arrTurno = array('15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00','22:30');
     $turno = "2";
    //$btn_reg = valTurno("Tarde",$arrTurno);
  }else {
    $arrTurno = array('23:00','00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00');
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
    $btn_reg .= "<a class='btn btn-primary hora' id='".$key."' >".$value."</a>";
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
                    <div class="col-md-8">
                      <h3 id="headerReporte">Reporte de Producción</h3>
                        <div class="col-md-4 col-sm-6 col-xs-12 " hidden>
                          <button class="btn btn-success" onclick="cambio();"> <span class="glyphicon glyphicon-refresh"></span> Cambio</button>
                        </div>
                    </div>
                    <div class="col-md-6" hidden >
                      <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                      </div>
                    </div>
                    <div class="col-md-4"  >
                      <div  class="pull-right">
                          <button class="btn btn-success" onclick="cambio();"> <span class="glyphicon glyphicon-refresh"></span> Cambio</button>
                      </div>
                    </div>                    
                  </div>

                  <div class="x_content">
           <div class="row">
                    <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" >
                     
                      <div class="form-group">
                        <div hidden>
                        <input type="text" id="txt" disabled hidden>
                        </div>
                          <br>
                            <?= $btn_reg;?>
                        </div>                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fechaReporte">Fecha <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="fechaReporte" required="required" class="form-control col-md-7 col-xs-12" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="piezasBuenas">Piezas Buenas <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="piezasBuenas" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="piezasVerificadas">Piezas Verificadas <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="piezasVerificadas" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group" style="text-align: center;">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button  class="btn btn-success btn-block" id="btn_reporteHr" onclick="insert_reporteHr()">Guardar</button>
                        </div>
                      </div>
                      <div class="ln_solid"></div>

                      <br>                      
                      <div class="form-group">
                        <div class="form-group" style="text-align: center;">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button  class="btn btn-primary btn-block" id="btn_reporteHr" onclick="scrapModal()">Registro Scrap y Tiempo Muerto</button>
                        </div>
                      </div>
                      </div> 


                    </div>          
                <section hidden>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="maquina" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="text" id="folio_produccion" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="text" id="status" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="text" id="objetivo_hora" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="text" id="id_reporte" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="text" id="tiempo_muerto_total" required="required" class="form-control col-md-7 col-xs-12">
                        </div> 
                    <div class="wizard">
             

                        <div>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                                  <!-- form input mask -->

              <!-- /form input mask -->
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">

                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <h3>Step 3</h3>
                                    <p>This is step 3</p>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                                        <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="complete">
                                    <h3>Complete</h3>
                                    <p>You have successfully completed all steps.</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </section>
               </div>                    
                    <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" hidden>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="numEmpleado">Número de Empleado <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="numEmpleado" required="required" class="form-control col-md-7 col-xs-12">
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
                              <option value="Raven">Raven</option>
                              <option value="AZ">AZ</option>
                            </select>
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
                <strong>Registro Exitoso!</strong> <a href="#" class="alert-link"></a>
              </div>

              <div class="alert alert-danger" role="alert" id="alert_danger" hidden>
                <strong>No Registrado !</strong> <a href="#" class="alert-link"></a>
              </div>

                <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" >
                  <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                      <h2>Registro Hora X Hora</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="table-responsive table-fixed" style="overflow-y: auto;">
                        <table class="table table-striped jambo_table bulk_action">
                          <thead>
                            <tr class="headings">
                              <th class="column-title">Hora</th>
                              <th class="column-title">Objetivo x Hora</th>
                              <th class="column-title">Pzas Buenas</th>
                              <th class="column-title">%Eficiencia</th>
                              <th class="column-title">%Tiempo Muerto</th>
                              <th class="column-title">Tiempo Muerto Total</th>
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


                <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Piezas Scrap</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Defecto</th>
                          <th>Scrap Individual</th>
                          <th>%Scrap</th>
                          <th>Tiempo Pzas Scrap</th>
                        </tr>
                      </thead>
                      <tbody id="table_scrap">
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>


              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tiempos Muertos</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Departamento</th>
                          <th>Motivo</th>
                          <th>Tiempo Muerto Ind.</th>
                        </tr>
                      </thead>
                      <tbody id="table_tiempos">
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>

              <div class="clearfix"></div>
            </div>              
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
  <div class="modal fade" id="myModalReporte" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Reporte de Scrap y Tiempo Muerto</h4>
        </div>
        <div class="modal-body" >
            <div class="container">
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#scrapTab" onclick="scrapModal()">Piezas Scrap</a></li>
                <li><a data-toggle="tab" href="#tiempoMuertoTab" onclick="tiempoModal()">Tiempo Muerto</a></li>
              </ul>

              <div class="tab-content">
                <div id="scrapTab" class="tab-pane fade in active">
                  <br>
                  <select class='form-control' id="select_defecto">
                    
                  </select>
                  <br>
                  <select class='form-control' id="select_check">
                    
                  </select> 
                  <br>
                  <input type="text" id="cantidad" class="form-control" placeholder="Scrap">
                  <br>
                  <button class="btn btn-primary btn-block" onclick="getIdHr();">Guardar</button> 
                </div>
                <div id="tiempoMuertoTab" class="tab-pane fade">
                  <br>
                  <select class='form-control' id="select_departamento">
                    
                  </select>
                  <br>
                  <select class='form-control' id="select_motivo">
                    
                  </select>
                  <br>
                  <input type="text" id="tiempo" class="form-control" placeholder="Tiempo Muerto">
                  <br>
                  <button class="btn btn-primary btn-block" onclick="insert_tiempo()">Guardar</button> 
                </div>
              </div>
            </div>        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>  
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
              <select class="form-control" id="maquinaParte" onchange="getMaquinaInfo();">
                
              </select>                          
          <br>
          <input type="text" id="new_orden" class="form-control" placeholder="# Orden">
          <br>
          <input type="text" id="new_lote" class="form-control" placeholder="# Lote Materia Prima">
          <br>
          <input type="text" id="new_inspeccion" class="form-control" placeholder="# Inspección">
          <div hidden>
            <input type="text" id="id_maquina" class="form-control" >
          </div>
          <br>
          <button class="btn btn-primary btn-block" id="guardarNewReporte">Guardar</button>         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>  
<script type="text/javascript">



var time = startTime();
      function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        h = checkTime(h);
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('txt').value =
        h + ":" + m + ":" + s;
        var fechaNow = h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
        return fechaNow;
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }

var num_operador = "<?= $num_empleado?>";
var dateNow = "<?= $dateNow?>";
var hora = document.getElementById('txt').value ;
var fechaNow = dateNow+" "+hora;
var id_reporte = document.getElementById('id_reporte').value;


  showDataTurnoHr(num_operador,dateNow);
  getId();
  showHeader(num_operador,dateNow);
  //showDataTiempo(num_operador,dateNow,id_reporte);
  //showDataScrap(num_operador,dateNow,id_reporte);

$(document).ready(function () {
      function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('txt').innerHTML =
        h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
});


function showHeader(num_operador,dateNow){
  var header = '';
  $.ajax({
      url: '<?= base_url();?>index.php/home/showHeader',
      cache: false,
      type: "POST",
      dataType:"text",
      data: {num_operador,dateNow},

      success: function(data){
        var obj = $.parseJSON(data);
        console.log(obj);
        header = "<h3>Reporte de Producción / Máquina: "+obj[0].maquina+" No.Parte: "+obj[0].no_parte+" Materia Prima: "+obj[0].materia_prima+"</h3>";
        getMaquinaParte(obj[0].maquina);
        variable['no_parte'] = obj[0].no_parte;
        document.getElementById('maquina').value = obj[0].maquina;
        document.getElementById('folio_produccion').value = obj[0].id_reporte;
        document.getElementById('objetivo_hora').value = obj[0].objetivo_hora;
        document.getElementById('headerReporte').innerHTML = header;
      },
      error: function(e){
        console.log(e);
        $('#alert_danger').removeAttr('hidden');
        return false;
      }
   });  
}

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
        console.log(obj);
        document.getElementById('id_maquina').value =obj[0].id_maquina;
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
function getMaquinaParte(maquina){
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
  var fechaReporte = document.getElementById('fechaReporte').value;
  $('#myModalReporte').modal('show'); 
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
          select +="<option value"+obj[i].id_defecto+">"+obj[i].defecto+"</option>";
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
            select_check +=(obj[0].check1) ? ("<option value="+obj[0].id_defecto+">"+obj[0].check1+"</option>") : ("<option disabled>"+obj[0].check1+"</option>");
            select_check +=(obj[0].check2) ? ("<option value="+obj[0].id_defecto+">"+obj[0].check2+"</option>") : ("<option disabled>"+obj[0].check2+"</option>");
            select_check +=(obj[0].check3) ? ("<option value="+obj[0].id_defecto+">"+obj[0].check3+"</option>") : ("<option disabled>"+obj[0].check3+"</option>");
            select_check +=(obj[0].check4) ? ("<option value="+obj[0].id_defecto+">"+obj[0].check4+"</option>") : ("<option disabled>"+obj[0].check4+"</option>");
            select_check +=(obj[0].check5) ? ("<option value="+obj[0].id_defecto+">"+obj[0].check5+"</option>") : ("<option disabled>"+obj[0].check5+"</option>");
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
      //$('#myModalTiempo').modal('show');
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
              select_motivo +="<option value="+obj[i].id_tiempo+">"+obj[i].motivo+"</option>";
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

  $("#guardarNewReporte").click(function(){
      var  id_maquina = document.getElementById('id_maquina').value;
      if (!id_maquina) {
        alert("Seleccionar No. Parte");
        return false;
      }else{
        validate_reporte();
      }
  });

function validate_reporte(){
  var urlTurno = "<?= base_url();?>index.php/home/regTurno";
  var dateNow = "<?=$dateNow?>";

  var val_datos = {
    num_operador : num_operador,
    dateNow : dateNow
  }

  regTurno(urlTurno,val_datos);
}

function insert_reporte(folio){

  var id_maquina = document.getElementById('id_maquina').value;
  var num_operador = "<?= $num_empleado?>";
  var no_lote_materia = document.getElementById('new_lote').value;
  var no_orden = document.getElementById('new_orden').value;
  var num_inspeccion = document.getElementById('new_inspeccion').value;
  var turno = "<?=$turno ?>";
  var fecha_registro = "<?=$fechaNow ?>";
  var empresa = "<?=$empresa?>";
  var dateNow = "<?=$dateNow?>";



  if (folio == '0') {
    console.log("folio: "+folio+", se genera insert");
    var url = "<?= base_url();?>index.php/home/insertTurnoProd";
    var datos = {
       id_maquina : id_maquina ,
      num_operador : num_operador,
      turno : turno,
      fecha_registro : fecha_registro,
      empresa : empresa,
      dateNow : dateNow,
      no_lote_materia : no_lote_materia,
      no_orden : no_orden,
      num_inspeccion : num_inspeccion
    }
  insertData(url,datos);
  }else{
    console.log("folio: "+folio+", se genera update");
    var url = "<?= base_url();?>index.php/home/insertTurnoProdFolio";
    var datos = {
      folio : folio,
      id_maquina : id_maquina ,
      num_operador : num_operador,
      turno : turno,
      fecha_registro : fecha_registro,
      empresa : empresa,
      dateNow : dateNow,
      no_lote_materia : no_lote_materia,
      no_orden : no_orden,
      num_inspeccion : num_inspeccion
    }

    insertData(url,datos);  
    $('#cambioModal').modal('hide');  

  }



  showHeader(num_operador,dateNow);


}



function showDataTurnoHr(num_operador,dateNow){
          var table = '';
          var tiempo_muerto_total;
          $.ajax({
          url: '<?= base_url();?>index.php/home/showDataTurnoHr',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {num_operador,dateNow},

          success: function(data){
            var obj = $.parseJSON(data);
            console.log(obj);
              for (i= 0; i < obj.length; i++) {

                 table += "<tr class='even pointer'> <td class= ''>"+obj[i].hora_registro+"</td><td class= ''>"+obj[i].objetivo_hr+"</td> <td class= ''>"+obj[i].piezas_buenas+"</td> <td class= ''>"+obj[i].eficiencia+"</td> <td class= ''>"+obj[i].tiempo_muerto+"</td> <td class= ''>"+obj[i].tiempo_muerto_total+"</td> </tr>";
                 tiempo_muerto_total = obj[i].tiempo_muerto_total;
              }
              document.getElementById('tiempo_muerto_total').value= tiempo_muerto_total;
              document.getElementById('table_response').innerHTML= table;
              console.log(tiempo_muerto_total+"tiempo_muerto_total");
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


//Get hora
$(".hora").click(function() {
  var hora_btn = $(this).text()+":00";
  var dt_db = $(this).text();
  var date_db= dt_db.substring(0, 2);
  var hora = document.getElementById('txt').value ;
  var url = "<?= base_url();?>index.php/home/regHora";
  var num_operador = "<?= $num_empleado?>";
  var dateNow = "<?=$dateNow?>";
  var dateNow_db = "<?=$dateNow?>"+" "+date_db;
  var datos = {
    num_operador : num_operador,
    dateNow : dateNow_db
  }


  var fechaNow = dateNow+" "+hora;
  var fechaBtn = dateNow+" "+hora_btn;


  dthora_btn = new Date(fechaBtn); 
  dthora = new Date(fechaNow); 

  dthr_btn = dthora_btn.getHours();
  dthr = dthora.getHours();


  diff_hr = dthr_btn-dthr;
  diff_min=diff_minutes(dthora_btn, dthora); 
  console.log(diff_min);
  //status = 1 en tiempo, status = 2 retardo;

  var status = '';

  if (diff_min <= 15 && diff_hr== 0 ) {
    status = 1;
    document.getElementById('status').value=status;
    document.getElementById('fechaReporte').value=fechaNow;
    validateHora(url,datos);
    console.log(diff_min+" es menor continua al insert");
  }else if(diff_min <= 59 && diff_hr== 0 ){
    status = 2;
    document.getElementById('status').value=status;
    document.getElementById('fechaReporte').value=fechaNow;
    validateHora(url,datos);
    console.log(diff_min+" registro mayor a 20 min ");
  }else{
    alert("No corresponde a la hora");
    return false;
  }
});

function diff_minutes(dt2, dt1) 
 {
  var diff =(dt2.getTime() - dt1.getTime()) / 1000;
  diff /= 60;
  return Math.abs(Math.round(diff));
 }

//Validate Registro Hora

function validateHora(url,datos){
$.ajax({
      url: url,
      cache: false,
      type: "POST",
      dataType:"text",
      data: datos,

      success: function(data){
          var obj = $.parseJSON(data);
          console.log(obj);  

          if (obj[0].no_parte == variable['no_parte']) {

            var obj = $.parseJSON(data);
            console.log(obj[0].id_folio_produccion); 
            alert("Registro existente a esa hora");  
            //$('#btn_reporteHr').attr('disabled', true);  

            return false;             
          }else{
            console.log("insertando");
                      
          }


        /*if (data == '0') {
          console.log("insertando...");
        }else{
          var obj = $.parseJSON(data);
          console.log(obj[0].id_folio_produccion); 
          alert("Registro existente a esa hora");
     
        }  */    


      },
      error: function(e){
        console.log(e);
        $('#alert_danger').removeAttr('hidden');
        return false;
      }
   });
}


function insert_reporteHr(){

  var status = document.getElementById('status').value;
  var hora_registro = document.getElementById('fechaReporte').value;
  var piezasBuenas = document.getElementById('piezasBuenas').value;
  var piezasVerificadas = document.getElementById('piezasVerificadas').value;
  var objetivo_hora = document.getElementById('objetivo_hora').value;
  var folio_produccion = document.getElementById('folio_produccion').value;
  var dateNow = "<?= $dateNow?>";
  var url = "<?= base_url();?>index.php/home/insert_reporteHr";

  var eficiencia = Math.round((piezasBuenas*100)/objetivo_hora);
  var tiempo_muerto = 100 - eficiencia;

  var dthr = new Date(hora_registro);
  var h = dthr.getHours();
  var m = dthr.getMinutes();

  var hrNow = h +":"+ m; 
    console.log(hrNow);
  if (!piezasBuenas) {
    alert('Introducir Piezas Buenas');
    return false;
  }

console.log(hora_registro);


  var turno = "<?=$turno?>";

  /*if (turno == '1' && hora_registro > dateNow+" 14:20:00"&& hora_registro < dateNow+" 14:30:00") {

    console.log("turno 1");
    var objetivo_hora = document.getElementById('objetivo_hora').value/2;
    var eficiencia = Math.round((piezasBuenas*100)/objetivo_hora);
    var tiempo_muerto = 100 - eficiencia;
    var tiempo_muerto_total = Math.round((30 * tiempo_muerto)/100);

  }else if (turno ==  '2' && hora_registro > dateNow+" 15:00:00"&& hora_registro < dateNow+" 16:00:00") {

    console.log("turno 2");
    var objetivo_hora = document.getElementById('objetivo_hora').value/2;
    var eficiencia = Math.round((piezasBuenas*100)/objetivo_hora);
    var tiempo_muerto = 100 - eficiencia;
    var tiempo_muerto_total = Math.round((30 * tiempo_muerto)/100);

  }else if (turno == '2' && hora_registro > dateNow+" 22:20:00"&& hora_registro < dateNow+" 22:30:00") {

    console.log("turno 3");
    var objetivo_hora = document.getElementById('objetivo_hora').value/2;
    var eficiencia = Math.round((piezasBuenas*100)/objetivo_hora);
    var tiempo_muerto = 100 - eficiencia;
    var tiempo_muerto_total = Math.round((30 * tiempo_muerto)/100);

  }else if(turno == '3' && hora_registro > dateNow+" 22:50:00"&& hora_registro < dateNow+" 23:00:00"){
    var objetivo_hora = document.getElementById('objetivo_hora').value/2;
    var eficiencia = Math.round((piezasBuenas*100)/objetivo_hora);
    var tiempo_muerto = 100 - eficiencia;
    var tiempo_muerto_total = Math.round((30 * tiempo_muerto)/100);
  }else{
    console.log("registro de una hora");
    var tiempo_muerto_total = Math.round((60 * tiempo_muerto)/100);
  }*/


    console.log("registro de una hora");
    var tiempo_muerto_total = Math.round((60 * tiempo_muerto)/100);
  



  var datos = {
    hora_registro : hora_registro,
    piezasBuenas : piezasBuenas,
    piezasVerificadas : piezasVerificadas,
    status : status,
    objetivo_hora : objetivo_hora,
    eficiencia : eficiencia,
    tiempo_muerto : tiempo_muerto,
    tiempo_muerto_total : tiempo_muerto_total,
    folio_produccion : folio_produccion,
    num_operador : num_operador
  }

  insertData(url,datos); 

  showDataTurnoHr(num_operador,dateNow);
  getId();
  //showDataScrap(num_operador,dateNow,id_reporte)


  console.log(datos);

}

function getIdHr(){
  var hora = document.getElementById('txt').value ;
  var h= hora.substring(0, 2);

  var dateNow = "<?= $dateNow?> "+h;


  var datos = {
    num_operador : num_operador,
    dateNow : dateNow
  }
var select = '';
$.ajax({
    url: '<?= base_url();?>index.php/home/getIdHr',
        cache: false,
        type: "POST",
        dataType:"text",
        data: datos,

        success: function(data){
          var obj = $.parseJSON(data);
            console.log(obj);
          if (data == '0') {
            alert("Ingresar Piezas Buenas.");
            return false;
          }else{
            var obj = $.parseJSON(data);
            select = obj[0].id_reporte_hr;
            insert_scrap(obj[0].id_reporte_hr);        
          }
          //$('#alert').removeAttr('hidden');
          //setTimeout(window.location.replace("<?=base_url()?>index.php/home/ajustes"), 3000);
          document.getElementById('id_reporte').innerHTML=select;
        },
        error: function(e){
          console.log(e);
          $('#alert_danger').removeAttr('hidden');
          return false;
        }
     });    


}

function getId(){
  var hora = document.getElementById('txt').value ;
  var h= hora.substring(0, 2);


  var dateNow = "<?= $dateNow?> "+h;

  var datos = {
    num_operador : num_operador,
    dateNow : dateNow
  }
var select = '';
$.ajax({
    url: '<?= base_url();?>index.php/home/getIdHr',
        cache: false,
        type: "POST",
        dataType:"text",
        data: datos,

        success: function(data){
          var obj = $.parseJSON(data);
            console.log(obj);
          if (data == '0') {
            alert("Ingresar Piezas Buenas.");
            return false;
          }else{
            var obj = $.parseJSON(data);
            select = obj[0].id_reporte_hr;
            showDataScrap(num_operador,dateNow,obj[0].id_reporte_hr)
            showTableTiempo(num_operador,dateNow,obj[0].id_reporte_hr);
            document.getElementById('id_reporte').value=select;
            document.getElementById('piezasBuenas').value=obj[0].piezas_buenas;
            document.getElementById('fechaReporte').value=obj[0].hora_registro;
            document.getElementById('piezasVerificadas').value=obj[0].piezas_verificadas;


          }
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

function insert_scrap(id_reporte_hr){
  var id_defecto = document.getElementById('select_check').value;
  var check = $("#select_check option:selected").text();
  var departamento='';
  var motivo='';
  switch(check) {
    case "Maquina":
        departamento = "Mantenimiento";
        motivo = "Scrap "+departamento;
        break;
    case "Molde":
        departamento = "Procesos";
        motivo = "Scrap "+departamento;
        break;
    case "Proceso":
        departamento = "Procesos";
        motivo = "Scrap "+departamento;
        break;
    case "Material":
        departamento = "Materiales";
        motivo = "Scrap "+departamento;
        break;
    case "Operacion":
        departamento = "Produccion";
        motivo = "Scrap "+departamento;
        break;
    default:
    departamento = 'NA'
}

  var scrap_individual = document.getElementById('cantidad').value;
  var folio_produccion = document.getElementById('folio_produccion').value;
  var dateNow = "<?= $dateNow?>";

  var hora = document.getElementById('txt').value ;
  var fechaNow = dateNow+" "+hora;

  console.log(fechaNow);


  //calculo de %scrap
  var piezasBuenas = document.getElementById('piezasBuenas').value;
  var total_pzas = Number(piezasBuenas) + Number(scrap_individual);
  var sc = scrap_individual/total_pzas;
  //console.log(scrap_individual+"/"+total_pzas);
  var scrap = Math.round(sc * 100);

  //calculo tiempo piezas scrap
  var turno = "<?=$turno?>";
  var hora_registro = document.getElementById('fechaReporte').value;


  if (turno == '1' && hora_registro > dateNow+" 14:00:00" && hora_registro < dateNow+" 14:29:00") {
    console.log("1 tiempo scrap "+hora_registro+" "+dateNow);
    var tiempo_scrap = Math.round((30 * scrap)/100);
  }else if (turno ==  '2' && hora_registro > dateNow+" 14:30:00" && hora_registro < dateNow+" 15:00:00" && hora_registro > dateNow+" 23:00:00" && hora_registro < dateNow+" 23:30:00") {
    console.log("2");

    var tiempo_scrap = Math.round((30 * scrap)/100);
  }else if (turno == '3' && hora_registro > dateNow+" 23:30:00" && hora_registro < dateNow+" 00:00:00") {
    console.log("3");

    var tiempo_scrap = Math.round((30 * scrap)/100);
  }else{
    console.log("4");

    var tiempo_scrap = Math.round((60 * scrap)/100);
  }  


  var datos = {
    id_defecto : id_defecto,
    scrap_individual : scrap_individual,
    scrap : scrap,
    piezasBuenas : piezasBuenas,
    tiempo_scrap : tiempo_scrap,
    folio_produccion : folio_produccion,
    num_operador : num_operador,
    id_reporte_hr : id_reporte_hr,
    hora_registro : fechaNow,
    check : check,
    departamento : departamento

  }
   var url = "<?= base_url();?>index.php/home/insert_scrap";

  insertData(url,datos);

  var datos_tiempo = {
    folio_produccion : folio_produccion,
    id_reporte_hr : id_reporte_hr,
    tiempo_individual : tiempo_scrap,
    departamento : departamento,
    num_operador : num_operador,
    hora_registro : fechaNow,
    motivo : motivo
  }

  var url_tiempo =  "<?= base_url();?>index.php/home/insert_tiempo";
  insertData(url_tiempo,datos_tiempo);

  $('#myModal').modal('hide');
  //setTimeout(window.location.replace("<?=base_url()?>index.php/home/reporte_produccion_hr"), 5000);
  getId()
  showDataTiempo(num_operador,dateNow,id_reporte_hr);
  showDataScrap(num_operador,dateNow,id_reporte_hr);


  console.log(datos);
}




function showDataScrap(num_operador,dateNow,id_reporte){
          var table = '';
          var validate_tiempo_muerto=0;
          $.ajax({
          url: '<?= base_url();?>index.php/home/showDataScrap',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {num_operador,dateNow,id_reporte},

          success: function(data){
           var tiempo_muerto_t = document.getElementById('tiempo_muerto_total').value;

            var obj = $.parseJSON(data);
            console.log(obj);
              for (i= 0; i < obj.length; i++) {
                 table += "<tr class='even pointer'> <td class= ''>"+obj[i].defecto+"</td><td class= ''>"+obj[i].scrap_individual+"</td> <td class= ''>"+obj[i].scrap+"</td> <td class= ''>"+obj[i].tiempo_piezas_scrap+"</td> </tr>";
                 //validate_tiempo_muerto = Number(obj[i].tiempo_piezas_scrap) + Number(obj[i+1].tiempo_piezas_scrap);
                 validate_tiempo_muerto += parseInt(obj[i].tiempo_piezas_scrap);


                    document.getElementById('table_scrap').innerHTML= table;

              }
                 //console.log(tiempo_muerto_t+"<="+validate_tiempo_muerto);

                 if (tiempo_muerto_t <= validate_tiempo_muerto && tiempo_muerto_t > 0 ) {
                  //$('#fechaReporte').val('');
                  alert("Scrap coincide ");
                  console.log("scrap coincide");
                  $('#myModal').modal('hide'); 
                  //$('#piezasBuenas').val('');
                 }else{
                  console.log("open scrap modal");
                  scrapModal();
                 }
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });

}

function showTableScrap(num_operador,dateNow,id_reporte){
          var table = '';
          var validate_tiempo_muerto=0;
          $.ajax({
          url: '<?= base_url();?>index.php/home/showDataScrap',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {num_operador,dateNow,id_reporte},

          success: function(data){
           var tiempo_muerto_t = document.getElementById('tiempo_muerto_total').value;

            var obj = $.parseJSON(data);
            console.log(obj);
              for (i= 0; i < obj.length; i++) {
                 table += "<tr class='even pointer'> <td class= ''>"+obj[i].defecto+"</td><td class= ''>"+obj[i].scrap_individual+"</td> <td class= ''>"+obj[i].scrap+"</td> <td class= ''>"+obj[i].tiempo_piezas_scrap+"</td> </tr>";
                 //validate_tiempo_muerto = Number(obj[i].tiempo_piezas_scrap) + Number(obj[i+1].tiempo_piezas_scrap);
                 validate_tiempo_muerto += parseInt(obj[i].tiempo_piezas_scrap);


                    document.getElementById('table_scrap').innerHTML= table;

              }

          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });

}

function showTableTiempo(num_operador,dateNow,id_reporte){
          console.log("Entrando a funcion showTableTiempo");
          var table = '';
          var validate_tiempo_muerto=0;
          $.ajax({
          url: '<?= base_url();?>index.php/home/showDataTiempo',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {num_operador,dateNow,id_reporte},

          success: function(data){
           var tiempo_muerto_t = document.getElementById('tiempo_muerto_total').value;

            var obj = $.parseJSON(data);
            console.log(obj);
              for (i= 0; i < obj.length; i++) {
                 table += "<tr class='even pointer'> <td class= ''>"+obj[i].departamento+"</td><td class= ''>"+obj[i].motivo+"</td> <td class= ''>"+obj[i].tiempo_muerto_individual+"</td> </tr>";
                 //validate_tiempo_muerto = Number(obj[i].tiempo_piezas_scrap) + Number(obj[i+1].tiempo_piezas_scrap);
                 validate_tiempo_muerto += parseInt(obj[i].tiempo_muerto_individual);


                    document.getElementById('table_tiempos').innerHTML= table;

              }

          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });  
}


function showDataTiempo(num_operador,dateNow,id_reporte){
          console.log(num_operador+" "+dateNow+" "+id_reporte)
          var table = '';
          var validate_tiempo_muerto=0;
          $.ajax({
          url: '<?= base_url();?>index.php/home/showDataTiempo',
          cache: false,
          type: "POST",
          dataType:"text",
          data: {num_operador,dateNow,id_reporte},

          success: function(data){
           var tiempo_muerto_t = document.getElementById('tiempo_muerto_total').value;

            var obj = $.parseJSON(data);
            console.log(obj);
              for (i= 0; i < obj.length; i++) {
                 //table += "<tr class='even pointer'> <td class= ''>"+obj[i].departamento+"</td><td class= ''>"+obj[i].motivo+"</td> <td class= ''>"+obj[i].tiempo_muerto_individual+"</td> </tr>";
                 //validate_tiempo_muerto = Number(obj[i].tiempo_piezas_scrap) + Number(obj[i+1].tiempo_piezas_scrap);
                 validate_tiempo_muerto += parseInt(obj[i].tiempo_muerto_individual);


                    //document.getElementById('table_tiempos').innerHTML= table;

              }
                alert("Tiempo Justificado(min) :"+validate_tiempo_muerto+" de "+tiempo_muerto_t);
                console.log(tiempo_muerto_t+"<="+validate_tiempo_muerto);

                 if (tiempo_muerto_t <= validate_tiempo_muerto && tiempo_muerto_t > 0 ) {
                  $('#myModal').modal('hide'); 

                  console.log("tiempo coincide");
                  //$('#fechaReporte').val('');
                  //alert("Tiempo coincide ");
                  //$('#myModalTiempo').modal('hide'); 
                  //$('#piezasBuenas').val('');
                 }else{
                  console.log("open modal");
                  //tiempoModal();
                 }
          },
          error: function(e){
            console.log(e);
            $('#alert_danger').removeAttr('hidden');
            return false;
          }
       });

}

function insert_tiempo(){

  var id_reporte_hr = document.getElementById('id_reporte').value;
  var folio_produccion = document.getElementById('folio_produccion').value;

  var tiempo_individual = document.getElementById('tiempo').value;
  var folio_produccion = document.getElementById('folio_produccion').value;
  var dateNow = "<?= $dateNow?>";

  var hora = document.getElementById('txt').value ;
  var fechaNow = dateNow+" "+hora;



  //calculo de %tiempo
  var piezasBuenas = document.getElementById('piezasBuenas').value;

  var total_pzas = Number(piezasBuenas) + Number(tiempo_individual);
  var sc = tiempo_individual/total_pzas;
  //console.log(scrap_individual+"/"+total_pzas);
  var scrap = Math.round(sc * 100);

  //calculo tiempo piezas scrap
  var turno = "<?=$turno?>";
  var hora_registro = document.getElementById('fechaReporte').value;
  console.log(hora_registro+" hora_registro");

  if (turno == '1' && hora_registro <= dateNow+" 14:30:00") {
    console.log("1");
    var tiempo_muerto_individual = Math.round((30 * scrap)/100);
  }else if (turno ==  '2' && hora_registro <= dateNow+" 15:20:00") {
    console.log("2");

    var tiempo_muerto_individual = Math.round((30 * scrap)/100);
  }else if (turno == '3' && hora_registro <= dateNow+" 14:30:00") {
    console.log("3");

    var tiempo_muerto_individual = Math.round((30 * scrap)/100);
  }else{
    console.log("4");

    var tiempo_muerto_individual = Math.round((60 * scrap)/100);
  }  

  console.log(tiempo_muerto_individual);

  var id_tiempo = document.getElementById('select_motivo').value;

  var departamento = document.getElementById('select_departamento').value;
  var motivo = $("#select_motivo option:selected").text();



    var datos_tiempo = {
    folio_produccion : folio_produccion,
    id_reporte_hr : id_reporte_hr,
    tiempo_muerto_individual : tiempo_individual,
    id_tiempo : id_tiempo,
    num_operador : num_operador,
    hora_registro : fechaNow,
    departamento : departamento,
    motivo : motivo
  }

 var url_tiempo =  "<?= base_url();?>index.php/home/insert_tiempo_muerto";
  insertData(url_tiempo,datos_tiempo);
  console.log(datos_tiempo);
  window.location.replace("<?=base_url()?>index.php/home/reporte_produccion_hr");
  $('#myModalTiempo').modal('hide');
  //showDataTiempo(num_operador,dateNow,id_reporte_hr);


}



  

</script>