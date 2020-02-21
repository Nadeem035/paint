<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painter extends CI_Controller {

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
		$data['ser'] = $this->model->get_all_category();
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
			redirect('painter/dashboard');
			return;
		}
		$data['title'] = 'Login';
		$this->template_login('painter/login', $data);
	}
	public function signup()
	{
		if (isset($_SESSION['painter']))
		{
			redirect('index');
			return;
		}
		$data['title'] = 'Sign Up';
		$data['cat'] = $this->model->get_all_category();
		$this->template_login('painter/signup', $data);
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
		if ($this->model->check_painter($_POST['email'])) {
			echo json_encode(array("status" => false, "msg" => "This Email Already Exist"));
			return;
		}elseif ($_POST){
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
		if (isset($_SESSION['painter']))
		{
			redirect('painter/dashboard');
			return;
		}
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
		if ($user['package_id'] < 1 ) {
			redirect('painter/package');
		}
		$data['user'] = $user;
		$data['package'] = $this->model->get_package_byid($user['package_id']);
		$data['count'] = $this->model->get_count_lead_by_painter($user['painter_id']);
		$data['total'] = $this->model->count_lead_painter($user['painter_id']);
		$data['pay'] = $this->model->count_trasaction_painter($user['painter_id']);
		$this->template('painter/dashboard', $data);
	}
	public function package()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['package'] = $this->model->get_all_package();
		$data['count'] = $this->model->get_count_lead_by_painter($user['painter_id']);
		$this->template('painter/package', $data);
	}
	public function transactions()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['transactions'] = $this->model->get_transactions_by_paiterid($user['painter_id']);
		$this->template('painter/transaction', $data);
	}
	public function package_purchase()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$d['package_id'] = $_POST['package_id'];
		unset($_POST['package_id']);
		$_POST['painter_id'] = $user['painter_id'];
		$_POST['status'] = 'credit';
		if ($this->model->update('painter', $d, array('painter_id' => $user['painter_id']))) {
			if ($this->model->insert('transaction', $_POST)) {
				redirect('painter/dashboard?msg=You Are Successfully Paid');
			}
		}else{
			redirect('painter/package?msg=Something Went Wrong');
		}
	}
	public function change_password()
	{
		$user = $this->check_login();
		$data['count'] = $this->model->get_count_lead_by_painter($user['painter_id']);
		$this->template('painter/package', $data);
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
				if ($this->model->update('painter', $_POST, array('painter_id' => $user['painter_id']))) {
					echo json_encode(array("status"=>true));
				}else{
					echo json_encode(array("status"=>false, "msg"=> "Something Went Wrong While Updating Passowrd."));
				}
			}else{
				echo json_encode(array("status"=>false, "msg"=> "New And Confirm Passowrd Not Matched "));
			}
		}else{
			echo json_encode(array("status"=>false, "msg"=> "Previous Passowrd Not Matched "));
		}
	}
	public function account_setting()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['count'] = $this->model->get_count_lead_by_painter($user['painter_id']);
		$data['cat'] = $this->model->get_all_category();

		$this->template('painter/account', $data);
	}
	public function change_account_setting(){
		$user = $this->check_login();
		$data = array();
		parse_str($_POST['data'],$data);
		$_POST = $data;
		$_POST['services'] =  implode(',', $_POST['services']);
		if ($this->model->update('painter', $_POST, array('painter_id' => $user['painter_id']))) {
			$data = $this->model->get_painter_byid($user['painter_id']);
			echo json_encode(array("status"=>true, "msg"=> "Successfully Updated", "data" => $data));
		}else{
			echo json_encode(array("status"=>false, "msg"=> "Something Went Wrong"));
		}
	}
	public function leads($arg = '')
	{
		$user = $this->check_login();
		if ($arg == '') {
			$data['leads'] = $this->model->get_lead_by_painter($user['painter_id']);
		}else{
			$data['leads'] = $this->model->get_lead_by_painter_status($user['painter_id'], $arg);
			$data['status'] = $arg;
		}
		$data['count'] = $this->model->get_count_lead_by_painter($user['painter_id']);
		$this->template('painter/leads', $data);
	}	
	public function get_signle_lead()
	{
		$data = $this->model->get_painter_lead_byid($_POST['id']);
		$services = $this->model->get_cat_by_id($data['services']);
		$html = '';
		$html .= '<tr>';
        	$html .= '<td>'.$data['lead_id'].'</td>';
        	$html .= '<td>'.$data['name'].'</td>';
        	$html .= '<td>'.$data['phone'].'</td>';
        	$html .= '<td>'.$data['country'].'</td>';
        	$html .= '<td>'.$services.'</td>';
        	$html .= '<td>'.$data['pl_status'].'</td>';
        	$html .= '<td>'.$data['note'].'</td>';
		$html .= '</tr>';
		echo json_encode(array('status'=> true, 'data'=> $html));
	}
	public function update_lead_status()
	{
		$user = $this->check_login();
		$id = $_POST['id'];
		unset($_POST['id']);
		if ($this->model->update('painter_lead', $_POST, array('painter_lead_id'=> $id))) {
			redirect('painter/leads?Successfully Updated');
		}else{
			redirect('painter/leads?Error Found');
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
			redirect('painter/logout');
		}
	}
	public function test()
	{
		die;
		$query = $this->db->query('UPDATE `phase` SET `count`=`count`+1 WHERE `phase_id` = 1');
	}
	public function filter_search()
	{
		$user = $this->check_login();
		$action = $_POST['action'];
		$data = array();
		parse_str($_POST['data'],$data);
		$_POST = $data;
		if ($_POST) {
			if ($action == 'transaction') {
				$result = $this->model->filter_by_date_paiter($_POST['min-date'],$_POST['max-date'], $action, $user['painter_id']);
				$html = '';
				foreach ($result as $key => $q) {
					$html .= '<tr>';
						$html .= '<td>'.$q['transaction_id'].'</td>';
                        $html .= '<td>'.$q['amount'].'</td>';
                        $html .= '<td>'.date('d-m-Y',strtotime($q['at'])).'</td>';
                        $html .= '<td>'.$q['status'].'</td>';
                    $html .= '</tr>';
				}
				echo json_encode(array("status" => true, "rec" => $html));
			}elseif ($action == 'lead') {
				$result = $this->model->filter_by_date_paiter($_POST['min-date'],$_POST['max-date'], $user['painter_id']);
				$html = '';
				foreach ($result as $key => $q) {
					$html .= '<tr>';
						$html .= '<td>'.$q['lead_id'].'</td>';
                        $html .= '<td>'.$q['name'].'</td>';
                        $html .= '<td>'.$q['phone'].'</td>';
                        $html .= '<td>'.$q['services'].'</td>';
                        $html .= '<td>'.$q['p_name'].'</td>';
                        $html .= '<td>'.$q['pl_status'].'</td>';
                        $html .= '<td>'.$q['note'].'</td>';
                        $html .= '<td>'.date('d-m-Y',strtotime($q['l_at'])).'</td>';
                        $html .= '<td class="actions" align="center">';
                            $html .= '<a href="javascript://" data-painter-id="'.$q['painter_lead_id'].'" data-id="'.$q['lead_id'].'" data-name="'.$q['name'].'" data-toggle="modal" data-target="#myModal" class="update-lead btn btn-primary" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
                            $html .= '<a href="javascript://" data-painter-id="'.$q['painter_lead_id'].'" data-id="'.$q['lead_id'].'" data-name="'.$q['name'].'" data-toggle="modal" data-target="#myshow" class="show-lead btn btn-warning" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></a>';
                        $html .= '</td>';
                    $html .= '</tr>';
				}
				echo json_encode(array("status" => true, "rec" => $html));
			}
		}
	}

}
