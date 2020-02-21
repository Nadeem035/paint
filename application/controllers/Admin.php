<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	 */

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
		if (isset($_SESSION['admin']))
		{
			$data['admin'] = unserialize($_SESSION['admin']);
			$data['login'] = true;
		}
		else
		{
			$data['login'] = false;
		}
		$this->load->view('admin/header',$data);
		$this->load->view($page,$data);
		$this->load->view('admin/footer',$data);
	}
	public function login_template($page = '', $data = '')
	{
		if (isset($_SESSION['admin']))
		{
			$data['admin'] = unserialize($_SESSION['admin']);
			$data['login'] = true;
		}
		else
		{
			$data['login'] = false;
		}
		$this->load->view('admin/new_login_header',$data);
		$this->load->view($page,$data);
		$this->load->view('admin/new_login_footer',$data);

	}


	// Export data in CSV format 
	public function exportCSV($arg =''){
		if ($arg =='orders') {
			$data = $this->model->get_order();
		}elseif ($arg == 'shops') {
			$data = $this->model->get_all_shops();
		}elseif ($arg == 'users') {
			$data = $this->model->get_all_user();
		}elseif ($arg == 'products') {
			$data = $this->model->get_all_products();
		}elseif ($arg == 'pending_transaction') {
			$data = $this->model->get_all_shops_pending_transaction();
		}elseif ($arg == 'transaction_history') {
			$data = $this->model->get_all_transactions();
		}elseif ($arg == 'admin_profit') {
			$data = $this->model->get_all_admin_profit();
		}else{
			return;
		}
		// get data 
		$filename = 'file_'.date('Ymdhis').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv;");

		// file creation 
		$file = fopen('php://output', 'w');

		$header = array_keys($data[0]); 
		fputcsv($file, $header);
		foreach ($data as $key=>$line){ 
			fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
	}

	/**
	
	@Login Randi-Rona

	*/
	
	public function login()
	{
		if (isset($_SESSION['admin']))
		{
			redirect('admin/index');
			return;
		}
		$data['title'] = 'Login';
		$this->login_template('admin/signin', $data);
	}
	public function check_login()
	{
		if(isset($_SESSION['admin']) && $_SESSION['admin']!= "")
		{
			$user = unserialize($_SESSION['admin']);
			$username = $user['username'];
			$password = $user['password'];
			$resp = $this->model->get_row("SELECT * FROM `admin` WHERE `username` = '$username'  AND `password` =  '$password'");
			if ($resp)
			{
				return $user;
			}
			else
			{
				redirect('admin/login');
			}
		}
		else 
		{
			redirect('admin/login');
		}
	}
	public function change_password()
	{
		$user = $this->check_login();
		$data['signin'] = FALSE;
		$username = $user['username'];
		if (isset($_POST['password']) && strlen($_POST['password']) > 0 && isset($_POST['re_password']) && strlen($_POST['re_password']) > 0) 
		{
			$password = md5($_POST['password']);
			$re_password = md5($_POST['re_password']);
			if ($password === $re_password) 
			{
				if ($this->model->update('admin', array("password"=>$password), array("username"=>$username))) 
				{
					redirect("admin/logout");
				}
			}
			else
			{
				redirect("admin/change_password?error=1&msg='Your Provided Passwords are not matched, please try with correct password'");
			}
		}
		$data['username'] = $username;
		$this->template("admin/change_password", $data);
	}

	public function logout()
	{
		unset($_SESSION['admin']);
		redirect("admin/login");
	}
	/**
	@Login Ajax
	*/
	public function process_login()
	{
		if ($_POST)
		{
			$username = $_POST['username'];
			$password = md5($_POST['password']);

			$resp = $this->model->get_row("SELECT * FROM `admin` WHERE `username` = '$username'  AND `password` =  '$password';");
			if ($resp)
			{
				$_SESSION['admin'] = serialize($resp);
				redirect('admin/index');
				return;
			}
			else
			{
				redirect('admin/login');
				return;
			}
		}
		else
		{
			redirect('admin');
		}
	}
	public function site_process()
	{
		if ($_POST)
		{
			$sid = $_POST['sid'];
			$resp = $this->model->get_row("SELECT * FROM `sites` WHERE `sid` = '$sid';");
			if ($resp)
			{
				$_SESSION['site_sid'] = serialize($resp);
				redirect('admin/index');
				return;
			}
			else
			{
				redirect('admin/login');
				return;
			}
		}
		else
		{
			redirect('admin/login');
		}
	}
	public function auto_login()
	{
		if ($_GET)
		{
			$data = $_GET;

			$email = $data['email'];
			$password = $data['password'];

			$result = $this->db->query("SELECT * FROM `user` WHERE `email` = '$email'  AND `password` =  '$password' LIMIT 1;");
			if ($result->num_rows() > 0)
			{
				$row = $result->row();
				$user['id'] =  $row->user_id;
				$user['email'] =  $row->email;
				$user['mobile'] =  $row->mobile;
				$user['password'] =  $row->password;
				$user['fname'] =  $row->fname;
				$user['lname'] =  $row->lname;
				$user['gander'] =  $row->gander;
				$user['dob'] =  $row->dob;
				$user['country'] =  $row->country;
				$user['city'] =  $row->city;
				$user['address'] =  $row->address;
				$user['img'] =  $row->img;
				$user['about'] =  $row->about;
				$user['email_verify'] =  $row->email_verify;
				$user['status'] =  $row->status;
				$user['admin_block'] =  $row->admin_block;
				$_SESSION['admin'] = serialize($user);
				redirect('admin/index');
				return;
			}
			else
			{
				redirect('login');
				return;
			}
		}
		else
		{
			redirect('index');
		}
	}
	public function submit_signin()
	{
		$data = array();
		parse_str($_POST['data'], $data);

		$email = $data['email'];
		$password = md5($data['password']);
		$user = $this->model->user_login($email, $password);
		if ($user)
		{
			$_SESSION['admin'] = serialize($user);
			echo json_encode(array("status"=>'true'));
		}
		else
		{
			echo json_encode(array("status"=>'false'));
		}
	}
	public function submit_signup()
	{	
		$data = array();
		parse_str($_POST['data'], $data);
		$email = $data['email'];
		$phone = $data['phone'];

		
		$VEmail = $this->db->query("SELECT `email` FROM `user` WHERE `email` = '$email' LIMIT 1");
		if ($VEmail->num_rows() > 0)
		{
			echo json_encode(array('status'=>false, 'title'=>'email'));
		}
		
		else
		{
			// $password = $data['password'];
			// $data['email_verify_code'] = md5(md5($data['password']).md5($data['email']));
			$data['password'] = md5($data['password']);
			$resp = $this->db->insert('user', $data);
			//$insert_id = $this->db->insert_id();
			
			$user = $this->model->get_user_byid($this->db->insert_id());

			$setting['user_id'] = $user[0]['user_id'];
			$resp = $this->db->insert('user_setting', $setting);

			$setting['country'] = $data['country'];
			$setting['state'] = $data['state'];
			$setting['city'] = $data['city'];

			$setting['banner_country'] = $data['country'];
			$setting['banner_state'] = $data['state'];
			$setting['banner_city'] = $data['city'];
			$resp = $this->db->insert('agency', $setting);
			
			$owner['user_id'] = $user[0]['user_id'];
			$resp = $this->db->insert('owner', $owner);	

			$_SESSION['admin'] = serialize($user);
			echo json_encode(array("status"=>true,"type"=>$data['user_type']));
		
		}
	}
	

	/***************************************
	*	callling main index function here 
	****************************************/
	public function dashboard()
	{
		$this->index();
	}

	public function index()
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		$data['cat'] = $this->model->count_cat();
		$data['painter'] = $this->model->count_painter();
		$data['affiliate'] = $this->model->count_affiliate();
		$data['worker'] = $this->model->count_worker();
		$data['package'] = $this->model->count_package();
		$data['lead'] = $this->model->count_lead();
		$data['income'] = $this->model->count_income();
		$data['debit'] = $this->model->count_debit();
		$data['all_package'] = $this->model->get_all_package();
		$data['package_lead'] = $this->model->count_package_lead();
		$data['total'] = $this->model->count_total_admin();

		// $data['cat'] = $this->model->count_cat();
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/dashboard', $data);
	}
	public function cat()
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		$data['cat'] = $this->model->get_all_category();
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/cat', $data);
	}
	public function painters($arg = '')
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		if ($arg == '') {
			$data['painters'] = $this->model->get_all_painter();
		}else{
			$data['painters'] = $this->model->get_all_painter_by_status($arg);
		}
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/painters', $data);
	}
	public function affiliates($arg = '')
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		if ($arg == '') {
			$data['affiliates'] = $this->model->get_all_affiliate();
		}else{
			$data['affiliates'] = $this->model->get_all_affiliate_by_status($arg);
		}
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/affiliates', $data);
	}
	public function workers($arg = '')
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		if ($arg == '') {
			$data['workers'] = $this->model->get_all_worker();
		}else{
			$data['workers'] = $this->model->get_all_worker_by_status($arg);
		}
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/workers', $data);
	}
	public function leads($arg = '')
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		if ($arg == '') {
			$data['leads'] = $this->model->get_all_lead();
		}else{
			$data['leads'] = $this->model->get_all_lead_by_status($arg);
		}
		$data['package'] = $this->model->get_all_package();
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/leads', $data);
	}
	public function transactions($arg = '')
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		if ($arg == '') {
			$data['transactions'] = $this->model->get_all_transactions();
		}else{
			$data['transactions'] = $this->model->get_all_transactions_by_status($arg);
		}
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/transactions', $data);
	}
	public function assign_package()
	{
		$lead = $this->model->get_lead_byid($_POST['id']);
		$id = $_POST['id'];
		unset($_POST['id']);
		$_POST['status'] = 'valid';
		if ($this->model->update('lead', $_POST, array('lead_id'=>$id))) {
			$l = $this->model->get_lead_package($id);
			$painters = $this->model->get_all_painter_by_package($_POST['package_id']);
			$new['lead_id'] = $id; 
			foreach ($painters as $key => $p) {
				$new['painter_id'] = $p['painter_id'];  
				$this->model->insert('painter_lead', $new);
			}
			if ($l['affiliate_id'] > 0) {
				$ID = $l['affiliate_id'];
				$af = $this->model->get_affiliate_byid($l['affiliate_id']);
				$amount = $l['price'] * $af['profit'] / 100;
				$this->db->query("UPDATE `affiliate` SET `pending_amount`=`pending_amount`+ '$amount' WHERE `affiliate_id` = '$ID'");
			}
			redirect('admin/leads?msg=Successfully Updated');
		}else{
			redirect('admin/leads?msg=Not Updated');
		}
	}
	public function packages()
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['mode'] = "edit";
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		$data['packages'] = $this->model->get_all_package();
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/package', $data);
	}
	public function slider()
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		$data['slides'] = $this->model->get_all_slides();
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/slider', $data);
	}
	/**********************************************
	*	starting Add functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo 	************************************************/
	public function add_cat()
	{
		$user = $this->check_login();
		$data['title'] = 'Add Category';
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/add_cat', $data);
	}
	public function add_worker()
	{
		$user = $this->check_login();
		$data['title'] = 'Add Worker';
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/add_worker', $data);
	}
	public function add_lead()
	{
		$user = $this->check_login();
		$data['title'] = 'Add Lead';
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		$data['cat'] = $this->model->get_all_category();
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/add_lead', $data);
	}
	public function add_package()
	{
		$user = $this->check_login();
		$data['title'] = 'Add Package';
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/add_package', $data);
	}
	public function add_slide()
	{
		$user = $this->check_login();
		$data['title'] = 'Add Slide';
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];

		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template("admin/add_slide", $data);
	}

	/**********************************************
	*	starting insert functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo 	************************************************/
	public function post_cat()
	{
		$user = $this->check_login();
		if ($this->model->check_cat($_POST['name'])) {
			redirect("admin/cat?msg=Category Already Exist");
		}
		$_POST['slug'] = strtolower(str_replace(' ', '_', $_POST['name']));
		$this->model->insert("category", $_POST);
		redirect("admin/cat?msg=Category Added!");
	}
	public function post_worker()
	{
		$user = $this->check_login();
		if ($this->model->check_worker($_POST['email'])) {
			redirect("admin/workers?msg=worker Already Exist");
		}
		$_POST['password'] =  md5($_POST['password']);
		$this->model->insert("worker", $_POST);
		redirect("admin/workers?msg=worker Added!");
	}
	public function post_lead()
	{
		$user = $this->check_login();
		$_POST['services'] =  implode(',', $_POST['services']);
		$this->model->insert("lead", $_POST);
		redirect("admin/leads?msg=Lead Added!");
	}
	public function post_package()
	{
		$user = $this->check_login();
		if ($this->model->check_package($_POST['name'])) {
			redirect("admin/packages?msg=Package Already Exist");
		}
		$this->model->insert("package", $_POST);
		redirect("admin/packages?msg=Package Added!");
	}
	public function post_slide()
	{
		$user = $this->check_login();
		if (strlen($_POST['link']) == 0 && $_POST['link'] == '') {
			unset($_POST['link']);
		}
		$this->model->insert("slider", $_POST);
		redirect("admin/slider?msg=Slide Added!");
	}

	/**********************************************
	*	starting edit functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo
	************************************************/
	public function edit_cat()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			err("Wrong Category ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_category_byid($new_id);
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			// $data['user'] = $user;
			$this->template('admin/add_cat', $data);
		}
	}
	public function edit_affiliate()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			err("Wrong Affiliate ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_affiliate_byid($new_id);
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			// $data['user'] = $user;
			$this->template('admin/add_affiliate', $data);
		}
	}
	public function edit_worker()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			err("Wrong Worker ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_worker_byid($new_id);
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			// $data['user'] = $user;
			$this->template('admin/add_worker', $data);
		}
	}
	public function setting()
	{
		$user = $this->check_login();
		$data['q'] = $this->model->get_all_settings();
		$data['mode'] = "edit";
		$data['signin'] = FALSE;
		$this->template('admin/setting', $data);
		
	}
	public function edit_package()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			err("Wrong Package ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_package_byid($new_id);
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			// $data['user'] = $user;
			$this->template('admin/add_package', $data);
		}
	}	
	public function edit_lead()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			err("Wrong Lead ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_lead_byid($new_id);
			$data['cat'] = $this->model->get_all_category();
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			// $data['user'] = $user;
			$this->template('admin/add_lead', $data);
		}
	}
	public function edit_slide()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			err("Wrong Slide ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_slide_byid($new_id);
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			// $data['user'] = $user;
			$this->template("admin/add_slide", $data);
		}
	}

	/**********************************************
	*	starting update functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo 	
	************************************************/	
	public function update_cat()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$_POST['slug'] = strtolower(str_replace(' ', '_', $_POST['name']));
		$data = $this->model->update("category", $_POST, array("category_id"=>$aid));
		if($data)
		{
			redirect("admin/cat?msg=Edited Category");
		}
		else
		{
			redirect("admin/cat?error=1&msg=Error occured while Editing Category");
		}
	}
	public function update_affiliate()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$data = $this->model->update("affiliate", $_POST, array("affiliate_id"=>$aid));
		if($data)
		{
			redirect("admin/affiliates?msg=Edited Affiliate");
		}
		else
		{
			redirect("admin/affiliates?error=1&msg=Error occured while Editing Affiliate");
		}
	}
	public function update_setting()
	{
		$user = $this->check_login();
		$aid = '1';
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$data = $this->model->update("setting", $_POST, array("setting_id"=>$aid));
		if($data)
		{
			$this->model->update("affiliate", $_POST, array());
			redirect("admin/setting?msg=Edited setting");
		}
		else
		{
			redirect("admin/setting?error=1&msg=Error occured while Editing setting");
		}
	}
	public function update_worker()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$data = $this->model->update("worker", $_POST, array("worker_id"=>$aid));
		if($data)
		{
			redirect("admin/workers?msg=Edited Worker");
		}
		else
		{
			redirect("admin/workers?error=1&msg=Error occured while Editing Worker");
		}
	}
	public function update_package()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$data = $this->model->update("package", $_POST, array("package_id"=>$aid));
		if($data)
		{
			redirect("admin/packages?msg=Edited Package");
		}
		else
		{
			redirect("admin/packages?error=1&msg=Error occured while Editing Package");
		}
	}
	public function update_lead()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$_POST['services'] =  implode(',', $_POST['services']);
		$data = $this->model->update("lead", $_POST, array("lead_id"=>$aid));
		if($data)
		{
			redirect("admin/leads?msg=Edited Lead");
		}
		else
		{
			redirect("admin/leads?error=1&msg=Error occured while Editing Lead");
		}
	}
	public function update_slide()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$data = $this->model->update("slider", $_POST, array("slider_id"=>$aid));
		if($data)
		{
			redirect("admin/slider?msg=Edited Slide");
		}
		else
		{
			redirect("admin/slider?error=1&msg=Error occured while Editing Slide");
		}
	}
	/**********************************************
	*	starting delete functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo 	
	************************************************/
	public function delete_cat()
	{
		$user = $this->check_login();
		if($this->model->delete("category", array("category_id"=>$_GET['cat_id'])))
		{
			redirect("admin/cat?msg=Category has Deleted");
		}
		else
		{
			redirect("admin/cat?error=1&msg=Category has failed to delete. Try Again!");
		}
	}
	public function delete_affiliate()
	{
		$user = $this->check_login();
		if($this->model->delete("affiliate", array("affiliate_id"=>$_GET['affiliate_id'])))
		{
			redirect("admin/affiliates?msg=Affiliate has Deleted");
		}
		else
		{
			redirect("admin/affiliates?error=1&msg=Affiliate has failed to delete. Try Again!");
		}
	}
	public function delete_worker()
	{
		$user = $this->check_login();
		if($this->model->delete("worker", array("worker_id"=>$_GET['worker_id'])))
		{
			redirect("admin/workers?msg=Worker has Deleted");
		}
		else
		{
			redirect("admin/workers?error=1&msg=Worker has failed to delete. Try Again!");
		}
	}
	public function delete_package()
	{
		$user = $this->check_login();
		if($this->model->delete("package", array("package_id"=>$_GET['package_id'])))
		{
			redirect("admin/packages?msg=Package has Deleted");
		}
		else
		{
			redirect("admin/packages?error=1&msg=Package has failed to delete. Try Again!");
		}
	}
	public function delete_lead()
	{
		$user = $this->check_login();
		if($this->model->delete("lead", array("lead_id"=>$_GET['lead_id'])))
		{
			redirect("admin/leads?msg=Lead has Deleted");
		}
		else
		{
			redirect("admin/leads?error=1&msg=Lead has failed to delete. Try Again!");
		}
	}
	public function delete_slide()
	{
		$user = $this->check_login();
		if($this->model->delete("slider", array("slider_id"=>$_GET['slider_id'])))
		{
			redirect("admin/slider?msg=Slide has Deleted");
		}
		else
		{
			redirect("admin/slider?error=1&msg=Slide has failed to delete. Try Again!");
		}
	}


	public function filter_search()
	{
		$user = $this->check_login();
		$action = $_POST['action'];
		$data = array();
		parse_str($_POST['data'],$data);
		$_POST = $data;
		if ($_POST) {
			if ($action == 'affiliate') {
				$result = $this->model->filter_by_date($_POST['min-date'],$_POST['max-date'], $action);
				$html = '';
				foreach ($result as $key => $q) {
					$html .= '<tr>';
						$html .= '<td>'.$q['affiliate_id'].'</td>';
                        $html .= '<td>'.$q['name'].'</td>';
                        $html .= '<td>'.$q['phone'].'</td>';
                        $html .= '<td>'.$q['email'].'</td>';
                        $html .= '<td>'.$q['country'].'</td>';
                        $html .= '<td>'.$q['city'].'</td>';
                        $html .= '<td>'.$q['address'].'</td>';
                        $html .= '<td>'.date('d-m-Y',strtotime($q['at'])).'</td>';
                        $html .= '<td>'.$q['status'].'</td>';
                        $html .= '<td class="actions">';
                            $html .= '<a href="'.BASEURL.'admin/edit_affiliate?id='.$q['affiliate_id'].'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>';
                            $html .= '<a href="javascript:del_q('.$q['affiliate_id'].')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>';
                        $html .= '</td>';
                    $html .= '</tr>';
				}
				echo json_encode(array("status" => true, "rec" => $html));
			}elseif ($action == 'worker') {
				$result = $this->model->filter_by_date($_POST['min-date'],$_POST['max-date'], $action);
				$html = '';
				foreach ($result as $key => $q) {
					$html .= '<tr>';
						$html .= '<td>'.$q['worker_id'].'</td>';
                        $html .= '<td>'.$q['name'].'</td>';
                        $html .= '<td>'.$q['phone'].'</td>';
                        $html .= '<td>'.$q['email'].'</td>';
                        $html .= '<td>'.$q['country'].'</td>';
                        $html .= '<td>'.$q['city'].'</td>';
                        $html .= '<td>'.$q['address'].'</td>';
                        $html .= '<td>'.date('d-m-Y',strtotime($q['at'])).'</td>';
                        $html .= '<td>'.$q['status'].'</td>';
                        $html .= '<td class="actions">';
                            $html .= '<a href="'.BASEURL.'admin/edit_worker?id='.$q['worker_id'].'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>';
                            $html .= '<a href="javascript:del_q('.$q['worker_id'].')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>';
                        $html .= '</td>';
                    $html .= '</tr>';
				}
				echo json_encode(array("status" => true, "rec" => $html));
			}elseif ($action == 'painter') {
				$result = $this->model->filter_by_date($_POST['min-date'],$_POST['max-date'], $action);
				$html = '';
				foreach ($result as $key => $q) {
					$html .= '<tr>';
						$html .= '<td>'.$q['painter_id'].'</td>';
                        $html .= '<td>'.$q['name'].'</td>';
                        $html .= '<td>'.$q['phone'].'</td>';
                        $html .= '<td>'.$q['email'].'</td>';
                        $html .= '<td>'.$q['country'].'</td>';
                        $html .= '<td>'.$q['city'].'</td>';
                        $html .= '<td>'.$q['address'].'</td>';
                        $html .= '<td>'.date('d-m-Y',strtotime($q['at'])).'</td>';
                        $html .= '<td>'.$q['status'].'</td>';
                        $html .= '<td class="actions">';
                            $html .= '<a href="'.BASEURL.'admin/edit_painter?id='.$q['painter_id'].'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>';
                            $html .= '<a href="javascript:del_q('.$q['painter_id'].')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>';
                        $html .= '</td>';
                    $html .= '</tr>';
				}
				echo json_encode(array("status" => true, "rec" => $html));
			}elseif ($action == 'lead') {
				$result = $this->model->filter_by_date($_POST['min-date'],$_POST['max-date'], $action);
				$html = '';
				foreach ($result as $key => $q) {
					$html .= '<tr>';
						$html .= '<td>'.$q['lead_id'].'</td>';
                        $html .= '<td>'.$q['name'].'</td>';
                        $html .= '<td>'.$q['phone'].'</td>';
                        $html .= '<td>'.$q['services'].'</td>';
                        $html .= '<td>'.$q['status'].'</td>';
                        $html .= '<td>'.$q['invalid_reason'].'</td>';
                        $html .= '<td>'.$q['clicks'].'</td>';
                        $html .= '<td>'.date('d-m-Y',strtotime($q['at'])).'</td>';
                        $html .= '<td>';
                            $html .= '<a href="javascript://" data-toggle="modal" data-target="#myModal" class="btn btn-primary assign-package" data-id="'.$q['lead_id'].'" data-name="'.$q['name'].'" data-toggle="tooltip" data-original-title="Assign"><i class="fa fa-sign-in"></i></a>';
                        $html .= '</td>';
                        $html .= '<td class="actions">';
                            $html .= '<a href="'.BASEURL.'admin/edit_lead?id='.$q['lead_id'].'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>';
                            $html .= '<a href="javascript:del_q('.$q['lead_id'].')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>';
                        $html .= '</td>';
                    $html .= '</tr>';
				}
				echo json_encode(array("status" => true, "rec" => $html));
			}elseif ($action == 'package') {
				$result = $this->model->filter_by_date($_POST['min-date'],$_POST['max-date'], $action);
				$html = '';
				foreach ($result as $key => $q) {
					$html .= '<tr>';
						$html .= '<td>'.$q['package_id'].'</td>';
                        $html .= '<td>'.$q['name'].'</td>';
                        $html .= '<td>'.$q['detail'].'</td>';
                        $html .= '<td>'.$q['price'].'</td>';
                        $html .= '<td>'.date('d-m-Y',strtotime($q['at'])).'</td>';
                        $html .= '<td>'.$q['status'].'</td>';
                        $html .= '<td class="actions">';
                            $html .= '<a href="'.BASEURL.'admin/edit_package?id='.$q['package_id'].'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>';
                            $html .= '<a href="javascript:del_q('.$q['package_id'].')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>';
                        $html .= '</td>';
                    $html .= '</tr>';
				}
				echo json_encode(array("status" => true, "rec" => $html));
			}elseif ($action == 'category') {
				$result = $this->model->filter_by_date($_POST['min-date'],$_POST['max-date'], $action);
				$html = '';
				foreach ($result as $key => $q) {
					$html .= '<tr>';
						$html .= '<td>'.$q['category_id'].'</td>';
                        $html .= '<td>'.$q['name'].'</td>';
                        $html .= '<td>'.date('d-m-Y',strtotime($q['at'])).'</td>';
                        $html .= '<td class="actions">';
                            $html .= '<a href="'.BASEURL.'admin/edit_cat?id='.$q['category_id'].'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>';
                            $html .= '<a href="javascript:del_q('.$q['category_id'].')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>';
                        $html .= '</td>';
                    $html .= '</tr>';
				}
				echo json_encode(array("status" => true, "rec" => $html));
			}elseif ($action == 'transaction') {
				$result = $this->model->filter_by_date($_POST['min-date'],$_POST['max-date'], $action);
				$html = '';
				foreach ($result as $key => $q) {
					$html .= '<tr>';
						$html .= '<td>'.$q['transaction_id'].'</td>';
						$html .= '<td>'.$q['painter_id'].'</td>';
                        $html .= '<td>'.$q['p_name'].'</td>';
						$html .= '<td>'.$q['affiliate_id'].'</td>';
                        $html .= '<td>'.$q['a_name'].'</td>';
                        $html .= '<td>'.$q['amount'].'</td>';
                        $html .= '<td>'.date('d-m-Y',strtotime($q['at'])).'</td>';
                        $html .= '<td>'.$q['t_status'].'</td>';
                        $html .= '<td class="actions">';
                            $html .= '<a href="javascript://" class="btn btn-sm btn-icon btn-pure btn-default on-default" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-eye" aria-hidden="true"></i></a>';
                        $html .= '</td>';
                    $html .= '</tr>';
				}
				echo json_encode(array("status" => true, "rec" => $html));
			}
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
		$user = $this->check_login();
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
			redirect('admin/logout');
		}
	}
	public function post_file_ajax()
	{
		$user = $this->check_login();
		if ($_FILES){
			$config['upload_path'] = 'uploads/';
        	$config['allowed_types'] = 'xlsx|doc|XLSX|DOC|gif|jpeg|jpg|png|PNG|JPEG|JPG|GIF';
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

	public function get_signle_affiliate()
	{
		$data = $this->model->get_affiliate_byid($_POST['id']);
		$html = '';
		$html .= '<tr>';
        	$html .= '<td>'.$data['affiliate_id'].'</td>';
        	$html .= '<td>'.$data['name'].'</td>';
        	$html .= '<td>'.$data['phone'].'</td>';
        	$html .= '<td><a target="_blank" href="'.BASEURL.'lead/'.$data['link'].'">'.$data['link'].'</a></td>';
        	$html .= '<td>'.$data['pending_amount'].'</td>';
		$html .= '</tr>';
		echo json_encode(array('status'=> true, 'data'=> $html));
	}
	public function pay_affiliate(){
		$data = $this->model->get_affiliate_byid($_POST['affiliate_id']);
		$amount = $_POST['amount'];
		$id = $_POST['affiliate_id'];
		if ($amount > $data['pending_amount']) {
			redirect('admin/affiliates?msg=Amount is Greater Then Pending Amount of Affiliate: '.$data["name"]);
		}else{
			$_POST['payment_method'] = 'paypal';
			$_POST['status'] = 'debit';
			$_POST['account_info'] = $data['paypal_account'];
			if ($this->model->insert('transaction', $_POST)) {
				$this->db->query("UPDATE `affiliate` SET `pending_amount`=`pending_amount`- '$amount' WHERE `affiliate_id` = '$id'");
			}
			redirect('admin/affiliates?msg=Successfully Paid Amount To Affiliate: '.$data["name"]);
		}


	}






	/**
	*

	@AJAX
		
	*
	*/
	/*public function post_photo_ajax()
	{
		$user = $this->check_login();
		if ($_FILES){
			for ($i=0; $i < count($_FILES); $i++) { 
				$config['upload_path'] = 'uploads';
	        	$config['allowed_types'] = 'gif|jpg|png|PNG|JPEG|JPG';
	        	$config['encrypt_name'] = TRUE;
	        	$ext = pathinfo($_FILES['img'.$i]['name'], PATHINFO_EXTENSION);
				$new_name = md5(time().$_FILES['img'.$i]['name']).'.'.$ext;
				$config['file_name'] = $new_name;
	        	$this->load->library('upload', $config);
	        	if ($this->upload->do_upload('img'.$i))
	        	{
		        	$final[$i]['img'] = $this->upload->data()['file_name'];
	        	}
			}
			if (count($final) > 0) {
				echo json_encode(array("status"=>true,"data"=>$final));
			}
			else {
				echo json_encode(array("status"=>false,"data"=>'Images not uploaded, please try again or reload your webpage or check your internet connection'));
			}
		}
		else{
			redirect('logout');
		}
	}*/
}