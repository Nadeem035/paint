<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hildes extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	**/

	public function __construct()
	{
	        parent::__construct();
	        error_reporting(0);
	        $this->load->database();
	        $this->load->model('Model_functions','model');
	        $this->load->helper(array('form', 'url'));
	        $this->load->library('session');
	}

	/**
	*

		@HATH NA LAIE

	*
	*/
	public function template($page = '', $data = '')
	{
		$this->load->view('header',$data);
		$this->load->view($page,$data);
		$this->load->view('footer',$data);
	}
	public function template_login($page = '', $data = '')
	{
		$this->load->view('header_login',$data);
		$this->load->view($page,$data);
		$this->load->view('footer_login',$data);
	}

	/**
	@Login Randi-Rona

	*/
	
	public function login()
	{
		if (isset($_SESSION['painter']))
		{
			redirect('dashboard');
			return;
		}
		$data['title'] = 'Login';
		$this->template_login('login', $data);
	}
	public function signup()
	{
		if (isset($_SESSION['painter']))
		{
			redirect('index');
			return;
		}
		$data['title'] = 'Sign Up';
		$this->template_login('signup', $data);
	}
	public function process_login()
	{
		$data = array();
		parse_str($_POST['data'],$data);
		$_POST = $data;
		if ($_POST)
		{
			$email = $_POST['email'];
			$password = md5($_POST['password']);

			$resp = $this->model->get_row("SELECT * FROM `painter` WHERE `email` = '$email' AND `password` =  '$password';");
			if ($resp)
			{
				$_SESSION['painter'] = serialize($resp);
				echo json_encode(array("status" => true, "msg" => "Successfully Login"));
				return;
			}
			else
			{
				echo json_encode(array("status" => false, "msg" => "Email / Passowrd Not Matched"));
				return;
			}
		}
		else
		{
			echo json_encode(array("status" => false, "msg" => "error Found"));
		}
	}
	public function process_signup()
	{
		$data = array();
		parse_str($_POST['data'],$data);
		$_POST = $data;
		if ($_POST)
		{
			$_POST['password'] = md5($_POST['password']);
			$_POST['services'] = implode(',', $_POST['services']);
		 	if ($this->model->insert('painter', $_POST)) {
		 		$resp = $this->model->get_row("SELECT * FROM `painter` WHERE `email` = '".$_POST['email']."'  AND `password` =  '".$_POST['password']."';");
		 		if ($resp) {
			 		$_SESSION['painter'] = serialize($resp);
			 		echo json_encode(array("status" => true, "msg" => "Signup Successfully"));
		 		}else{
		 			echo json_encode(array("status" => false, "msg" => "error found"));
		 		}
		 	}else{
		 		echo json_encode(array("status" => false, "msg" => "Something Went Wrong Try Again Later "));
		 	}
		}
		else
		{
			echo json_encode(array("status" => false, "msg" => "Error"));
		}
	}

	public function check_login()
	{
		if(isset($_SESSION['painter']) && $_SESSION['painter']!= "")
		{
			$user = unserialize($_SESSION['painter']);
			$email = $user['email'];
			$password = $user['password'];
			$resp = $this->model->get_row("SELECT * FROM `painter` WHERE `email` = '$email'   AND `password` =  '$password'");
			if ($resp)
			{
				$_SESSION['painter'] = serialize($resp);
				return $user;
			}
			else
			{
				redirect('index');
			}
		}
		else
		{
			redirect('index');
		}
	}
	public function logout()
	{
		unset($_SESSION['painter']);
		redirect("index");
	}
	/**
	@Login Ajax
	*/
	
	public function index()
	{
		// $user = $this->check_login();
		$this->template('index', $data);
	}
	public function search()
	{
		if (isset($_GET['key']) && strlen($_GET['key']) > 0) {
			$data['products'] = $this->model->get_all_active_products_search($_GET['key']);
				$this->template('search', $data);
		}
		else{
			redirect('index');
		}
	}
	public function dashboard()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$this->template('dashboard', $data);
	}
	public function change_password()
	{
		$user = $this->check_login();
		$this->template('change_password', $data);
	}
	public function change_account_setting(){
		$user = $this->check_login();
		$data = array();
		parse_str($_POST['data'],$data);
		$_POST = $data;
		$data['shipping'] = $this->model->get_shipping_charges(1);// 
		if ($this->model->update('shop', $_POST, array('shop_id' => $user['shop_id']))) {
			$data = $this->model->get_shop_all_by_id($user['shop_id']);
			echo json_encode(array("status"=>true, "data"=> $data));
		}else{
			echo json_encode(array("status"=>false, "msg"=> "Something Went Wrong"));
		}
	}
	public function change_account_password(){
		$user = $this->check_login();
		$data = array();
		parse_str($_POST['data'],$data);
		$_POST = $data;

		if (md5($_POST['password']) == $user['password']) {
			if ($_POST['new-password'] == $_POST['confirm-password']) {
				unset($_POST['password']);
 				$_POST['password'] = md5($_POST['new-password']);
				unset($_POST['new-password']);
				unset($_POST['confirm-password']);
				if ($this->model->update('shop', $_POST, array('shop_id' => $user['shop_id']))) {
					echo json_encode(array("status"=>true));
				}else{
					echo json_encode(array("status"=>false, "msg"=> "Passowrd Not Matched "));
				}
			}else{
				echo json_encode(array("status"=>false, "msg"=> "Passowrd Not Matched "));
			}
		}else{
			echo json_encode(array("status"=>false, "msg"=> "Passowrd Not Matched "));
		}
	}







	public function ajax()
	{
		$user = $this->check_login();
		$config['upload_path'] = 'uploads/';
    	$config['allowed_types'] = 'gif|jpg|png|PNG|JPEG|JPG';
    	$config['encrypt_name'] = TRUE;
    	$ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
		$new_name = md5(time().$_FILES['upload']['name']).'.'.$ext;
		$config['file_name'] = $new_name;
    	$this->load->library('upload', $config);
    	if ($this->upload->do_upload('upload'))
    	{
        	$name = $this->upload->data()['file_name'];
    	}
    	echo UPLOADS.$name;
	}

	/**
	*

	@AJAX PHOTO
		
	*
	*/

	public function post_photo_ajax()
	{
		// $user = $this->check_login();
		if ($_FILES){
			$config['upload_path'] = 'uploads/';
        	$config['allowed_types'] = 'gif|jpeg|jpg|png|PNG|JPEG|JPG|GIF';
        	$config['encrypt_name'] = TRUE;
        	$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
			$new_name = md5(time().$_FILES['img']['name']).'.'.$ext;
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
        	if ($this->upload->do_upload('img'))
        	{
	        	$img = $this->upload->data()['file_name'];
	        	echo json_encode(array("status"=>true,"img"=>$img));
        	}
        	else{
        		#error
	        	echo json_encode(array("status"=>false));
        	}

		}
		else{
			redirect('logout');
		}
	}
	public function test()
	{
		die;
		$query = $this->db->query('UPDATE `phase` SET `count`=`count`+1 WHERE `phase_id` = 1');
	}

}
