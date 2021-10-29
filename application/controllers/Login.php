<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public $data;
	public $viewsConfig;

	function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->viewsConfig = $this->config->item('views');
	}

	public function index()
	{
		if($this->session->userdata('user')){
			redirect('dashboard');
		}
		$this->data['view'] = loadTemplateConfig($this->viewsConfig, 'login');
		$this->load->view('common/template', $this->data);
	}

	public function forgotpass()
	{
		$this->data['view'] = loadTemplateConfig($this->viewsConfig, 'forgotpassword');
		$this->load->view('common/template', $this->data);
	}

	public function register()
	{

		$this->data['view'] = loadTemplateConfig($this->viewsConfig, 'register');
		$this->load->view('common/template', $this->data);
	}

	function validateLogin()
	{
		$username = $this->input->post('email');
		//$username = 'shridattz@gmail.com';
		$password = $this->input->post('password');
		//$password = 'password';
		//var_dump($username);die;

		$user = $this->user->validateUser($username, $password);
		if (!empty($user)) {
			$data = array(
				"details" => $user,
				"is_logged_in" => true
			);
			$this->session->set_userdata('user',$data);
			echo json_encode(array('success' => true, "redirect"=> site_url('dashboard')));
		} else {
			echo json_encode(array('success' => false));
		}
	}

	function createUser()
	{
		$user = array ( 
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password'))
		);
		$result = $this->user->create($user);
		if (isset($result)) {
			echo json_encode(array('success' => true, "redirect"=> site_url('login')));
		} else {
			echo json_encode(array('success' => false));
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}

}
