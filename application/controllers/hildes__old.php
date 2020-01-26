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
		if (isset($_SESSION['shop']))
		{
			$data['user'] = unserialize($_SESSION['shop']);
			$data['login'] = true;
		}
		else
		{
			$data['login'] = false;
		}
		$this->load->view('header',$data);
		$this->load->view($page,$data);
		$this->load->view('footer',$data);
	}
	public function login_template($page = '', $data = '')
	{
		if (isset($_SESSION['shop']))
		{
			$data['user'] = unserialize($_SESSION['shop']);
			$data['login'] = true;
		}
		else
		{
			$data['login'] = false;
		}
		$this->load->view('header-login',$data);
		$this->load->view($page,$data);
		$this->load->view('footer-login',$data);
	}
	/**
	
	@Login Randi-Rona

	*/
	
	public function login()
	{
		if (isset($_SESSION['shop']))
		{
			redirect('dashboard');
			return;
		}
		$data['title'] = 'Login';
		$this->login_template('login', $data);
	}
	public function signup()
	{
		if (isset($_SESSION['shop']))
		{
			redirect('index');
			return;
		}
		$data['title'] = 'Sign Up';
		$this->login_template('signup', $data);
	}

	public function check_login()
	{
		if(isset($_SESSION['shop']) && $_SESSION['shop']!= "")
		{
			$user = unserialize($_SESSION['shop']);
			$username = $user['username'];
			$password = $user['password'];
			$resp = $this->model->get_row("SELECT * FROM `shop` WHERE `username` = '$username'  AND `password` =  '$password'");
			if ($resp)
			{
				$_SESSION['shop'] = serialize($resp);
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
		unset($_SESSION['shop']);
		redirect("index");
	}
	/**
	@Login Ajax
	*/
	public function process_login()
	{
		$data = array();
		parse_str($_POST['data'],$data);
		$_POST = $data;

		if ($_POST)
		{
			$username = $_POST['username'];
			$password = md5($_POST['password']);

			$resp = $this->model->get_row("SELECT * FROM `shop` WHERE `username` = '$username'  AND `password` =  '$password';");
			if ($resp)
			{
				$_SESSION['shop'] = serialize($resp);
				echo json_encode(array("status" => true, "msg" => "Successfully Login"));
				return;
			}
			else
			{
				echo json_encode(array("status" => false, "msg" => "Error Found"));
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
		if ($this->model->check_shop($_POST['username'],$_POST['phone'],$_POST['email'],$_POST['shop_name'])) {
			echo json_encode(array("status" => false, "msg" => "Shop Already Exist"));
			return;
		}else{
			if ($_POST)
			{
				$_POST['password'] = md5($_POST['password']);
			 	$name = trim($_POST['shop_name']);
			 	$_POST['slug'] = str_replace(" ", "-", $name);
			 	if ($this->model->insert('shop', $_POST)) {
			 		$resp = $this->model->get_row("SELECT * FROM `shop` WHERE `username` = '".$_POST['username']."'  AND `password` =  '".$_POST['password']."';");
			 		if ($resp) {
				 		$_SESSION['shop'] = serialize($resp);
				 		echo json_encode(array("status" => true, "msg" => "Signup Successfully"));
			 		}else{
			 			echo json_encode(array("status" => false, "msg" => "error found"));
			 		}
			 	}else{
			 		echo json_encode(array("status" => false, "msg" => "error found"));
			 	}
			}
			else
			{
				echo json_encode(array("status" => false, "msg" => "Error"));
			}
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
				redirect('index');
				return;
			}
			else
			{
				redirect('index');
				return;
			}
		}
		else
		{
			redirect('index');
		}
	}
	public function auto_login()
	{
		if ($_GET)
		{
			$data = $_GET;

			$email = $data['email'];
			$password = $data['password'];

			$result = $this->db->query("SELECT * FROM `shop` WHERE `email` = '$email'  AND `password` =  '$password' LIMIT 1;");
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
				$_SESSION['shop'] = serialize($user);
				redirect('index');
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
			$_SESSION['shop'] = serialize($user);
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

		
		$VEmail = $this->db->query("SELECT `email` FROM `shop` WHERE `email` = '$email' LIMIT 1");
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

			$_SESSION['shop'] = serialize($user);
			echo json_encode(array("status"=>true,"type"=>$data['user_type']));
		
		}
	}
	

	public function index()
	{
		// $user = $this->check_login();
		$data['products'] = $this->model->get_all_active_products();
		$data['categories'] = $this->model->get_cat_all();
		$data['last_id'] = $data['products'][count($data['products'])-1]['product_id'];
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
	public function category($slug)
	{
		if (isset($slug) && strlen($slug) > 0) {
			$data['cat_data'] = $this->model->get_cat_byslug($slug);
			$data['products'] = $this->model->get_all_active_products_by_category_id($data['cat_data']['category_id']);
			$data['last_id'] = $data['products'][count($data['products'])-1]['product_id'];
			$data['side_bar_cats'] = $this->model->get_side_bar_cats();
			$this->template('category', $data);
		}
		else{
			redirect('index');
		}
	}
	public function product_ajax()
	{
		$pro = $this->model->get_all_active_products_rem($_POST['last_id']);
		$last_id = $pro[count($pro)-1]['product_id'];
		echo json_encode(array("data"=>$pro, "last_id"=> $last_id));	
	}
	public function category_product_ajax()
	{
		$pro = $this->model->get_all_active_cat_products_rem($_POST['last_id'],$_POST['cat']);
		$last_id = $pro[count($pro)-1]['product_id'];
		echo json_encode(array("data"=>$pro, "last_id"=> $last_id));	
	}
	public function dashboard()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['package'] = $this->model->get_package_by_id(1);
		$this->template('dashboard', $data);
	}

	public function account()
	{
		$user = $this->check_login();
		$data['q'] = $this->model->get_shop_all_by_id($user['shop_id']);
		$this->template('account', $data);
	}

	public function products()
	{
		$user = $this->check_login();
		$data['products'] = $this->model->get_all_products();
		$this->template('products', $data);
	}
	public function add_product()
	{
		$user = $this->check_login();
		$data['sup_cat'] = $this->model->get_all_super_cat();
		$data['cat'] = $this->model->get_cat_all();
		$this->template('add_product', $data);
	}
	public function post_product()
	{
		$user = $this->check_login();
		$name = trim($_POST['name']);
		if ($this->model->check_product($name)) {
			redirect('add-product?e=Product Already Exist');
			return;
		}
		$_POST['slug'] = str_replace(" ", "-", $name);
		$_POST['shop_id'] = $user['shop_id'];
		if ($this->model->insert('product', $_POST)) {
			redirect('products?e=Product Added');
		}else{
			redirect('add-product?e=Something Went Wrong');
		}
	}
	public function edit_product()
	{
		$arg = $this->uri->segment(2);
		$user = $this->check_login();
		if ($arg == '') {
			redirect('products?e=Wrong Product Selection');
		}
		$data['mode'] = edit;
		$data['arg'] = $arg;
		$data['sup_cat'] = $this->model->get_all_super_cat();
		$data['cat'] = $this->model->get_cat_all();
		$data['q'] = $this->model->get_product_by_slug($arg);
		$this->template('add_product', $data);
	}
	public function update_product()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$data = $this->model->update("product", $_POST, array("slug"=>$aid));
		if ($data) {
			redirect('products?e=Product Updated Added');
		}else{
			redirect('edit_product/'.$aid.'?e=Something Went Wrong');
		}
	}
	public function delete_product()
	{
		$user = $this->check_login();
		if($this->model->delete("product", array("product_id"=>$_GET['product_id'])))
		{
			redirect("products?msg=Product has Deleted");
		}
		else
		{
			redirect("products?error=1&msg=Product has failed to delete. Try Again!");
		}
	}



	public function photos($slug = '')
	{
		$arg = $this->uri->segment(2);
		$user = $this->check_login();
		if ($arg == '') {
			redirect('products?e=Wrong Product Selection');
		}
		$data['product'] = $this->model->get_product_by_slug($arg);
		$data['photos'] = $this->model->get_all_photos_by_proid($data['product']['product_id']);
		$this->template('photos', $data);
	}
	public function add_photos($slug = '')
	{
		$arg = $this->uri->segment(2);
		$user = $this->check_login();
		if ($arg == '') {
			redirect('photos?e=Wrong Product Selection');
		}
		$data['product'] = $this->model->get_product_by_slug($arg);
		$this->template('add_photo', $data);
	}
	public function post_photos()
	{
		$user = $this->check_login();
		$data['product'] = $this->model->get_product_byid($_POST['product_id']);
		$arg = $data['product']['slug'];
		if ($this->model->insert('photos', $_POST)) {
			redirect('photos/'.$arg.'?e=photos Added');
		}else{
			redirect('add_photos/'.$arg.'?e=Something Went Wrong');
		}
	}
	public function edit_photos()
	{
		$arg = $this->uri->segment(2);
		$user = $this->check_login();
		if ($arg == '') {
			redirect('products?e=Wrong Product Selection');
		}
		$data['mode'] = edit;
		$data['arg'] = $arg;
		$data['product'] = $this->model->get_product_by_slug($arg);
		$data['q'] = $this->model->get_photo_by_id($arg);
		$this->template('add_photo', $data);
	}
	public function update_photos()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		$data['product'] = $this->model->get_product_byid($_POST['product_id']);
		$arg = $data['product']['slug'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$data = $this->model->update("photos", $_POST, array("photos_id"=>$aid));
		if ($data) {
			redirect('photos/'.$arg.'?e=photos Updated Added');
		}else{
			redirect('photos/'.$arg.'?e=Something Went Wrong');
		}
	}
	public function delete_photo()
	{
		$user = $this->check_login();
		$id = $this->uri->segment(3);
		$data['product'] = $this->model->get_product_byid($id);
		$arg = $data['product']['slug'];
		if($this->model->delete("photos", array("photos_id"=>$_GET['photos_id'])))
		{
			redirect("photos/".$arg."?msg=photos has Deleted");
		}
		else
		{
			redirect("photos/".$arg."?error=1&msg=photos has failed to delete. Try Again!");
		}
	}

	public function change_password()
	{
		$user = $this->check_login();
		$this->template('change-password', $data);
	}
	public function change_account_setting(){
		$user = $this->check_login();
		$data = array();
		parse_str($_POST['data'],$data);
		$_POST = $data;
		if ($this->model->update('shop', $_POST, array('shop_id' => $user['shop_id']))) {
			$data = $this->model->get_shop_all_by_id($user['shop_id']);
			echo json_encode(array("status"=>true, "data"=> $data));
		}else{
			echo json_encode(array("status"=>false, "msg"=> "Something Went Wrong"));
		}
		// $this->template('account', $data);
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



/*INSERT INTO `multi_shop`.`category` (`super_category_id`, `title`, `slug`, `meta_title`, `meta_key`, `meta_description`) VALUES 
('1', 'Jeans', 'Jeans', 'Jeans', 'Jeans', 'Jeans'), 
('3', 'Lipsticks', 'Lipsticks', 'Lipsticks', 'Lipsticks', 'Lipsticks'),
('1', 'Handsfree', 'Handsfree', 'Handsfree', 'Handsfree', 'Handsfree'),
('3', 'Mobile Covers', 'Mobile-Covers', 'Mobile-Covers', 'Mobile Covers', 'Mobile Covers'),
('1', 'Mobile Chargers', 'Mobile-Chargers', 'Mobile-Chargers', 'Mobile Chargers', 'Mobile Chargers'),
('3', 'Laptop Battery', 'Laptop-Battery', 'Laptop-Battery', 'Laptop Battery', 'Laptop Battery'),
('1', 'Mobile Battery', 'Mobile-Battery', 'Mobile-Battery', 'Mobile Battery', 'Mobile Battery'),
('1', 'Laptop cover', 'Laptop-cover', 'Laptop-cover', 'Laptop cover', 'Laptop cover'), 
('3', 'Laptop Bags', 'Laptop-Bags', 'Laptop-Bags', 'Laptop Bags', 'Laptop Bags'),
('1', 'Headphone', 'Headphone', 'Headphone', 'Headphone', 'Headphone'),
('3', 'Laptop', 'Laptop', 'Laptop', 'Laptop', 'Laptop'),
('1', 'Tabs', 'Tabs', 'Tabs', 'Tabs', 'Tabs'),
('3', 'Laptop Chargers', 'Laptop-Chargers', 'Laptop-Chargers', 'Laptop Chargers', 'Laptop Chargers'),
('1', 'Tab Battry', 'Tab-Battry', 'Tab Battry', 'Tab-Battry', 'Tab Battry'),
('1', 'Kids Corner', 'Kids-Corner', 'Kids Corner', 'Kids-Corner', 'Kids Corner'), 
('3', 'Belts', 'Belts', 'Belts', 'Belts', 'Belts'),
('1', 'Mobile Screen', 'Mobile-Screen', 'Mobile Screen', 'Mobile Screen', 'Mobile Screen'),
('3', 'Laptop Screen', 'Laptop-Screen', 'Laptop Screen', 'Laptop Screen', 'Laptop Screen'),
('1', 'Tabs Screen', 'Tabs-Screen', 'Tabs Screen', 'Tabs Screen', 'Tabs Screen'),
('3', 'USB', 'USB', 'USB', 'USB', 'USB'),
('1', 'Mouse', 'Mouse', 'Mouse', 'Mouse', 'Mouse');*/