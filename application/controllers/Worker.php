<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Worker extends CI_Controller {

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
		if (isset($_SESSION['worker']))
		{
			$data['worker'] = unserialize($_SESSION['worker']);
			$data['login'] = true;
		}
		else
		{
			$data['login'] = false;
		}
		$this->load->view('worker/header',$data);
		$this->load->view($page,$data);
		$this->load->view('worker/footer',$data);
	}
	public function login_template($page = '', $data = '')
	{
		if (isset($_SESSION['worker']))
		{
			$data['worker'] = unserialize($_SESSION['worker']);
			$data['login'] = true;
		}
		else
		{
			$data['login'] = false;
		}
		$this->load->view('worker/new_login_header',$data);
		$this->load->view($page,$data);
		$this->load->view('worker/new_login_footer',$data);

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
		if (isset($_SESSION['worker']))
		{
			redirect('worker/index');
			return;
		}
		$data['title'] = 'Login';
		$this->login_template('worker/signin', $data);
	}
	public function check_login()
	{
		if(isset($_SESSION['worker']) && $_SESSION['worker']!= "")
		{
			$user = unserialize($_SESSION['worker']);
			$username = $user['email'];
			$password = $user['password'];
			$resp = $this->model->get_row("SELECT * FROM `worker` WHERE `email` = '$username'  AND `password` =  '$password'");
			if ($resp)
			{
				return $user;
			}
			else
			{
				redirect('worker/login');
			}
		}
		else 
		{
			redirect('worker/login');
		}
	}
	public function change_password()
	{
		$user = $this->check_login();
		$data['signin'] = FALSE;
		$username = $user['email'];
		if (isset($_POST['password']) && strlen($_POST['password']) > 0 && isset($_POST['re_password']) && strlen($_POST['re_password']) > 0) 
		{
			$password = md5($_POST['password']);
			$re_password = md5($_POST['re_password']);
			if ($password === $re_password) 
			{
				if ($this->model->update('worker', array("password"=>$password), array("username"=>$username))) 
				{
					redirect("worker/logout");
				}
			}
			else
			{
				redirect("worker/change_password?error=1&msg='Your Provided Passwords are not matched, please try with correct password'");
			}
		}
		$data['username'] = $username;
		$this->template("worker/change_password", $data);
	}

	public function logout()
	{
		unset($_SESSION['worker']);
		redirect("worker/login");
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

			$resp = $this->model->get_row("SELECT * FROM `worker` WHERE `email` = '$username'  AND `password` =  '$password';");
			if ($resp)
			{
				$_SESSION['worker'] = serialize($resp);
				redirect('worker/index');
				return;
			}
			else
			{
				redirect('worker/login');
				return;
			}
		}
		else
		{
			redirect('worker');
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
		$data['username'] = $user['email'];
		$data['password'] = $user['password'];
		$data['cat'] = $this->model->get_all_category();
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('worker/cat', $data);
	}
	public function cat()
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['username'] = $user['email'];
		$data['password'] = $user['password'];
		$data['cat'] = $this->model->get_all_category();
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('worker/cat', $data);
	}
	public function painters($arg = '')
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['username'] = $user['email'];
		$data['password'] = $user['password'];
		if ($arg == '') {
			$data['painters'] = $this->model->get_all_painter();
		}else{
			$data['painters'] = $this->model->get_all_painter_by_status($arg);
		}
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('worker/painters', $data);
	}
	public function affiliates($arg = '')
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['username'] = $user['email'];
		$data['password'] = $user['password'];
		if ($arg == '') {
			$data['affiliates'] = $this->model->get_all_affiliate();
		}else{
			$data['affiliates'] = $this->model->get_all_affiliate_by_status($arg);
		}
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('worker/affiliates', $data);
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
		$this->template('worker/leads', $data);
	}
	public function assign_package()
	{
		$lead = $this->model->get_lead_byid($_POST['id']);
		$id = $_POST['id'];
		unset($_POST['id']);
		$_POST['status'] = 'valid';
		if ($this->model->update('lead', $_POST, array('lead_id'=>$id))) {
			$painters = $this->model->get_all_painter_by_package($_POST['package_id']);
			$new['lead_id'] = $id;  
			foreach ($painters as $key => $p) {
				$new['painter_id'] = $p['painter_id'];  
				$this->model->insert('painter_lead', $new);
			}
			redirect('worker/leads?msg=Successfully Updated');
		}else{
			redirect('worker/leads?msg=Not Updated');
		}
	}
	public function package()
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['mode'] = "edit";
		$data['username'] = $user['email'];
		$data['password'] = $user['password'];
		$data['q'] = $this->model->get_package_by_id(1);
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('worker/package', $data);
	}	
	/**********************************************
	*	starting Add functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo 	************************************************/
	public function add_cat()
	{
		$user = $this->check_login();
		$data['title'] = 'Add Category';
		$data['signin'] = FALSE;
		$data['username'] = $user['email'];
		$data['password'] = $user['password'];
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('worker/add_cat', $data);
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
		$this->template('worker/add_lead', $data);
	}

	/**********************************************
	*	starting insert functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo 	************************************************/
	public function post_cat()
	{
		$user = $this->check_login();
		if ($this->model->check_cat($_POST['name'])) {
			redirect("worker/cat?msg=Category Already Exist");
		}
		$this->model->insert("category", $_POST);
		redirect("worker/cat?msg=Category Added!");
	}
	public function post_lead()
	{
		$user = $this->check_login();
		$_POST['services'] =  implode(',', $_POST['services']);
		$this->model->insert("lead", $_POST);
		redirect("worker/leads?msg=Lead Added!");
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
			$this->template('worker/add_cat', $data);
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
			$this->template('worker/add_lead', $data);
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
		$data = $this->model->update("category", $_POST, array("category_id"=>$aid));
		if($data)
		{
			redirect("worker/cat?msg=Edited Category");
		}
		else
		{
			redirect("worker/cat?error=1&msg=Error occured while Editing Category");
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
			redirect("worker/leads?msg=Edited Lead");
		}
		else
		{
			redirect("worker/leads?error=1&msg=Error occured while Editing Lead");
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
			redirect("worker/cat?msg=Category has Deleted");
		}
		else
		{
			redirect("worker/cat?error=1&msg=Category has failed to delete. Try Again!");
		}
	}
	public function delete_lead()
	{
		$user = $this->check_login();
		if($this->model->delete("lead", array("lead_id"=>$_GET['lead_id'])))
		{
			redirect("worker/leads?msg=Lead has Deleted");
		}
		else
		{
			redirect("worker/leads?error=1&msg=Lead has failed to delete. Try Again!");
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
			redirect('worker/logout');
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