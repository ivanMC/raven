<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('usuario');
		$this->load->library('session');
		$this->load->helper('form');
	}

	function index()
	{
		/*if ($this->session->userdata('logged_in')) 
		{
			$session_data = $this->session->userdata('logged_in');
			$data['num_empleado'] = $session_data['num_empleado'];
			$data['departamento'] = $session_data['departamento'];
			$data['empresa'] = $session_data['empresa'];
			//$this->load->view('librerias');
			$this->load->view('gentelella-master/production/nav.php',$data);
			//$this->load->view('home');
			$this->load->view('gentelella-master/production/home.php');
			$this->load->view('gentelella-master/production/footer.php');
		}else{
			redirect('login','refresh');
		}*/
		if ($this->session->userdata('logged_in')) 
		{
			$session_data = $this->session->userdata('logged_in');
			$data['num_empleado'] = $session_data['num_empleado'];
			$data['departamento'] = $session_data['departamento'];
			$data['empresa'] = $session_data['empresa'];
			$data['nombre'] = $session_data['nombre'];
			$this->load->view('gentelella-master/production/nav.php',$data);
      		$data['maquina'] = $this->usuario->get_maquina($data['empresa'])->result_array();
			$this->load->view('gentelella-master/production/reporte_produccion2.php',$data);
			$this->load->view('gentelella-master/production/footer.php');
		}else{
			redirect('login','refresh');
		}	
	}

	function ajustes()
	{
		if ($this->session->userdata('logged_in')) 
		{
			$session_data = $this->session->userdata('logged_in');
			$data['num_empleado'] = $session_data['num_empleado'];
			$data['departamento'] = $session_data['departamento'];
			$data['empresa'] = $session_data['empresa'];
			$data['nombre'] = $session_data['nombre'];
			$this->load->view('gentelella-master/production/nav.php',$data);
			$data['empleados'] = $this->usuario->get_empleados()->result_array();
			$this->load->view('gentelella-master/production/ajustes_view.php',$data);
			$this->load->view('gentelella-master/production/footer.php');
		}else{
			redirect('login','refresh');
		}		
	}

	function reporte_produccion()
	{
		if ($this->session->userdata('logged_in')) 
		{
			$session_data = $this->session->userdata('logged_in');
			$data['num_empleado'] = $session_data['num_empleado'];
			$data['departamento'] = $session_data['departamento'];
			$data['empresa'] = $session_data['empresa'];
			$data['nombre'] = $session_data['nombre'];
			$this->load->view('gentelella-master/production/nav.php',$data);
      		$data['maquina'] = $this->usuario->get_maquina($data['empresa'])->result_array();
			$this->load->view('gentelella-master/production/reporte_produccion2.php',$data);
			$this->load->view('gentelella-master/production/footer.php');
		}else{
			redirect('login','refresh');
		}		
	}

	function reporte_produccion_hr()
	{
		if ($this->session->userdata('logged_in')) 
		{
			$session_data = $this->session->userdata('logged_in');
			$data['num_empleado'] = $session_data['num_empleado'];
			$data['departamento'] = $session_data['departamento'];
			$data['empresa'] = $session_data['empresa'];
			$data['nombre'] = $session_data['nombre'];
			$this->load->view('gentelella-master/production/nav.php',$data);
			$this->load->view('gentelella-master/production/reporte_produccion_hr.php',$data);
			$this->load->view('gentelella-master/production/footer.php');
		}else{
			redirect('login','refresh');
		}		
	}

	function matriz_maquinas()
	{
		if ($this->session->userdata('logged_in')) 
		{
			$session_data = $this->session->userdata('logged_in');
			$data['num_empleado'] = $session_data['num_empleado'];
			$data['departamento'] = $session_data['departamento'];
			$data['empresa'] = $session_data['empresa'];
			$data['nombre'] = $session_data['nombre'];
			$this->load->view('gentelella-master/production/nav.php',$data);
			$this->load->view('gentelella-master/production/matriz_maquina.php',$data);
			$this->load->view('gentelella-master/production/footer.php');
		}else{
			redirect('login','refresh');
		}		
	}

	function dashboardOperador()
	{
		if ($this->session->userdata('logged_in')) 
		{
		  	$date= date("Y-m-d H:i:s");
  			$fechaTurno = strtotime ( '-6 hour' , strtotime ( $date ) ) ;
  			$dateNow = date ( 'Y-m-d' , $fechaTurno );
			$session_data = $this->session->userdata('logged_in');
			$data['num_empleado'] = $session_data['num_empleado'];
			$data['departamento'] = $session_data['departamento'];
			$data['empresa'] = $session_data['empresa'];
			$data['nombre'] = $session_data['nombre'];
			$this->load->view('gentelella-master/production/nav.php',$data);
			$data['eficiencia'] = $this->usuario->getDashEficienciaGraph($data['num_empleado'],$dateNow);
			$data['tiempo'] = $this->usuario->getDashTiempoGraph($data['num_empleado'],$dateNow);
			$data['scrap'] = $this->usuario->getDashScrapGraph($data['num_empleado'],$dateNow);
			$this->load->view('gentelella-master/production/dashboardOperador.php',$data);
			$this->load->view('gentelella-master/production/footer.php');
		}else{
			redirect('login','refresh');
		}		
	}

	function dashboardGeneral()
	{
		if ($this->session->userdata('logged_in')) 
		{
		  	$date= date("Y-m-d H:i:s");
  			$fechaTurno = strtotime ( '-6 hour' , strtotime ( $date ) ) ;
  			$dateNow = date ( 'Y-m-d' , $fechaTurno );
			$session_data = $this->session->userdata('logged_in');
			$data['num_empleado'] = $session_data['num_empleado'];
			$data['departamento'] = $session_data['departamento'];
			$data['empresa'] = $session_data['empresa'];
			$data['nombre'] = $session_data['nombre'];
			$this->load->view('gentelella-master/production/nav.php',$data);
			$this->load->view('gentelella-master/production/dashboardGeneral.php',$data);
			$this->load->view('gentelella-master/production/footer.php');
		}else{
			redirect('login','refresh');
		}		
	}
	
	function dashboardGeneralFiltro()
	{
		if ($this->session->userdata('logged_in')) 
		{
		  	$date= date("Y-m-d H:i:s");
  			$fechaTurno = strtotime ( '-6 hour' , strtotime ( $date ) ) ;
  			$dateNow = date ( 'Y-m-d' , $fechaTurno );
			$session_data = $this->session->userdata('logged_in');
			$data['num_empleado'] = $session_data['num_empleado'];
			$data['departamento'] = $session_data['departamento'];
			$data['empresa'] = $session_data['empresa'];
			$data['nombre'] = $session_data['nombre'];
			$this->load->view('gentelella-master/production/nav.php',$data);
			$this->load->view('gentelella-master/production/dashboardGeneralFiltro.php',$data);
			$this->load->view('gentelella-master/production/footer.php');
		}else{
			redirect('login','refresh');
		}		
	}	

	function modulo_modificacion()
	{
		if ($this->session->userdata('logged_in')) 
		{
		  	$date= date("Y-m-d H:i:s");
  			$fechaTurno = strtotime ( '-6 hour' , strtotime ( $date ) ) ;
  			$dateNow = date ( 'Y-m-d' , $fechaTurno );
			$session_data = $this->session->userdata('logged_in');
			$data['num_empleado'] = $session_data['num_empleado'];
			$data['departamento'] = $session_data['departamento'];
			$data['empresa'] = $session_data['empresa'];
			$data['nombre'] = $session_data['nombre'];
			$this->load->view('gentelella-master/production/nav.php',$data);
			$this->load->view('gentelella-master/production/modulo_modificacion.php',$data);
			$this->load->view('gentelella-master/production/footer.php');
		}else{
			redirect('login','refresh');
		}		
	}

	function presentacion()
	{
		if ($this->session->userdata('logged_in')) 
		{
		  	$date= date("Y-m-d H:i:s");
  			$fechaTurno = strtotime ( '-6 hour' , strtotime ( $date ) ) ;
  			$dateNow = date ( 'Y-m-d' , $fechaTurno );
			$session_data = $this->session->userdata('logged_in');
			$data['num_empleado'] = $session_data['num_empleado'];
			$data['departamento'] = $session_data['departamento'];
			$data['empresa'] = $session_data['empresa'];
			$data['nombre'] = $session_data['nombre'];
			$this->load->view('gentelella-master/production/nav.php',$data);
			$this->load->view('gentelella-master/production/presentacion.php',$data);
			$this->load->view('gentelella-master/production/footer.php');
		}else{
			redirect('login','refresh');
		}		
	}

	function presentacionAdmin()
	{
		if ($this->session->userdata('logged_in')) 
		{
		  	$date= date("Y-m-d H:i:s");
  			$fechaTurno = strtotime ( '-6 hour' , strtotime ( $date ) ) ;
  			$dateNow = date ( 'Y-m-d' , $fechaTurno );
			$session_data = $this->session->userdata('logged_in');
			$data['num_empleado'] = $session_data['num_empleado'];
			$data['departamento'] = $session_data['departamento'];
			$data['empresa'] = $session_data['empresa'];
			$data['nombre'] = $session_data['nombre'];
			$this->load->view('gentelella-master/production/nav.php',$data);
			$this->load->view('gentelella-master/production/presentacionAdmin.php',$data);
			$this->load->view('gentelella-master/production/footer.php');
		}else{
			redirect('login','refresh');
		}		
	}

 	function ins_img(){
		$file = $_FILES;
	    echo "<pre> function ins_img";
        	echo 'application/views/gentelella-master/production/images/'.$_FILES['file']['name'];
   		echo "</pre>";
   		move_uploaded_file($_FILES['file']['tmp_name'],'application/views/gentelella-master/production/images/presentacionRaven/'.$_FILES['file']['name']);
 	}	

	function descargas()
	{
		if ($this->session->userdata('logged_in')) 
		{
		  	$date= date("Y-m-d H:i:s");
  			$fechaTurno = strtotime ( '-6 hour' , strtotime ( $date ) ) ;
  			$dateNow = date ( 'Y-m-d' , $fechaTurno );
			require '/home/mizacate/public_html/raven/application/libraries/PHPExcel/Classes/PHPExcel.php';
			$data['reporte'] = $this->usuario->export_reporte()->result_array();
			$this->load->view('gentelella-master/production/descargas.php',$data);

		}else{
			redirect('login','refresh');
		}		
	}

	function descargaScrap()
	{
		if ($this->session->userdata('logged_in')) 
		{
		  	$date= date("Y-m-d H:i:s");
  			$fechaTurno = strtotime ( '-6 hour' , strtotime ( $date ) ) ;
  			$dateNow = date ( 'Y-m-d' , $fechaTurno );
			require '/home/mizacate/public_html/raven/application/libraries/PHPExcel/Classes/PHPExcel.php';
			$data['reporte'] = $this->usuario->export_reporteScrap()->result_array();
			$this->load->view('gentelella-master/production/descargaScrap.php',$data);

		}else{
			redirect('login','refresh');
		}		
	}

	function descargaTiempo()
	{
		if ($this->session->userdata('logged_in')) 
		{
		  	$date= date("Y-m-d H:i:s");
  			$fechaTurno = strtotime ( '-6 hour' , strtotime ( $date ) ) ;
  			$dateNow = date ( 'Y-m-d' , $fechaTurno );
			require '/home/mizacate/public_html/raven/application/libraries/PHPExcel/Classes/PHPExcel.php';
			$data['reporte'] = $this->usuario->export_reporteTiempo()->result_array();
			$this->load->view('gentelella-master/production/descargasTiempo.php',$data);

		}else{
			redirect('login','refresh');
		}		
	}


	//Consultas a BD
	function get_empleados()
	{
		$data = $this->usuario->get_empleados();
		foreach ($data->result() as  $value) {
			$arr[] = $value;
		}
		echo json_encode($arr);

	}

	function guardarEmpleado()
	{
		$data = $_POST;
		$data['empleado'] = $this->usuario->guardarEmpleado($data);
	}

	function showEmpleado(){
		$data = $_POST;
		$data = $this->usuario->showEmpleado($data);
		foreach ($data->result() as  $value) {
			$arr[] = $value;
		}
		echo json_encode($arr);

	}

	function updateEmpleado()
	{
		$data = $_POST;
		$data = $this->usuario->updateEmpleado($data);
	}

  function getMaquinaInfo(){
    $data = $_POST;
    $data = $this->usuario->getMaquinaInfo($data);
    foreach ($data->result() as  $value) {
      $arr[] = $value;
    }
    echo json_encode($arr);    
  }


  function getDefectos(){
    $data = $_POST;
    $session_data = $this->session->userdata('logged_in');
    $data['empresa'] = $session_data['empresa'];
    $data = $this->usuario->getDefectos($data);
    foreach ($data->result() as  $value) {
      $arr[] = $value;
    }
    echo json_encode($arr);  	
  }

  function getDefectosCheck(){
    $data = $_POST;
    $session_data = $this->session->userdata('logged_in');
    $data['empresa'] = $session_data['empresa'];
    $data = $this->usuario->getDefectosCheck($data);
    foreach ($data->result() as  $value) {
      $arr[] = $value;
    }
    echo json_encode($arr);
  }

  function getDepartamento(){
    $data = $_POST;
    $data = $this->usuario->getDepartamento($data);
    foreach ($data->result() as  $value) {
      $arr[] = $value;
    }
    echo json_encode($arr);  	
  }

  function getMotivos(){
    $data = $_POST;
    $data = $this->usuario->getMotivos($data);
    foreach ($data->result() as  $value) {
      $arr[] = $value;
    }
    echo json_encode($arr);   	
  }

  function getMaquinaParte(){
	$data = $_POST;
    $data = $this->usuario->getMaquinaParte($data);
    foreach ($data->result() as  $value) {
      $arr[] = $value;
    }
    echo json_encode($arr);   	  	
  }



	function get_maquinas()
	{
		$data = $this->usuario->get_maquinas();
		foreach ($data->result() as  $value) {
			$arr[] = $value;
		}
		echo json_encode($arr);

	}

	function getMaquinaEmpresa()
	{
		$data = $_POST;
		$data = $this->usuario->getMaquinaEmpresa($data['empresa']);
		foreach ($data->result() as  $value) {
			$arr[] = $value;
		}
		echo json_encode($arr);		

	}

	function getMaquinaDetalle(){
		$data = $_POST;
		$data = $this->usuario->getMaquinaDetalle($data);
		foreach ($data->result() as  $value) {
			$arr[] = $value;
		}
		echo json_encode($arr);			
	}

	function showMaquinaDetalle(){
		$data = $_POST;
		$data = $this->usuario->showMaquinaDetalle($data);
		foreach ($data->result() as  $value) {
			$arr[] = $value;
		}
		echo json_encode($arr);			
	}

	function insertarMaquina(){
		$data = $_POST;
		$data['maquina'] = $this->usuario->insertarMaquina($data); 		
	}

	function actualizarMaquina(){
		$data = $_POST;
		$data['maquina'] = $this->usuario->actualizarMaquina($data); 		
	}

	function showDataTurno(){
		$data = $_POST;
		$data = $this->usuario->showDataTurno($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}
	
	}

	function showHeader(){
		$data = $_POST;
		$data = $this->usuario->get_lastMaquina($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}		
	}

	function regTurno(){
		$data = $_POST;
		$data = $this->usuario->regTurno($data);
		if ($data == '0') {
			print_r($data);
		}else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);			
		}

		
	}

	function regHora(){
		$data = $_POST;
		$data = $this->usuario->regHora($data);
		if ($data == '0') {
			print_r($data);
		}else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);			
		}

		
	}	

  function insertTurnoProd(){
	$data = $_POST;
	$data['reporte'] = $this->usuario->insertTurnoProd($data);
	echo json_encode($data);  	
  }

  function insertTurnoProdFolio(){
	$data = $_POST;
	$data['reporte'] = $this->usuario->insertTurnoProdFolio($data);
	echo json_encode($data);  	
  }

  function insert_reporteHr(){
	$data = $_POST;
	$data['reporte'] = $this->usuario->insert_reporteHr($data);
	echo json_encode($data);
  }

  function showDataTurnoHr(){
	$data = $_POST;
	$data = $this->usuario->showDataTurnoHr($data);
	if ($data == '0') {
		print_r($data);
	}
	else{
		foreach ($data->result() as  $value) {
			$arr[] = $value;
		}
		echo json_encode($arr);				
	}  	
  }  

  function showDataScrap(){
	$data = $_POST;
	$data = $this->usuario->showDataScrap($data);
	if ($data == '0') {
		print_r($data);
	}
	else{
		foreach ($data->result() as  $value) {
			$arr[] = $value;
		}
		echo json_encode($arr);				
	}  	
  }

  function insert_scrap(){
	$data = $_POST;
	$data['reporte'] = $this->usuario->insert_scrap($data);
	echo json_encode($data);  	
  }

    function getIdHr(){
	$data = $_POST;
	$data = $this->usuario->getIdHr($data);
	if ($data == '0') {
		print_r($data);
	}
	else{
		foreach ($data->result() as  $value) {
			$arr[] = $value;
		}
		echo json_encode($arr);				
	}  	
  }

  function insert_tiempo(){
	$data = $_POST;
	$data['reporte'] = $this->usuario->insert_tiempo($data);
	echo json_encode($data);  	
  }  


  function showDataTiempo(){
	$data = $_POST;
		$data = $this->usuario->showDataTiempo($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  	  	
  }

  function insert_tiempo_muerto(){
	$data = $_POST;
	$data['reporte'] = $this->usuario->insert_tiempo_muerto($data);
	echo json_encode($data);  	
  } 

  function getDashEficiencia(){
	$data = $_POST;
		$data = $this->usuario->getDashEficiencia($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  	  	
  }



  function getDashTiempo(){
	$data = $_POST;
		$data = $this->usuario->getDashTiempo($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  	  	
  }  

  function getDashScrap(){
	$data = $_POST;
		$data = $this->usuario->getDashScrap($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  	  	
  }  
function getEficienciaRRmes(){
		$data = $this->usuario->dashboard_eficienciaMaquinaMes();
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  	  	
  }

  function getEficienciaAZmes(){
		$data = $this->usuario->dashboard_eficienciaMaquinaMesAZ();
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  	  	
  }


  function getEficienciaDetalle(){
		$data = $_POST;
		$data = $this->usuario->dashboard_eficienciaMaquina($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  	
  }


  function getEficienciaDetalleDia(){
  			$data = $_POST;
		$data = $this->usuario->getEficienciaDetalleDia($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  
  }


  function eficienciaDiaria(){
		$data = $_POST;
		$data = $this->usuario->eficienciaDiaria($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  
  }


  function minutosTM(){
		$data = $_POST;
		$data = $this->usuario->minutosTM($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  
  }

  
  function showSrapTable(){
		$data = $_POST;
		$data = $this->usuario->showSrapTable($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  
  }
  
  function showEficienciaTable(){
		$data = $_POST;
		$data = $this->usuario->showEficienciaTable($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  
  }  
  
  function showTiempoTable(){
		$data = $_POST;
		$data = $this->usuario->showTiempoTable($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  
  } 
  
  function showProduccionTable(){
		$data = $_POST;
		$data = $this->usuario->showProduccionTable($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  
  }

	function get_produccion(){
		$data = $_POST;
		$data = $this->usuario->get_produccion($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		} 
	}
	
	function get_produccion_data(){
		$data = $_POST;
		$data = $this->usuario->get_produccion_data($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		} 
	}

	function updProductionData(){
		$data = $_POST;
		$data = $this->usuario->updProductionData($data);
	}
	
	function deleteProductionData(){
		$data = $_POST;
		$data = $this->usuario->deleteProductionData($data);
	}

  /*function getDashEficienciaGraph(){
 	$data = $_POST;
		$data = $this->usuario->getDashEficienciaGraph($data);
		if ($data == '0') {
			print_r($data);
		}
		else{
			foreach ($data->result() as  $value) {
				$arr[] = $value;
			}
			echo json_encode($arr);				
		}  	
  }*/





}
?>