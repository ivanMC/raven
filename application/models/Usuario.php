<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Usuario extends CI_MODEL
{
	
	function __construct()
	{
		$this->tableName = 'empleados';
		$this->primaryKey = 'id_empleado';
	}

	public function login($username,$password)
	{
		$this -> db -> select('id_empleado,num_empleado,nombre,password,departamento,empresa');
		$this -> db -> from($this->tableName);
		$this -> db -> where('num_empleado',$username);
		$this -> db -> where('password',$password);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}else{
			return false;
		}
		
	}
	//Mostrar empleados de bd en ajustes 
	function get_empleados()
	{
		$query = $this -> db -> get('empleados');
		if ($query->num_rows() > 0) {
			return $query;
		}
	}

	//Mostrar maquinas
	function get_maquinas()
	{
		$query = $this -> db -> get('matriz_maquina');
		echo $query;
		if ($query->num_rows() > 0) {
			return $query;
		}
	}
	//Insertar Nuevos Empleados
	function guardarEmpleado($data)
	{
		$num_empleado = $data['num_empleado'];
		$contrasena = $data['contrasena'];
		$departamento = $data['departamento'];
		$empresa = $data['empresa'];
		$nombre = $data['nombre'];
		$razon_social = $data['razon'];

		$query = $this->db->query("INSERT INTO empleados (num_empleado, nombre,password, departamento, empresa,razon_social)VALUES ('$num_empleado', '$nombre','$contrasena', '$departamento', '$empresa','$razon_social');");
	}

	function showEmpleado($data)
	{
		$id_empleado = $data['id_empleado'];

		$query = $this->db->query("SELECT * FROM empleados WHERE id_empleado='$id_empleado' ;");
		if ($query->num_rows() > 0) {
			return $query;
		}
	}

	function updateEmpleado($data){
		$id_empleado = $data['id_empleado'];
		$contrasena = $data['contrasena'];
		$departamento = $data['departamento'];
		$empresa = $data['empresa'];
		$activo = $data['activo'];

		$query = $this->db->query("UPDATE empleados SET password = '$contrasena', departamento = '$departamento', empresa = '$empresa', activo = '$activo' WHERE id_empleado = '$id_empleado';");
	}

	//Obtener maquinas por empresa

	function get_maquina($data)
	{



		$query = $this->db->query("SELECT maquina FROM matriz_maquina WHERE empresa ='$data' and activo = '1' GROUP BY maquina order by maquina desc;");
		if ($query->num_rows() > 0) {
			return $query;
		}		

	}

	function getMaquinaInfo($data){
		$maquina = $data['maquina'];
		$query = $this->db->query("SELECT id_maquina,no_parte,no_molde,cavidades,materia_prima,round(objetivo_hora) as objetivo_hora FROM matriz_maquina WHERE concat(maquina,'-',no_parte)  ='$maquina' ;");
		if ($query->num_rows() > 0) {
			return $query;
		}		
	}

	function getMaquinaParte($data){
		$maquina = $data['maquina'];
		$empresa = $data['empresa'];

		$query = $this->db->query("SELECT no_parte  FROM matriz_maquina WHERE maquina ='$maquina' and empresa = '$empresa';");
		if ($query->num_rows() > 0) {
			return $query;
		}
	}

	function getDefectos($data){

		$empresa = $data['empresa'];



		$query = $this->db->query("SELECT id_defecto,defecto FROM defecto_scrap WHERE empresa ='$empresa'  ;");
		if ($query->num_rows() > 0) {
			return $query;
		}	
	}

	function getDefectosCheck($data){

		$empresa = $data['empresa'];


		$defecto = $data['val_defecto'];
		$query = $this->db->query("SELECT id_defecto,check1,check2,check3,check4,check5 FROM defecto_scrap WHERE empresa ='$empresa' and defecto = '$defecto' ;");
		if ($query->num_rows() > 0) {
			return $query;
		}	
	}

	function getDepartamento($data){
		$query = $this->db->query("SELECT departamento FROM tiempo_muerto group by departamento;");
		if ($query->num_rows() > 0) {
			return $query;
		}

	}

	function getMotivos($data){
		$departamento = $data['val_defecto'];
		$query = $this->db->query("SELECT id_tiempo,motivo FROM tiempo_muerto WHERE departamento = '$departamento' ;");
		if ($query->num_rows() > 0) {
			return $query;
		}		
	}





	function getMaquinaEmpresa($empresa){

		$query = $this->db->query("SELECT maquina FROM matriz_maquina WHERE empresa ='$empresa' GROUP BY maquina ;");
		if ($query->num_rows() > 0) {
			return $query;
		}

	}

	function getMaquinaDetalle($data){
		$maquina = $data['maquina'];
		$empresa = $data['empresa'];
		$query = $this->db->query("SELECT id_maquina,no_parte,cliente,maquina,no_molde,materia_prima,ciclo,cavidades,shot_hr,objetivo_hora,operadores_req,proceso,empresa,activo FROM matriz_maquina WHERE maquina ='$maquina' and empresa = '$empresa' ;");
		if ($query->num_rows() > 0) {
			return $query;
		}		
	}

	function showMaquinaDetalle($data){
		$id_maquina = $data['id_maquina'];
		$query = $this->db->query("SELECT id_maquina,no_parte,cliente,maquina,no_molde,materia_prima,ciclo,cavidades,shot_hr,objetivo_hora,operadores_req,proceso,empresa,activo FROM matriz_maquina WHERE id_maquina ='$id_maquina';");
		if ($query->num_rows() > 0) {
			return $query;
		}		
	}

	function insertarMaquina($data){

		$no_parte = $data['no_parte'];
		$cliente = $data['cliente'];
		$maquina = $data['maquina'];
		$materia_prima = $data['materia_prima'];
		$ciclo = $data['ciclo'];
		$cavidades = $data['cavidades'];
		$shot_hr = $data['shot_hr'];
		$objetivo_hora = $data['objetivo_hora'];
		$operadores_req = $data['operadores_req'];
		$proceso = $data['proceso'];
		$empresa = $data['empresa'];

		$query = $this->db->query("INSERT INTO matriz_maquina (
																no_parte,
																cliente,
																maquina,
																no_molde,
																materia_prima,
																ciclo,
																cavidades,
																shot_hr,
																objetivo_hora,
																operadores_req,
																proceso,
																empresa
																) VALUES (
																'$no_parte',
																'$cliente',
																'$maquina',
																'$no_molde',
																'$materia_prima',
																'$ciclo',
																'$cavidades',
																'$shot_hr',
																'$objetivo_hora',
																'$operadores_req',
																'$proceso',
																'$empresa');
																");
	}

	function actualizarMaquina($data){
		$id_maquina = $data['id_maquina'];
		$no_parte = $data['no_parte'];
		$cliente = $data['cliente'];
		$maquina = $data['maquina'];
		$materia_prima = $data['materia_prima'];
		$ciclo = $data['ciclo'];
		$cavidades = $data['cavidades'];
		$shot_hr = $data['shot_hr'];
		$objetivo_hora = $data['objetivo_hora'];
		$operadores_req = $data['operadores_req'];
		$proceso = $data['proceso'];
		$empresa = $data['empresa'];
		$activo = $data['activo'];


		$query = $this->db->query("UPDATE matriz_maquina SET 
															 no_parte = '$no_parte',
															 cliente = '$cliente',
															 maquina = '$maquina',
															 materia_prima = '$materia_prima',
															 ciclo = '$ciclo',
															 cavidades = '$cavidades',
															 shot_hr = '$shot_hr',
															 objetivo_hora = '$objetivo_hora',
															 operadores_req = '$operadores_req',
															 proceso = '$proceso',
															 empresa = '$empresa',
															 activo = '$activo'
														 WHERE id_maquina = '$id_maquina';");


	}

	function showDataTurno($data){

		$num_operador = $data['num_operador'];
		$dateNow = $data['dateNow'];

		$query = $this->db->query(" SELECT maquina,no_molde,lote_materia_prima,num_operador,fecha_registro from reporte_produccion left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina where num_operador = '$num_operador' and date_format(fecha_registro,'%Y-%m-%d') = '$dateNow' order by id_reporte asc");
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}	

	}

	function regTurno($data){
		$num_operador = $data['num_operador'];
		$dateNow = $data['dateNow'];

		$query = $this->db->query("SELECT id_reporte FROM reporte_produccion WHERE num_operador = '$num_operador' and date_format(fecha_registro,'%Y-%m-%d') = '$dateNow' ;");
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}
	}

	function regHora($data){
		$num_operador = $data['num_operador'];
		$dateNow = $data['dateNow'];
		$query = $this->db->query("SELECT hora_registro, id_folio_produccion, no_parte FROM bit_prod_hr
									left join reporte_produccion on bit_prod_hr.id_folio_produccion = reporte_produccion.id_reporte
									left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina
									WHERE bit_prod_hr.num_operador = '$num_operador' and date_format(hora_registro,'%Y-%m-%d %H') = '$dateNow'  ;");
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}
	}


	function insertTurnoProd($data){
		print_r($data);
		$id_maquina = $data['id_maquina'];
		$num_operador = $data['num_operador'];
		$turno = $data['turno'];
		$empresa = $data['empresa'];
		$fecha_registro = $data['fecha_registro'];
		$dateNow = $data['dateNow'];
		$no_lote_materia = $data['no_lote_materia'];
		$no_orden = $data['no_orden'];
		$num_inspeccion = $data['num_inspeccion'];
		$num_lider = $data['num_lider'];

		$query = $this->db->query("INSERT INTO reporte_produccion (id_maquina,num_operador,lote_materia_prima,no_orden,num_inspeccion,num_lider,turno,empresa,fecha_registro) VALUES ('$id_maquina','$num_operador','$no_lote_materia','$no_orden','$num_inspeccion','$num_lider','$turno','$empresa','$fecha_registro');");

		$query_select = $this->db->query("SELECT id_reporte FROM reporte_produccion WHERE num_operador = '$num_operador' and date_format(fecha_registro,'%Y-%m-%d') = '$dateNow' ;");

		foreach ($query_select->result() as  $value) {
			$id_reporte = $value->id_reporte;
			
		}


		$query_upd =$this->db->query("UPDATE reporte_produccion SET folio_produccion = '$id_reporte' WHERE id_reporte = '$id_reporte';");

	}

	function insertTurnoProdFolio($data){
		$folio = $data['folio'];
		$id_maquina = $data['id_maquina'];
		$num_operador = $data['num_operador'];
		$turno = $data['turno'];
		$empresa = $data['empresa'];
		$fecha_registro = $data['fecha_registro'];
		$dateNow = $data['dateNow'];
		$no_lote_materia = $data['no_lote_materia'];
		$no_orden = $data['no_orden'];
		$num_inspeccion = $data['num_inspeccion'];
		$num_lider = $data['num_lider'];

		$query_upd =$this->db->query("UPDATE reporte_produccion SET activo = '0' WHERE folio_produccion = '$folio';");

		$query = $this->db->query("INSERT INTO reporte_produccion (folio_produccion,id_maquina,num_operador,lote_materia_prima,no_orden,num_inspeccion,num_lider,turno,empresa,fecha_registro) VALUES ('$folio','$id_maquina','$num_operador','$no_lote_materia','$no_orden','$num_inspeccion','$num_lider','$turno','$empresa','$fecha_registro');");		
	}

	function get_lastMaquina($data){
		$num_empleado = $data['num_operador'];
		$dateNow = $data['dateNow'];

		$query = $this->db->query("SELECT * from reporte_produccion left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina  WHERE num_operador = '$num_empleado' and date_format(fecha_registro,'%Y-%m-%d') = '$dateNow' and reporte_produccion.activo = '1' ;");
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}	
	}

	function insert_reporteHr($data){

		$hora_registro = $data['hora_registro'];
		$folio_produccion = $data['folio_produccion'];
		$piezas_buenas = $data['piezasBuenas'];
		$piezasVerificadas = $data['piezasVerificadas'];
		$eficiencia = $data['eficiencia'];
		$tiempo_muerto = $data['tiempo_muerto'];
		$tiempo_muerto_total = $data['tiempo_muerto_total'];
		$status = $data['status'];
		$objetivo_hora = $data['objetivo_hora'];
		$num_operador = $data['num_operador'];



		$query = $this->db->query("INSERT INTO bit_prod_hr (hora_registro,id_folio_produccion,objetivo_hr,piezas_buenas,eficiencia,tiempo_muerto,tiempo_muerto_total,num_operador,piezas_verificadas,activo) VALUES ('$hora_registro','$folio_produccion','$objetivo_hora','$piezas_buenas','$eficiencia','$tiempo_muerto','$tiempo_muerto_total','$num_operador','$piezasVerificadas','$status');");		

	}

	 function showDataTurnoHr($data){
		$num_operador = $data['num_operador'];
		$dateNow = $data['dateNow'];

		$query = $this->db->query(" SELECT hora_registro,objetivo_hr,piezas_buenas,eficiencia,tiempo_muerto,tiempo_muerto_total FROM bit_prod_hr where  num_operador = '$num_operador' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and activo <> 5 order by hora_registro desc; ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}	 	
	 }

	 function showDataScrap($data){
		$num_operador = $data['num_operador'];
		$dateNow = $data['dateNow'];
		$id_reporte = $data['id_reporte'];


		$query = $this->db->query(" SELECT defecto,scrap_individual,scrap,tiempo_piezas_scrap,num_operador FROM bit_scrap left join defecto_scrap on bit_scrap.id_defecto = defecto_scrap.id_defecto where  num_operador = '$num_operador' and date_format(fecha_reg,'%Y-%m-%d %H') = '$dateNow' and id_reporte_hr = '$id_reporte';  ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}	 	
	 }

	  function insert_scrap($data){
		$id_folio_produccion = $data['folio_produccion'];
		$id_defecto = $data['id_defecto'];
		$scrap_individual = $data['scrap_individual'];
		$scrap = $data['scrap'];
		$tiempo_scrap = $data['tiempo_scrap'];
		$num_operador = $data['num_operador'];
		$id_reporte_hr = $data['id_reporte_hr'];
		$fecha_reg = $data['hora_registro'];
		$check = $data['check'];
		$departamento = $data['departamento'];


		$query = $this->db->query("INSERT INTO bit_scrap (`id_folio_produccion`,`id_reporte_hr`,`id_defecto`,`check`,`departamento`,`scrap_individual`,`scrap`,`tiempo_piezas_scrap`,`num_operador`,`fecha_reg`) VALUES ('$id_folio_produccion','$id_reporte_hr','$id_defecto','$check','$departamento','$scrap_individual','$scrap','$tiempo_scrap','$num_operador','$fecha_reg');");	  	
	  }

	  function getIdHr($data){
			$num_operador = $data['num_operador'];
			$dateNow = $data['dateNow'];

			$query = $this->db->query(" SELECT id_reporte_hr,piezas_buenas,hora_registro,piezas_verificadas FROM bit_prod_hr  where  num_operador = '$num_operador' and date_format(hora_registro,'%Y-%m-%d %H') = '$dateNow' order by id_reporte_hr desc limit 1; ");
			if ($query->num_rows() > 0) {
				return $query;
			}else{
				return "0";
			}
	  }

	  function insert_tiempo($data){
		$id_folio_produccion = $data['folio_produccion'];
		$id_reporte_hr = $data['id_reporte_hr'];
		$tiempo_muerto_individual = $data['tiempo_individual'];
		$departamento = $data['departamento'];
		$num_operador = $data['num_operador'];
		$fecha_reg = $data['hora_registro'];
		$motivo = $data['motivo'];


		$query = $this->db->query("INSERT INTO bit_tiempo_muerto (`id_folio_produccion`,`id_reporte_hr`,`tiempo_muerto_individual`,`departamento`,`motivo`,`num_operador`,`fecha_reg`) VALUES ('$id_folio_produccion','$id_reporte_hr','$tiempo_muerto_individual','$departamento','$motivo','$num_operador','$fecha_reg');");	  	
	  }


	 function showDataTiempo($data){
	 	$num_operador = $data['num_operador'];
		$dateNow = $data['dateNow'];
		$id_reporte = $data['id_reporte'];
		$query = $this->db->query(" SELECT departamento,motivo,tiempo_muerto_individual FROM bit_tiempo_muerto where  num_operador = '$num_operador' and date_format(fecha_reg,'%Y-%m-%d %H') = '$dateNow' and id_reporte_hr = '$id_reporte';  ");
		//echo " SELECT departamento,motivo,tiempo_muerto_individual FROM bit_tiempo_muerto where  num_operador = '$num_operador' and date_format(fecha_reg,'%Y-%m-%d %H') = '$dateNow' and id_reporte_hr = '$id_reporte';  ";
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}	 	
	 }

	 function insert_tiempo_muerto($data){
		$id_folio_produccion = $data['folio_produccion'];
		$id_reporte_hr = $data['id_reporte_hr'];
		$tiempo_muerto_individual = $data['tiempo_muerto_individual'];
		$num_operador = $data['num_operador'];
		$fecha_reg = $data['hora_registro'];
		$id_tiempo = $data['id_tiempo'];
		$departamento = $data['departamento'];
		$motivo = $data['motivo'];


		$query = $this->db->query("INSERT INTO bit_tiempo_muerto (`id_folio_produccion`,`id_reporte_hr`,`tiempo_muerto_individual`,`id_tiempo`,`departamento`,`motivo`,`num_operador`,`fecha_reg`) VALUES ('$id_folio_produccion','$id_reporte_hr','$tiempo_muerto_individual','$id_tiempo','$departamento','$motivo','$num_operador','$fecha_reg');");	 	

	 }

	 function getDashEficiencia($data){
	 	$num_operador = $data['num_operador'];
	 	$dateNow = $data['dateNow'];

		$query = $this->db->query(" SELECT concat(date_format(hora_registro,'%H'),':00') as hora,objetivo_hr,piezas_buenas,eficiencia,piezas_verificadas  from bit_prod_hr where num_operador = '$num_operador' and date_format(hora_registro,'%Y-%m-%d')='$dateNow' order by id_reporte_hr asc  ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}
	}


	 function getDashEficienciaGraph($num_operador,$dateNow){
	 	//$num_operador = $data['num_operador'];
	 	//$dateNow = $data['dateNow'];
		$query = $this->db->query(" SELECT eficiencia,date_format(hora_registro,'%H:00') as hora  from bit_prod_hr where num_operador = '$num_operador' and date_format(hora_registro,'%Y-%m-%d')='$dateNow' order by id_reporte_hr asc  ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}
	}

	 function getDashTiempo($data){
	 	$num_operador = $data['num_operador'];
	 	$dateNow = $data['dateNow'];

		$query = $this->db->query(" SELECT concat(date_format(hora_registro,'%H'),':00') as hora,IF(tiempo_muerto<0, 0, tiempo_muerto) as tiempo_muerto ,IF(tiempo_muerto_total<0, 0, tiempo_muerto_total) as tiempo_muerto_total   from bit_prod_hr where num_operador = '$num_operador' and date_format(hora_registro,'%Y-%m-%d')='$dateNow' order by id_reporte_hr asc  ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}
	 	
	 }

 	 function getDashTiempoGraph($num_operador,$dateNow){
	 	//$num_operador = $data['num_operador'];
	 	//$dateNow = $data['dateNow'];
		$query = $this->db->query(" SELECT concat(date_format(hora_registro,'%H'),':00') as hora,tiempo_muerto ,tiempo_muerto_total  from bit_prod_hr where num_operador = '$num_operador' and date_format(hora_registro,'%Y-%m-%d')='$dateNow' order by id_reporte_hr asc   ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}
	}

	 function getDashScrap($data){
	 	$num_operador = $data['num_operador'];
	 	$dateNow = $data['dateNow'];

		$query = $this->db->query(" SELECT concat(date_format(hora_registro,'%H'),':00') as hora,piezas_buenas,IF(scrap_individual<0, 0, scrap_individual) as scrap_individual,IF(scrap<0, 0, scrap) as scrap  from bit_prod_hr left join bit_scrap on bit_prod_hr.id_reporte_hr = bit_scrap.id_reporte_hr   where bit_prod_hr.num_operador = '$num_operador' and date_format(hora_registro,'%Y-%m-%d')='$dateNow' group by bit_scrap.id_reporte_hr order by bit_prod_hr.id_reporte_hr asc ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}
	 	
	 }	 

	 function getDashScrapGraph($num_operador,$dateNow){

		$query = $this->db->query(" SELECT concat(date_format(hora_registro,'%H'),':00') as hora,piezas_buenas,scrap_individual,scrap  from bit_prod_hr left join bit_scrap on bit_prod_hr.id_reporte_hr = bit_scrap.id_reporte_hr   where bit_prod_hr.num_operador = '$num_operador' and date_format(hora_registro,'%Y-%m-%d')='$dateNow' group by bit_scrap.id_reporte_hr order by bit_prod_hr.id_reporte_hr asc ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}
	 	
	 }

	 function dashboard_eficienciaMaquinaMes(){

		$query = $this->db->query(" SELECT date_format(fecha_registro,'%m') as dia,maquina,sum(objetivo_hr) as objetivo_hr,sum(piezas_buenas) as piezas_buenas,round((sum(piezas_buenas)/sum(objetivo_hr))*100) as eficiencia,reporte_produccion.empresa from reporte_produccion left join bit_prod_hr on reporte_produccion.id_reporte = bit_prod_hr.id_folio_produccion left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina where reporte_produccion.empresa = 'RR' and bit_prod_hr.activo <> 5  group by month(fecha_registro); ");

		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}

	 }

	 function dashboard_eficienciaMaquinaMesAZ(){

		$query = $this->db->query(" SELECT date_format(fecha_registro,'%m') as dia,maquina,sum(objetivo_hr) as objetivo_hr,sum(piezas_buenas) as piezas_buenas,round((sum(piezas_buenas)/sum(objetivo_hr))*100) as eficiencia,reporte_produccion.empresa from reporte_produccion left join bit_prod_hr on reporte_produccion.id_reporte = bit_prod_hr.id_folio_produccion left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina where reporte_produccion.empresa = 'AZ' and bit_prod_hr.activo <> 5   group by month(fecha_registro); ");

		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}

	 }

	 function dashboard_eficienciaMaquina($data){

	 	$mes = $data['mes'];

	 	if ($data['empresa'] == 1) {
	 		$empresa = 'RR';
	 	}else{
	 		$empresa = 'AZ';
	 	}

		$query = $this->db->query(" SELECT date_format(fecha_registro,'%d-%m') as fecha,month(hora_registro) as mes,day(hora_registro) as dia,maquina,sum(objetivo_hr) as objetivo_hr,sum(piezas_buenas) as piezas_buenas,round((sum(piezas_buenas)/sum(objetivo_hr))*100) as eficiencia from reporte_produccion left join bit_prod_hr on reporte_produccion.id_reporte = bit_prod_hr.id_folio_produccion left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina where reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$mes' and bit_prod_hr.activo <> 5  group by day(fecha_registro); ");

		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}

	 }


	 function getEficienciaDetalleDia($data){
	 	$mes = $data['mes'];
	 	$dia = $data['dia'];

	 	if ($data['empresa'] == 1) {
	 		$empresa = 'RR';
	 	}else{
	 		$empresa = 'AZ';
	 	}

		$query = $this->db->query(" SELECT date_format(hora_registro,'%d-%m %H:%i') as fecha,maquina,objetivo_hr,piezas_buenas,eficiencia,bit_prod_hr.num_operador  from bit_prod_hr left join reporte_produccion on bit_prod_hr.id_folio_produccion = reporte_produccion.id_reporte left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina  where month(hora_registro) = '$mes' and day(hora_registro)= '$dia'   and reporte_produccion.empresa = '$empresa' and bit_prod_hr.activo<> 5  ");

		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}	 	

	 }


//if(round((sum(IF(date_format(hora_registro,'%H:%i') > '11:00' && date_format(hora_registro,'%H:%i') < '11:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '11:00' && date_format(hora_registro,'%H:%i') < '11:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '11:00' && date_format(hora_registro,'%H:%i') < '11:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '11:00' && date_format(hora_registro,'%H:%i') < '11:59',objetivo_hr , '0')))*100)) as 'hora6'

	 function eficienciaDiaria($data){
	 	$turno = $data['turno'];
	 	$dateNow = $data['dateNow'];
	 	$empresa = $data['empresa'];
	 	$fechaTurno = $data['fechaTurno'];

		switch ($turno) {
		    case 1:
		        $queries = "SELECT maquina, 
		        			if(round((sum(IF(date_format(hora_registro,'%H:%i') > '08:00' && date_format(hora_registro,'%H:%i') < '08:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '08:00' && date_format(hora_registro,'%H:%i') < '08:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '08:00' && date_format(hora_registro,'%H:%i') < '08:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '08:00' && date_format(hora_registro,'%H:%i') < '08:59',objetivo_hr , '0')))*100)) as 'hora1', 

		        			if(round((sum(IF(date_format(hora_registro,'%H:%i') > '09:00' && date_format(hora_registro,'%H:%i') < '09:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '09:00' && date_format(hora_registro,'%H:%i') < '09:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '09:00' && date_format(hora_registro,'%H:%i') < '09:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '09:00' && date_format(hora_registro,'%H:%i') < '09:59',objetivo_hr , '0')))*100)) as 'hora2', 

		        			if(round((sum(IF(date_format(hora_registro,'%H:%i') > '10:00' && date_format(hora_registro,'%H:%i') < '10:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '10:00' && date_format(hora_registro,'%H:%i') < '10:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '10:00' && date_format(hora_registro,'%H:%i') < '10:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '10:00' && date_format(hora_registro,'%H:%i') < '10:59',objetivo_hr , '0')))*100)) as 'hora3', 

		        			if(round((sum(IF(date_format(hora_registro,'%H:%i') > '11:00' && date_format(hora_registro,'%H:%i') < '11:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '11:00' && date_format(hora_registro,'%H:%i') < '11:59',objetivo_hr , '0')))*110)>'110','110',round((sum(IF(date_format(hora_registro,'%H:%i') > '11:00' && date_format(hora_registro,'%H:%i') < '11:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '11:00' && date_format(hora_registro,'%H:%i') < '11:59',objetivo_hr , '0')))*100))as 'hora4', 

		        			IF(round((sum(IF(date_format(hora_registro,'%H:%i') > '12:00' && date_format(hora_registro,'%H:%i') < '12:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '12:00' && date_format(hora_registro,'%H:%i') < '12:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '12:00' && date_format(hora_registro,'%H:%i') < '12:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '12:00' && date_format(hora_registro,'%H:%i') < '12:59',objetivo_hr , '0')))*100)) as 'hora5', 

		        			if(round((sum(IF(date_format(hora_registro,'%H:%i') > '13:00' && date_format(hora_registro,'%H:%i') < '13:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '13:00' && date_format(hora_registro,'%H:%i') < '13:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '13:00' && date_format(hora_registro,'%H:%i') < '13:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '13:00' && date_format(hora_registro,'%H:%i') < '13:59',objetivo_hr , '0')))*100))as 'hora6', 

		        			if(round((sum(IF(date_format(hora_registro,'%H:%i') > '14:00' && date_format(hora_registro,'%H:%i') < '14:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '14:00' && date_format(hora_registro,'%H:%i') < '14:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '14:00' && date_format(hora_registro,'%H:%i') < '14:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '14:00' && date_format(hora_registro,'%H:%i') < '14:59',objetivo_hr , '0')))*100))as 'hora7', 

		        			if(round((sum(IF(date_format(hora_registro,'%H:%i') > '15:00' && date_format(hora_registro,'%H:%i') < '15:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '15:00' && date_format(hora_registro,'%H:%i') < '15:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '15:00' && date_format(hora_registro,'%H:%i') < '15:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '15:00' && date_format(hora_registro,'%H:%i') < '15:59',objetivo_hr , '0')))*100)) as 'hora8', 

		        			if(round((sum(IF(date_format(hora_registro,'%H:%i') > '16:00' && date_format(hora_registro,'%H:%i') < '16:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '16:00' && date_format(hora_registro,'%H:%i') < '16:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '16:00' && date_format(hora_registro,'%H:%i') < '16:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '16:00' && date_format(hora_registro,'%H:%i') < '16:59',objetivo_hr , '0')))*100)) as 'hora9' ,

		        			if(round((sum(IF(date_format(hora_registro,'%H:%i') > '17:00' && date_format(hora_registro,'%H:%i') < '17:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '17:00' && date_format(hora_registro,'%H:%i') < '17:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '17:00' && date_format(hora_registro,'%H:%i') < '17:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '17:00' && date_format(hora_registro,'%H:%i') < '17:59',objetivo_hr , '0')))*100)) as 'hora10',

		        			if(round((sum(IF(date_format(hora_registro,'%H:%i') > '18:00' && date_format(hora_registro,'%H:%i') < '18:50',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '18:00' && date_format(hora_registro,'%H:%i') < '18:50',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '18:00' && date_format(hora_registro,'%H:%i') < '18:50',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '18:00' && date_format(hora_registro,'%H:%i') < '18:50',objetivo_hr , '0')))*100)) as 'hora11',

		        			if(round((sum(IF(date_format(hora_registro,'%H:%i') > '18:50' && date_format(hora_registro,'%H:%i') < '19:10',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '18:50' && date_format(hora_registro,'%H:%i') < '19:10',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '18:50' && date_format(hora_registro,'%H:%i') < '19:10',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '18:50' && date_format(hora_registro,'%H:%i') < '19:10',objetivo_hr , '0')))*100)) as 'hora12'

		        			from matriz_maquina left join reporte_produccion on matriz_maquina.id_maquina = reporte_produccion.id_maquina left join bit_prod_hr on reporte_produccion.id_reporte = bit_prod_hr.id_folio_produccion where date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and reporte_produccion.empresa='$empresa' and turno = '$turno' and bit_prod_hr.activo <> 5 group by maquina order by maquina asc;"; break;
		    /*case 2:

		        $queries = "SELECT maquina, 
					if(round((sum(IF(date_format(hora_registro,'%H:%i') > '15:00' && date_format(hora_registro,'%H:%i') < '15:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '15:00' && date_format(hora_registro,'%H:%i') < '15:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '15:00' && date_format(hora_registro,'%H:%i') < '15:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '15:00' && date_format(hora_registro,'%H:%i') < '15:59',objetivo_hr , '0')))*100)) as 'hora1', 
					if(round((sum(IF(date_format(hora_registro,'%H:%i') > '16:00' && date_format(hora_registro,'%H:%i') < '16:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '16:00' && date_format(hora_registro,'%H:%i') < '16:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '16:00' && date_format(hora_registro,'%H:%i') < '16:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '16:00' && date_format(hora_registro,'%H:%i') < '16:59',objetivo_hr , '0')))*100)) as 'hora2', 
					if(round((sum(IF(date_format(hora_registro,'%H:%i') > '17:00' && date_format(hora_registro,'%H:%i') < '17:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '17:00' && date_format(hora_registro,'%H:%i') < '17:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '17:00' && date_format(hora_registro,'%H:%i') < '17:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '17:00' && date_format(hora_registro,'%H:%i') < '17:59',objetivo_hr , '0')))*100)) as 'hora3', 
					if(round((sum(IF(date_format(hora_registro,'%H:%i') > '18:00' && date_format(hora_registro,'%H:%i') < '18:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '18:00' && date_format(hora_registro,'%H:%i') < '18:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '18:00' && date_format(hora_registro,'%H:%i') < '18:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '18:00' && date_format(hora_registro,'%H:%i') < '18:59',objetivo_hr , '0')))*100)) as 'hora4', 
					if(round((sum(IF(date_format(hora_registro,'%H:%i') > '19:00' && date_format(hora_registro,'%H:%i') < '19:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '19:00' && date_format(hora_registro,'%H:%i') < '19:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '19:00' && date_format(hora_registro,'%H:%i') < '19:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '19:00' && date_format(hora_registro,'%H:%i') < '19:59',objetivo_hr , '0')))*100)) as 'hora5', 
					if(round((sum(IF(date_format(hora_registro,'%H:%i') > '20:00' && date_format(hora_registro,'%H:%i') < '20:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '20:00' && date_format(hora_registro,'%H:%i') < '20:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '20:00' && date_format(hora_registro,'%H:%i') < '20:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '20:00' && date_format(hora_registro,'%H:%i') < '20:59',objetivo_hr , '0')))*100)) as 'hora6', 
					if(round((sum(IF(date_format(hora_registro,'%H:%i') > '21:00' && date_format(hora_registro,'%H:%i') < '21:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '21:00' && date_format(hora_registro,'%H:%i') < '21:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '21:00' && date_format(hora_registro,'%H:%i') < '21:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '21:00' && date_format(hora_registro,'%H:%i') < '21:59',objetivo_hr , '0')))*100)) as 'hora7', 
					if(round((sum(IF(date_format(hora_registro,'%H:%i') > '22:00' && date_format(hora_registro,'%H:%i') < '22:29',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '22:00' && date_format(hora_registro,'%H:%i') < '22:29',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '22:00' && date_format(hora_registro,'%H:%i') < '22:29',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '22:00' && date_format(hora_registro,'%H:%i') < '22:29',objetivo_hr , '0')))*100)) as 'hora8', 
					if(round((sum(IF(date_format(hora_registro,'%H:%i') > '22:00' && date_format(hora_registro,'%H:%i') < '22:29',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '22:00' && date_format(hora_registro,'%H:%i') < '22:29',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '22:00' && date_format(hora_registro,'%H:%i') < '22:29',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '22:00' && date_format(hora_registro,'%H:%i') < '22:29',objetivo_hr , '0')))*100)) as 'hora9'  from matriz_maquina left join reporte_produccion on matriz_maquina.id_maquina = reporte_produccion.id_maquina left join bit_prod_hr on reporte_produccion.id_reporte = bit_prod_hr.id_folio_produccion where date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and reporte_produccion.empresa='$empresa' and bit_prod_hr.activo <> 5 group by maquina order by maquina asc; ";
		        break;*/

		        /*


		        		    		$dateN = $dateNow;
		    		$fecha_validation = $dateNow." ".$fechaTurno;

		    		 $time=date_create($fechaTurno);
		    		 $timeValidate=date_create('23:59');
		    		 $tiempo = date_format($time,"H:i");

		    		 $timeVal = date_format($timeValidate,"H:i");



					if(strtotime($fechaTurno)<=strtotime('23:59:00')) {
					//do some work
						//echo "true";
		    			$dateN =  date('Y-m-d', strtotime($dateNow. ' - 1 days'));
		    			$dateTomorrow = $dateNow;
					} else {
		    			$dateN=  $dateNow;
		    			$dateTomorrow  = date('Y-m-d', strtotime($dateNow. ' + 1 days'));						
						//do something
						//echo "false";
					}
 $queries = "SELECT maquina, 

		        if(round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 20:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 20:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 20:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 20:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 20:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 20:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 20:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 20:59',objetivo_hr , '0')))*100)) as 'hora1',

		        if(round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 21:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 21:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 21:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 21:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 21:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 21:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 21:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 21:59',objetivo_hr , '0')))*100)) as 'hora2',

				if(round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 22:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 22:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 22:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 00:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 22:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 22:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 22:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 22:59',objetivo_hr , '0')))*100)) as 'hora3', 

				if(round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 23:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 23:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 23:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 23:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 23:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 23:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateN 23:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateN 23:59',objetivo_hr , '0')))*100)) as 'hora4', 

				if(round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 00:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 00:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 00:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 00:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 00:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 00:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 00:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 00:59',objetivo_hr , '0')))*100)) as 'hora5', 

				if(round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 01:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 01:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 01:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 01:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 01:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 01:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 01:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 01:59',objetivo_hr , '0')))*100)) as 'hora6',

				if(round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 02:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 02:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 02:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 02:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 02:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 02:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 02:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 02:59',objetivo_hr , '0')))*100)) as 'hora7',

				if(round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 03:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 03:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 03:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 03:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 03:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 03:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 03:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 03:59',objetivo_hr , '0')))*100)) as 'hora8', 

				if(round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 04:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 04:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 04:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 04:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 04:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 04:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 04:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 04:59',objetivo_hr , '0')))*100)) as 'hora9', 

				if(round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 05:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 05:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 05:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 05:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 05:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 05:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 05:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 05:59',objetivo_hr , '0')))*100)) as 'hora10',

				if(round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 06:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 06:50',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 06:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 06:50',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 06:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 06:50',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 06:00' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 06:50',objetivo_hr , '0')))*100)) as 'hora11',

				if(round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 06:50' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 07:00',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 06:50' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 07:00',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 06:50' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 07:00',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%Y-%m-%d %H:%i') > '$dateTomorrow 06:50' && date_format(hora_registro,'%Y-%m-%d %H:%i') < '$dateTomorrow 07:00',objetivo_hr , '0')))*100)) as 'hora12'

from matriz_maquina left join reporte_produccion on matriz_maquina.id_maquina = reporte_produccion.id_maquina left join bit_prod_hr on reporte_produccion.id_reporte = bit_prod_hr.id_folio_produccion where  reporte_produccion.empresa='$empresa' and turno = '$turno' and bit_prod_hr.activo <> 5 group by maquina order by maquina asc;";




		        */

		    case 2:

		        $queries = "SELECT maquina, 

		        if(round((sum(IF(date_format(hora_registro,'%H:%i') > '20:00' && date_format(hora_registro,'%H:%i') < '20:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '20:00' && date_format(hora_registro,'%H:%i') < '20:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '20:00' && date_format(hora_registro,'%H:%i') < '20:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '20:00' && date_format(hora_registro,'%H:%i') < '20:59',objetivo_hr , '0')))*100)) as 'hora1',

		        if(round((sum(IF(date_format(hora_registro,'%H:%i') > '21:00' && date_format(hora_registro,'%H:%i') < '21:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '21:00' && date_format(hora_registro,'%H:%i') < '21:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '21:00' && date_format(hora_registro,'%H:%i') < '21:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '21:00' && date_format(hora_registro,'%H:%i') < '21:59',objetivo_hr , '0')))*100)) as 'hora2',

				if(round((sum(IF(date_format(hora_registro,'%H:%i') > '22:00' && date_format(hora_registro,'%H:%i') < '22:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '22:00' && date_format(hora_registro,'%H:%i') < '00:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '22:00' && date_format(hora_registro,'%H:%i') < '22:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '22:00' && date_format(hora_registro,'%H:%i') < '22:59',objetivo_hr , '0')))*100)) as 'hora3', 

				if(round((sum(IF(date_format(hora_registro,'%H:%i') > '23:00' && date_format(hora_registro,'%H:%i') < '23:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '23:00' && date_format(hora_registro,'%H:%i') < '23:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '23:00' && date_format(hora_registro,'%H:%i') < '23:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '23:00' && date_format(hora_registro,'%H:%i') < '23:59',objetivo_hr , '0')))*100)) as 'hora4', 

				if(round((sum(IF(date_format(hora_registro,'%H:%i') > '00:00' && date_format(hora_registro,'%H:%i') < '00:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '00:00' && date_format(hora_registro,'%H:%i') < '00:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '00:00' && date_format(hora_registro,'%H:%i') < '00:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '00:00' && date_format(hora_registro,'%H:%i') < '00:59',objetivo_hr , '0')))*100)) as 'hora5', 

				if(round((sum(IF(date_format(hora_registro,'%H:%i') > '01:00' && date_format(hora_registro,'%H:%i') < '01:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '01:00' && date_format(hora_registro,'%H:%i') < '01:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '01:00' && date_format(hora_registro,'%H:%i') < '01:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '01:00' && date_format(hora_registro,'%H:%i') < '01:59',objetivo_hr , '0')))*100)) as 'hora6',

				if(round((sum(IF(date_format(hora_registro,'%H:%i') > '02:00' && date_format(hora_registro,'%H:%i') < '02:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '02:00' && date_format(hora_registro,'%H:%i') < '02:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '02:00' && date_format(hora_registro,'%H:%i') < '02:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '02:00' && date_format(hora_registro,'%H:%i') < '02:59',objetivo_hr , '0')))*100)) as 'hora7',

				if(round((sum(IF(date_format(hora_registro,'%H:%i') > '03:00' && date_format(hora_registro,'%H:%i') < '03:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '03:00' && date_format(hora_registro,'%H:%i') < '03:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '03:00' && date_format(hora_registro,'%H:%i') < '03:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '03:00' && date_format(hora_registro,'%H:%i') < '03:59',objetivo_hr , '0')))*100)) as 'hora8', 

				if(round((sum(IF(date_format(hora_registro,'%H:%i') > '04:00' && date_format(hora_registro,'%H:%i') < '04:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '04:00' && date_format(hora_registro,'%H:%i') < '04:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '04:00' && date_format(hora_registro,'%H:%i') < '04:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '04:00' && date_format(hora_registro,'%H:%i') < '04:59',objetivo_hr , '0')))*100)) as 'hora9', 

				if(round((sum(IF(date_format(hora_registro,'%H:%i') > '05:00' && date_format(hora_registro,'%H:%i') < '05:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '05:00' && date_format(hora_registro,'%H:%i') < '05:59',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '05:00' && date_format(hora_registro,'%H:%i') < '05:59',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '05:00' && date_format(hora_registro,'%H:%i') < '05:59',objetivo_hr , '0')))*100)) as 'hora10',

				if(round((sum(IF(date_format(hora_registro,'%H:%i') > '06:00' && date_format(hora_registro,'%H:%i') < '06:50',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '06:00' && date_format(hora_registro,'%H:%i') < '06:50',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '06:00' && date_format(hora_registro,'%H:%i') < '06:50',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '06:00' && date_format(hora_registro,'%H:%i') < '06:50',objetivo_hr , '0')))*100)) as 'hora11',

				if(round((sum(IF(date_format(hora_registro,'%H:%i') > '06:50' && date_format(hora_registro,'%H:%i') < '07:00',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '06:50' && date_format(hora_registro,'%H:%i') < '07:00',objetivo_hr , '0')))*100)>'100','100',round((sum(IF(date_format(hora_registro,'%H:%i') > '06:50' && date_format(hora_registro,'%H:%i') < '07:00',piezas_buenas , '0'))/sum(IF(date_format(hora_registro,'%H:%i') > '06:50' && date_format(hora_registro,'%H:%i') < '07:00',objetivo_hr , '0')))*100)) as 'hora12'

from matriz_maquina left join reporte_produccion on matriz_maquina.id_maquina = reporte_produccion.id_maquina left join bit_prod_hr on reporte_produccion.id_reporte = bit_prod_hr.id_folio_produccion where date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and reporte_produccion.empresa='$empresa' and turno = '$turno' and bit_prod_hr.activo <> 5 group by maquina order by maquina asc;"; 
		        break;
		}
		//echo $queries;
		$query = $this->db->query($queries);

		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}

	 }	

	function minutosTM($data){
	 	$turno = $data['turno'];
	 	$dateNow = $data['dateNow'];
	 	$empresa = $data['empresa'];

		$query = $this->db->query(" 
			SELECT maquina,
			sum(IF(departamento = 'Calidad', tiempo_muerto_individual, '0')) as 'Calidad',
			sum(IF(departamento = 'Mantenimiento', tiempo_muerto_individual, '0')) as 'Mantenimiento',
			sum(IF(departamento = 'Materiales', tiempo_muerto_individual, '0')) as 'Materiales',
			sum(IF(departamento = 'Procesos', tiempo_muerto_individual, '0')) as 'Procesos',
			sum(IF(departamento = 'Produccion', tiempo_muerto_individual, '0')) as 'Produccion',
			sum(IF(departamento = 'Proyectos', tiempo_muerto_individual, '0')) as 'Proyectos',
			sum(IF(departamento = 'RH', tiempo_muerto_individual, '0')) as 'RH',
			sum(IF(departamento = 'Seguridad', tiempo_muerto_individual, '0')) as 'Seguridad'
			from bit_prod_hr left join reporte_produccion on bit_prod_hr.id_folio_produccion = reporte_produccion.id_reporte left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina left join bit_tiempo_muerto on bit_prod_hr.id_reporte_hr = bit_tiempo_muerto.id_reporte_hr   where date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and reporte_produccion.empresa='$empresa' and bit_prod_hr.activo <> 5  group by maquina order by maquina asc;
			");

		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}

	}  

	function showSrapTable($data){
		//print_r($data);
		$opcion_tiempo = $data['opcion_tiempo'];
		$empresa = $data['empresa'];
		$resumen = $data['resumen'];
		$indicador = $data['indicador'];
		$left = " from bit_prod_hr left join reporte_produccion on bit_prod_hr.id_folio_produccion = reporte_produccion.id_reporte left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina left join bit_scrap on bit_prod_hr.id_reporte_hr = bit_scrap.id_reporte_hr left join defecto_scrap on bit_scrap.id_defecto = defecto_scrap.id_defecto where "; 

		if ($empresa == 'AZ') {
		switch ($opcion_tiempo) {
			    case 0:
			    	$turno = $data['turno'];
			    	$dateNow = $data['dateNow'];

		    		if ($resumen == 'Operador') {
		    			$column = "turno,reporte_produccion.num_operador,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "turno,no_parte,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "turno,reporte_produccion.empresa,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    			$where = "date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "turno,maquina,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by maquina";
		    		}
				break;

			    case 1:
			    	$fechaReporte = $data['fechaReporte'];
		    		if ($resumen == 'Operador') {
		    			$column = "date_format(hora_regist
		    				ro,'%Y-%m-%d') as fecha,reporte_produccion.num_operador,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    				$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "date_format(hora_regist
		    				ro,'%Y-%m-%d') as fecha,no_parte,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    				$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "date_format(hora_regist
		    				ro,'%Y-%m-%d') as fecha,reporte_produccion.empresa,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    				$where = "date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,maquina,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    				$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by maquina";
		    		}
		        break;

			    case 2:
		    		$numero_semana = $data['numero_semana'];
		    		if ($resumen == 'Operador') {
		    			$column = "week(hora_registro) as 
		    			semana,reporte_produccion.num_operador,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "week(hora_registro) as semana,no_parte,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "week(hora_registro) as 
		    			semana,reporte_produccion.empresa,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    			$where = "week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "week(hora_registro) as semana,maquina,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by maquina";
		    		}			        
		        break;			    

		        case 3:
		        	$numero_mes = $data['numero_mes'];
		    		if ($resumen == 'Operador') {
		    			$column = "month(hora_registro) as
		    			 mes,reporte_produccion.num_operador,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    			 $where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "month(hora_registro) as mes,no_parte,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "month(hora_registro) as
		    			 mes,reporte_produccion.empresa,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    			 $where = "month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "month(hora_registro) as mes,maquina,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Incompleta_Falta com', scrap_individual, '0')) as 'Incompleta_Falta_com', sum(IF(defecto = 'Rotas_Quebradas', scrap_individual, '0')) as 'Rotas_Quebradas', sum(IF(defecto = 'Rafagas', scrap_individual, '0')) as 'Rafagas', sum(IF(defecto = 'Flap_Robot', scrap_individual, '0')) as 'Flap_Robot', sum(IF(defecto = 'Exceso de rebaba', scrap_individual, '0')) as 'Exceso_de_rebaba', sum(IF(defecto = 'Grietas', scrap_individual, '0')) as 'Grietas', sum(IF(defecto = 'Manchas', scrap_individual, '0')) as 'Manchas', sum(IF(defecto = 'Piezas en el piso', scrap_individual, '0')) as 'Piezas_en_el_piso', sum(IF(defecto = 'Mala impresion', scrap_individual, '0')) as 'Mala_impresion', sum(IF(defecto = 'Brilo fuera de espec', scrap_individual, '0')) as 'Brilo_fuera_de_espec', sum(IF(defecto = 'Color fuera de espec', scrap_individual, '0')) as 'Color_fuera_de_espec', sum(IF(defecto = 'Dimension fuera de e', scrap_individual, '0')) as 'Dimension_fuera_de_e', sum(IF(defecto = 'Contaminado', scrap_individual, '0')) as 'Contaminado', sum(IF(defecto = 'Setup_Ajustes', scrap_individual, '0')) as 'Setup_Ajustes', sum(IF(defecto = 'Quemado', scrap_individual, '0')) as 'Quemado'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by maquina";
		    		}			        
		        break;
		}			
		}else{
		switch ($opcion_tiempo) {
			    case 0:
			    	$turno = $data['turno'];
			    	$dateNow = $data['dateNow'];

		    		if ($resumen == 'Operador') {
		    			$column = "turno,reporte_produccion.num_operador,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "turno,no_parte,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "turno,reporte_produccion.empresa,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    			$where = "date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "turno,maquina,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by maquina";
		    		}
				break;

			    case 1:
			    	$fechaReporte = $data['fechaReporte'];
		    		if ($resumen == 'Operador') {
		    			$column = "date_format(hora_regist
		    				ro,'%Y-%m-%d') as fecha,reporte_produccion.num_operador,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    				$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "date_format(hora_regist
		    				ro,'%Y-%m-%d') as fecha,no_parte,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    				$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "date_format(hora_regist
		    				ro,'%Y-%m-%d') as fecha,reporte_produccion.empresa,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    				$where = "date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,maquina,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    				$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by maquina";
		    		}
		        break;

			    case 2:
		    		$numero_semana = $data['numero_semana'];
		    		if ($resumen == 'Operador') {
		    			$column = "week(hora_registro) as 
		    			semana,reporte_produccion.num_operador,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "week(hora_registro) as semana,no_parte,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "week(hora_registro) as 
		    			semana,reporte_produccion.empresa,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    			$where = "week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "week(hora_registro) as semana,maquina,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by maquina";
		    		}			        
		        break;			    

		        case 3:
		        	$numero_mes = $data['numero_mes'];
		    		if ($resumen == 'Operador') {
		    			$column = "month(hora_registro) as
		    			 mes,reporte_produccion.num_operador,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    			 $where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "month(hora_registro) as mes,no_parte,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "month(hora_registro) as
		    			 mes,reporte_produccion.empresa,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    			 $where = "month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "month(hora_registro) as mes,maquina,IFNULL(sum(scrap_individual), 0) as scrap,sum(IF(defecto = 'Burbuja', scrap_individual, '0')) as 'Burbuja', sum(IF(defecto = 'Piezas en el Piso', scrap_individual, '0')) as 'Piezas_en_el_Piso', sum(IF(defecto = 'Contaminacion', scrap_individual, '0')) as 'Contaminacion', sum(IF(defecto = 'Cruda', scrap_individual, '0')) as 'Cruda', sum(IF(defecto = 'Deforme', scrap_individual, '0')) as 'Deforme', sum(IF(defecto = 'Despegada', scrap_individual, '0')) as 'Despegada', sum(IF(defecto = 'Grieta', scrap_individual, '0')) as 'Grieta', sum(IF(defecto = 'Material de empaque', scrap_individual, '0')) as 'Material_de_empaque', sum(IF(defecto = 'Incompleta', scrap_individual, '0')) as 'Incompleta', sum(IF(defecto = 'Rebaba Moldeada', scrap_individual, '0')) as 'Rebaba_Moldeada', sum(IF(defecto = 'Rota', scrap_individual, '0')) as 'Rota'"; 
		    			$where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by maquina";
		    		}			        
		        break;
		}
		}


		//echo "SELECT ".$column.$left.$where;
		$query = $this->db->query("SELECT ".$column.$left.$where);

		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}

	}

	function showEficienciaTable($data){
		$opcion_tiempo = $data['opcion_tiempo'];
		$empresa = $data['empresa'];
		$resumen = $data['resumen'];
		$indicador = $data['indicador'];
		$left = " from bit_prod_hr left join reporte_produccion on bit_prod_hr.id_folio_produccion = reporte_produccion.id_reporte left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina where "; 

		switch ($opcion_tiempo) {
			    case 0:
			    	$turno = $data['turno'];
			    	$dateNow = $data['dateNow'];
		    		if ($resumen == 'Operador') {
		    			$column = "turno,bit_prod_hr.num_operador,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "turno,no_parte,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "turno,reporte_produccion.empresa,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "turno,maquina,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by maquina";
		    		}
				break;

			    case 1:
			    	$fechaReporte = $data['fechaReporte'];
		    		if ($resumen == 'Operador') {
		    			$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,reporte_produccion.num_operador,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,no_parte,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,reporte_produccion.empresa,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,maquina,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by maquina";
		    		}
		        break;

			    case 2:
		    		$numero_semana = $data['numero_semana'];
		    		if ($resumen == 'Operador') {
		    			$column = "week(hora_registro) as semana,reporte_produccion.num_operador,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "week(hora_registro) as semana,no_parte,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "week(hora_registro) as semana,reporte_produccion.empresa,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "week(hora_registro) as semana,maquina,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by maquina";
		    		}			        
		        break;			    

		        case 3:
		        	$numero_mes = $data['numero_mes'];
		    		if ($resumen == 'Operador') {
		    			$column = "month(hora_registro) as mes,reporte_produccion.num_operador,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "month(hora_registro) as mes,no_parte,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "month(hora_registro) as mes,reporte_produccion.empresa,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "month(hora_registro) as mes,maquina,round(sum(piezas_buenas)/sum(objetivo_hr)*100) as eficiencia";
		    			$where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by maquina";
		    		}			        
		        break;
		}

		$query = $this->db->query("SELECT ".$column.$left.$where);

		if ($query->num_rows() > 0) {
			return $query;
		}else{
			return "0";
		}		
	}
	function showTiempoTable($data){
			$opcion_tiempo = $data['opcion_tiempo'];
			$empresa = $data['empresa'];
			$resumen = $data['resumen'];
			$indicador = $data['indicador'];
			$left = " from bit_prod_hr left join reporte_produccion on bit_prod_hr.id_folio_produccion = reporte_produccion.id_reporte left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina left join bit_tiempo_muerto on bit_prod_hr.id_reporte_hr = bit_tiempo_muerto.id_reporte_hr where ";; 

			switch ($opcion_tiempo) {
				    case 0:
				    	$turno = $data['turno'];
				    	$dateNow = $data['dateNow'];
			    		if ($resumen == 'Operador') {
				    				$column = "turno,bit_prod_hr.num_operador,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; 
				    				$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
			    		}else if($resumen == 'No.Parte'){
				    			$column = "turno,no_parte,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; 
				    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by no_parte";
			    		}else if($resumen == 'Empresa'){
				    				$column = "turno,reporte_produccion.empresa,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; 
				    				$where = "date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
			    		}else if($resumen == 'Maquina'){
				    				$column = "turno,maquina,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; 
				    				$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by maquina";
			    		}
					break;

				    case 1:
				    	$fechaReporte = $data['fechaReporte'];
			    		if ($resumen == 'Operador') {
				    				$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,reporte_produccion.num_operador,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; 
				    				$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
			    		}else if($resumen == 'No.Parte'){
				    			$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,no_parte,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; 
				    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by no_parte";
			    		}else if($resumen == 'Empresa'){
				    				$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,reporte_produccion.empresa,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; $where = "date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by reporte_produccion.empresa";
			    		}else if($resumen == 'Maquina'){
				    				$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,maquina,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; $where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by maquina";
			    		}
			        break;

				    case 2:
			    		$numero_semana = $data['numero_semana'];
			    		if ($resumen == 'Operador') {
				    				$column = "week(hora_registro) as semana,reporte_produccion.num_operador,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; $where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5  group by reporte_produccion.num_operador";
			    		}else if($resumen == 'No.Parte'){
				    			$column = "week(hora_registro) as semana,no_parte,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; $where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5  group by no_parte";
			    		}else if($resumen == 'Empresa'){
				    				$column = "week(hora_registro) as semana,reporte_produccion.empresa,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; $where = "week(fecha_registro) = '$numero_semana'  and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
			    		}else if($resumen == 'Maquina'){
				    				$column = "week(hora_registro) as semana,maquina,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; $where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5  group by maquina";
			    		}			        
			        break;			    

			        case 3:
			        	$numero_mes = $data['numero_mes'];
			    		if ($resumen == 'Operador') {
				    				$column = "month(hora_registro) as mes,reporte_produccion.num_operador,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; $where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
			    		}else if($resumen == 'No.Parte'){
				    			$column = "month(hora_registro) as mes,no_parte,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; $where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by no_parte";
			    		}else if($resumen == 'Empresa'){
				    				$column = "month(hora_registro) as mes,reporte_produccion.empresa,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; $where = "month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
			    		}else if($resumen == 'Maquina'){
				    				$column = "month(hora_registro) as mes,maquina,IFNULL(sum(tiempo_muerto_individual), 0) as tiempo,sum(IF(bit_tiempo_muerto.motivo = 'Falla de maquina', tiempo_muerto_individual, '0')) as 'Falla_de_maquina', sum(IF(bit_tiempo_muerto.motivo = '	Falla de suministros', tiempo_muerto_individual, '0')) as '	Falla_de_suministros', sum(IF(bit_tiempo_muerto.motivo = 'Falta de materia pri', tiempo_muerto_individual, '0')) as 'Falta_de_materia_pri', sum(IF(bit_tiempo_muerto.motivo = 'Materia prima fuera', tiempo_muerto_individual, '0')) as 'Materia_prima_fuera', sum(IF(bit_tiempo_muerto.motivo = 'Falta de material de', tiempo_muerto_individual, '0')) as 'Falta_de_material_de', sum(IF(bit_tiempo_muerto.motivo = 'Material de empaque', tiempo_muerto_individual, '0')) as 'Material_de_empaque', sum(IF(bit_tiempo_muerto.motivo = 'Ciclo de maquina may', tiempo_muerto_individual, '0')) as 'Ciclo_de_maquina_may', sum(IF(bit_tiempo_muerto.motivo = 'Ajuste de procesos', tiempo_muerto_individual, '0')) as 'Ajuste_de_procesos', sum(IF(bit_tiempo_muerto.motivo = 'Falla de molde', tiempo_muerto_individual, '0')) as 'Falla_de_molde' , sum(IF(bit_tiempo_muerto.motivo = 'Cambio de molde', tiempo_muerto_individual, '0')) as 'Cambio_de_molde', sum(IF(bit_tiempo_muerto.motivo = 'Arranque', tiempo_muerto_individual, '0')) as 'Arranque' , sum(IF(bit_tiempo_muerto.motivo = 'Ausentismo', tiempo_muerto_individual, '0')) as 'Ausentismo', sum(IF(bit_tiempo_muerto.motivo = 'Falta de Programa', tiempo_muerto_individual, '0')) as 'Falta_de_Programa' , sum(IF(bit_tiempo_muerto.motivo = 'Personal en WC,Comid', tiempo_muerto_individual, '0')) as 'Personal_en_WC_Comid', sum(IF(bit_tiempo_muerto.motivo = 'Personal sin habilid', tiempo_muerto_individual, '0')) as 'Personal_sin_habilid', sum(IF(bit_tiempo_muerto.motivo = 'Pruebas de nuevos pr', tiempo_muerto_individual, '0')) as 'Pruebas_de_nuevos_pr' , sum(IF(bit_tiempo_muerto.motivo = 'Falta completar plan', tiempo_muerto_individual, '0')) as 'Falta_completar_plan' , sum(IF(bit_tiempo_muerto.motivo = 'Falta de equipo de p', tiempo_muerto_individual, '0')) as 'Falta_de_equipo_de_p' "; $where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes' and bit_prod_hr.activo <> 5 group by maquina";
			    		}			        
			        break;
			}
			$query = $this->db->query("SELECT ".$column.$left.$where);

			if ($query->num_rows() > 0) {
				return $query;
			}else{
				return "0";
			}		
		}

		function showProduccionTable($data){
		$opcion_tiempo = $data['opcion_tiempo'];
		$empresa = $data['empresa'];
		$resumen = $data['resumen'];
		$indicador = $data['indicador'];
		$left = " from bit_prod_hr left join reporte_produccion on bit_prod_hr.id_folio_produccion = reporte_produccion.id_reporte left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina where "; 

		switch ($opcion_tiempo) {
			    case 0:
			    	$turno = $data['turno'];
			    	$dateNow = $data['dateNow'];
		    		if ($resumen == 'Operador') {
		    			$column = "turno,bit_prod_hr.num_operador,sum(piezas_buenas) as produccion";
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "turno,no_parte,sum(piezas_buenas) as produccion";
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "turno,reporte_produccion.empresa,sum(piezas_buenas) as produccion";
		    			$where = "date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "turno,maquina,sum(piezas_buenas) as produccion";
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$dateNow' and turno = '$turno' and bit_prod_hr.activo <> 5 group by maquina";
		    		}
				break;

			    case 1:
			    	$fechaReporte = $data['fechaReporte'];
		    		if ($resumen == 'Operador') {
		    			$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,reporte_produccion.num_operador,sum(piezas_buenas) as produccion";
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,no_parte,sum(piezas_buenas) as produccion";
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,reporte_produccion.empresa,sum(piezas_buenas) as produccion";
		    			$where = "date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "date_format(hora_registro,'%Y-%m-%d') as fecha,maquina,sum(piezas_buenas) as produccion";
		    			$where = "reporte_produccion.empresa = '$empresa' and date_format(hora_registro,'%Y-%m-%d') = '$fechaReporte' and bit_prod_hr.activo <> 5  group by maquina";
		    		}
		        break;

			    case 2:
		    		$numero_semana = $data['numero_semana'];
		    		if ($resumen == 'Operador') {
		    			$column = "week(hora_registro) as semana,reporte_produccion.num_operador,sum(piezas_buenas) as produccion";
		    			$where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "week(hora_registro) as semana,no_parte,sum(piezas_buenas) as produccion";
		    			$where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "week(hora_registro) as semana,reporte_produccion.empresa,sum(piezas_buenas) as produccion";
		    			$where = "week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "week(hora_registro) as semana,maquina,sum(piezas_buenas) as produccion";
		    			$where = "reporte_produccion.empresa = '$empresa' and week(fecha_registro) = '$numero_semana' and bit_prod_hr.activo <> 5 group by maquina";
		    		}			        
		        break;			    

		        case 3:
		        	$numero_mes = $data['numero_mes'];
		    		if ($resumen == 'Operador') {
		    			$column = "month(hora_registro) as mes,reporte_produccion.num_operador,sum(piezas_buenas) as produccion";
		    			$where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes'  and bit_prod_hr.activo <> 5 group by reporte_produccion.num_operador";
		    		}else if($resumen == 'No.Parte'){
		    			$column = "month(hora_registro) as mes,no_parte,sum(piezas_buenas) as produccion";
		    			$where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes'  and bit_prod_hr.activo <> 5 group by no_parte";
		    		}else if($resumen == 'Empresa'){
		    			$column = "month(hora_registro) as mes,reporte_produccion.empresa,sum(piezas_buenas) as produccion";
		    			$where = "month(fecha_registro) = '$numero_mes'  and bit_prod_hr.activo <> 5 group by reporte_produccion.empresa";
		    		}else if($resumen == 'Maquina'){
		    			$column = "month(hora_registro) as mes,maquina,sum(piezas_buenas) as produccion";
		    			$where = "reporte_produccion.empresa = '$empresa' and month(fecha_registro) = '$numero_mes'  and bit_prod_hr.activo <> 5 group by maquina";
		    		}			        
		        break;
		}

			$query = $this->db->query("SELECT ".$column.$left.$where);

			if ($query->num_rows() > 0) {
				return $query;
			}else{
				return "0";
			}		
		}

		function export_reporte(){
			$query = $this->db->query(" SELECT 
										reporte_produccion.empresa,hora_registro,reporte_produccion.turno,no_orden,no_parte,no_molde,cavidades,maquina,materia_prima,
										lote_materia_prima,reporte_produccion.num_operador,num_lider,
										(CASE WHEN turno = '1' THEN '8.5' WHEN turno = '2' THEN '8' WHEN turno = '3' THEN '7.5' ELSE 0 END) AS horas_trabajadas,bit_prod_hr.objetivo_hr,piezas_buenas,eficiencia
										FROM  bit_prod_hr 
										left join reporte_produccion on bit_prod_hr.id_folio_produccion = reporte_produccion.id_reporte 
										left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina 
										where month(hora_registro) = month(now())  and bit_prod_hr.activo <> 5
										order by bit_prod_hr.id_reporte_hr desc;");

			if ($query->num_rows() > 0) {
				return $query;
			}else{
				return "0";
			}
		}

		function export_reporteScrap(){
			$query = $this->db->query(" SELECT reporte_produccion.empresa,
										hora_registro,
										reporte_produccion.turno,
										no_orden,
										no_parte,
										no_molde,
										cavidades,
										maquina,
										materia_prima, 
										lote_materia_prima,
										reporte_produccion.num_operador,
										num_lider, (CASE WHEN turno = '1' THEN '8.5' WHEN turno = '2' THEN '8' WHEN turno = '3' THEN '7.5' ELSE 0 END) AS horas_trabajadas,
										bit_prod_hr.objetivo_hr,
										piezas_buenas,
										eficiencia,
										scrap_individual,
										scrap,
										tiempo_piezas_scrap,
										departamento,
										defecto
										FROM  bit_prod_hr 
										left join reporte_produccion on bit_prod_hr.id_folio_produccion = reporte_produccion.id_reporte 
										left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina
										left join bit_scrap on bit_prod_hr.id_reporte_hr = bit_scrap.id_reporte_hr
										left join defecto_scrap on bit_scrap.id_defecto = defecto_scrap.id_defecto
										where month(hora_registro) = month(now()) and bit_prod_hr.activo <> 5 order by bit_prod_hr.id_reporte_hr desc;");

			if ($query->num_rows() > 0) {
				return $query;
			}else{
				return "0";
			}			
		}

		function export_reporteTiempo(){
			$query = $this->db->query(" SELECT reporte_produccion.empresa,
										hora_registro,
										reporte_produccion.turno,
										no_orden,
										no_parte,
										no_molde,
										cavidades,
										maquina,
										materia_prima, 
										lote_materia_prima,
										reporte_produccion.num_operador,
										num_lider, (CASE WHEN turno = '1' THEN '8.5' WHEN turno = '2' THEN '8' WHEN turno = '3' THEN '7.5' ELSE 0 END) AS horas_trabajadas,
										bit_prod_hr.objetivo_hr,
										piezas_buenas,
										eficiencia,
										tiempo_muerto,
										tiempo_muerto_total,
										departamento,
										motivo,
										tiempo_muerto_individual
										FROM  bit_prod_hr 
										left join reporte_produccion on bit_prod_hr.id_folio_produccion = reporte_produccion.id_reporte 
										left join matriz_maquina on reporte_produccion.id_maquina = matriz_maquina.id_maquina
										left join bit_tiempo_muerto on bit_prod_hr.id_reporte_hr = bit_tiempo_muerto.id_reporte_hr
										where month(hora_registro) = month(now()) and bit_prod_hr.activo <> 5 order by bit_prod_hr.id_reporte_hr desc;");

			if ($query->num_rows() > 0) {
				return $query;
			}else{
				return "0";
			}			
		}

	function get_produccion($data){
			$hoy = $data['dateNow'];
			$empresa = $data['empresa'];

			$query = $this->db->query(" SELECT id_folio_produccion,date_format(hora_registro,'%d/%m %H:%i') as hora_registro,objetivo_hr,piezas_buenas,eficiencia,tiempo_muerto,tiempo_muerto_total,bit_prod_hr.num_operador,piezas_verificadas,empresa from bit_prod_hr left join reporte_produccion on bit_prod_hr.id_folio_produccion = reporte_produccion.id_reporte  where DATE_FORMAT(hora_registro, '%Y-%m-%d')='$hoy' and empresa='$empresa' and id_reporte is not null and bit_prod_hr.activo <> 5 order by hora_registro desc");

			if ($query->num_rows() > 0) {
				return $query;
			}else{
				return "0";
			}		
	}
	function get_produccion_data($data){
			$id_folio_produccion = $data['id_folio_produccion'];
			$hoy = $data['dateNow'];
			$empresa = $data['empresa'];

			$query = $this->db->query(" SELECT id_reporte_hr,id_folio_produccion,date_format(hora_registro,'%d/%m %H:%i') as hora_registro,objetivo_hr,piezas_buenas,eficiencia,tiempo_muerto,tiempo_muerto_total,bit_prod_hr.num_operador,piezas_verificadas,empresa from bit_prod_hr left join reporte_produccion on bit_prod_hr.id_folio_produccion = reporte_produccion.id_reporte  where DATE_FORMAT(hora_registro, '%Y-%m-%d')='$hoy' and empresa='$empresa' and id_reporte is not null and id_folio_produccion = '$id_folio_produccion'  and bit_prod_hr.activo <> 5 order by hora_registro desc");

			if ($query->num_rows() > 0) {
				return $query;
			}else{
				return "0";
			}		
	}

	function updProductionData($data){
			$piezas_buenas = $data['piezas_buenas'];
			$eficiencia = $data['eficiencia'];
			$tiempo_muerto = $data['tiempo_muerto'];
			$tiempo_muerto_total = $data['tiempo_muerto_total'];
			$objetivo_hr = $data['objetivo_hr'];
			$id_reporte_hr = $data['id_reporte_hr'];

			$query = $this->db->query("UPDATE bit_prod_hr SET objetivo_hr = '$objetivo_hr',	piezas_buenas = '$piezas_buenas', eficiencia = '$eficiencia', tiempo_muerto = '$tiempo_muerto', tiempo_muerto_total = '$tiempo_muerto_total' WHERE id_reporte_hr = '$id_reporte_hr';");

	}

	function deleteProductionData($data){
		$id_reporte_hr = $data['id_reporte_hr'];
		$query = $this->db->query("UPDATE bit_prod_hr SET activo = '5' WHERE id_reporte_hr = '$id_reporte_hr';");
	}				
}
?>