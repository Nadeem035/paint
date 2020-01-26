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
		$data['cat'] = $this->model->get_all_category();
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/cat', $data);
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
	public function package()
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['mode'] = "edit";
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		$data['q'] = $this->model->get_package_by_id(1);
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/package', $data);
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

	/**********************************************
	*	starting insert functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo 	************************************************/
	public function post_cat()
	{
		$user = $this->check_login();
		if ($this->model->check_cat($_POST['name'])) {
			redirect("admin/cat?msg=Category Already Exist");
		}
		$this->model->insert("category", $_POST);
		redirect("admin/cat?msg=Category Added!");
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
			redirect("admin/cat?msg=Edited Category");
		}
		else
		{
			redirect("admin/cat?error=1&msg=Error occured while Editing Category");
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