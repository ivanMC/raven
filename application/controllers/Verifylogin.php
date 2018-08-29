<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('usuario','',TRUE);
	}

	function index()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('usuario', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('librerias');
			$this->load->view('login_view');
		}else{
			redirect('home','refresh');
		}
	}

	function check_database($password)
	{
		$username = $this->input->post('usuario');

		$result = $this->usuario->login($username,$password);

		if ($result) {
			$sess_array = array();
			foreach ($result as $row) {
				$sess_array = array(
					'id_empleado' => $row->id_empleado,
					'num_empleado' => $row->num_empleado,
					'nombre' => $row->nombre,
					'departamento' => $row->departamento,
					'empresa'	=> $row->empresa
				);
				$this->session->set_userdata('logged_in',$sess_array);
			}
			return TRUE;
		}else{
			$this->form_validation->set_message('check_database', 'Usuario o Contraseña Incorrectas');
			return false;
		}

	}

}

?>