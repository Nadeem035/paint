<?php
class Model_functions extends CI_Model {

	public function get_results($sql){
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0)
		{
			return $res->result_array();
		}
		else
		{
			return false;
		}
	}
	public function get_row($sql){
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0)
		{
			$resp = $res->result_array();
			return $resp[0];
		}
		else
		{
			return false;
		}
	}
	
	public function login($username, $password, $check = FALSE)
	{
		$username = $this->db->escape(strtolower($username));
		if(!$check){$password = md5($this->db->escape($password));}
		return $this->db->get_row("SELECT * FROM `user` WHERE `username` = \"$username\" AND `password` = \"$password\";");
	}
	public function get_reg_whole()
	{
		return $this->db->get_row("SELECT * FROM `reg_detail` LIMIT 1");
	}
	
	public function get_package_details($pckg = "1")
	{
		switch($pckg){
			case (string)"1":
				$data = $this->db->get_row("SELECT `one_title` as `title`,`one_price` as `amount` FROM `reg_detail` LIMIT 1");
				$data['total'] = $data['amount'];
			break;

			case (string)"2":
				$data = $this->db->get_row("SELECT `two_title` as `title`,`two_price` as `amount` FROM `reg_detail` LIMIT 1");
				$data['total'] = $data['amount'];
			break;

			case (string)"3":
				$data = $this->db->get_row("SELECT `three_title` as `title`,`three_price` as `amount` FROM `reg_detail` LIMIT 1");
				$data['total'] = $data['amount'];
			break;

			case (string)"4":
				$data = $this->db->get_row("SELECT `four_title` as `title`,`four_price` as `amount` FROM `reg_detail` LIMIT 1");
				$data['total'] = $data['amount'];
			break;
		}
		return $data;

	}

	public function check_username($user)
	{
		if(isset($user) && is_string($user) && strlen($user) > 2)
		{
			return (bool)$this->get_row("SELECT * FROM `admins` WHERE `username` = '$user' LIMIT 1");
		}
		else
		{
			return FALSE;
		}
	}

	public function check_email($email = '')
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			if(is_string($email))
			{
				return (bool)$this->get_row("SELECT * FROM `admins` WHERE `email_address` = '$email' LIMIT 1");
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	public function check_contact_email($email = '')
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			if(is_string($email))
			{
				$email = $this->escape($email);
				return (bool)$this->get_row("SELECT * FROM `cms_contact` WHERE `email` = '$email' LIMIT 1");
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	public function update($table, $vals, $cond, $exec = TRUE)
	{

		if(is_array($vals) && is_array($cond))
		{
			try{
			$vv = '';
			$i = 0;
			$table = "`".trim(strtolower($table))."`";
			foreach($vals as $k=>$v):
				if($i != 0) $vv .= " ,";
				$vv .= "`$k` = '$v' ";
				$i++;
			endforeach;
			$cc = '';
			$i = 0;
			foreach($cond as $k=>$v):
				if($i != 0){$cc .= " AND ";}
				else{$cc .= "WHERE ";}
				$cc .= "`$k` = '$v'";
				$i++;
			endforeach;

			$sql = "UPDATE $table SET $vv $cc";
			if($exec)
				return $this->db->query($sql);
			else
				return $sql;
			}
			catch(Exception $e)
			{
				return FALSE;
			}

		}
		return FALSE;
	}

	public function delete($table, $cond, $exec = TRUE)
	{
		if(is_array($cond))
		{
			try{

				$table = "`".trim(strtolower($table))."`";
				$cc = '';
				$i = 0;
				foreach($cond as $k=>$v):
					if($i != 0){$cc .= " AND ";}
					else{$cc .= "WHERE ";}
					$cc .= "`$k` = '$v'";
					$i++;
				endforeach;

				$sql = "DELETE FROM $table $cc";
				if($exec)
					return $this->db->query($sql);
				else
					return $sql;
			}
			catch(Exception $e)
			{
				return FALSE;
			}

		}
		return FALSE;
	}


	public function insert($table, $vals, $exec = TRUE)
	{
		if(is_array($vals))
		{
			$vv = '';
			$i = 0;
			$table = "`".trim(strtolower($table))."`";
			foreach($vals as $k=>$v):
				if($i != 0) $vv .= " ,";
				$vv .= "`$k` = '$v' ";
				$i++;
			endforeach;
			$sql = "INSERT INTO $table SET $vv";
			if($exec)
			{
				$data = $this->db->query($sql);
				if($data)
				{
					$this->lastid = $this->db->insert_id;

				}
				return $data;
			}
			else
				return $sql;

		}
		else
		return FALSE;
	}
	public function extract_img($html)
	{
		error_off();
		preg_match_all('/<img[^>]+>/i',$html, $result);
		$img = array();
		foreach($result[0] as $img_tag)
		{
			preg_match_all('/(src)=("[^"]*")/i',$img_tag, $img4);
			$img[] = $img4;
		}

		return isset($img[0]['2'][0]) && $img[0]['2'][0] != "" ? preg_replace('["]',"",$img[0]['2'][0]) : IMG.'ad.jpg';
	}


	/*
	 * *****************************************************************************************
	 * Main Functions start here
	*/




	/*
				****
		SUPER CATEGORY SECTION
				****
	*/
	public function check_super_cat($arg = '')
	{
		if(isset($arg) && is_string($arg) && strlen($arg) > 2)
		{
			return (bool)$this->get_row("SELECT * FROM `super_category` WHERE `name` = '$arg' LIMIT 1");
		}
		else
		{
			return FALSE;
		}
	}
	public function get_all_super_cat(){
		return $this->get_results("SELECT * FROM `super_category` ORDER BY `super_category_id` DESC");
	}
	
	/*
				****
		END SUPER CATEGORY SECTION
				****
	*/








	/*
			****
		CATEGORY SECTION
			****
	*/	
	public function check_cat($arg = '')
	{
		if(isset($arg) && is_string($arg) && strlen($arg) > 2)
		{
			return (bool)$this->get_row("SELECT * FROM `category` WHERE `title` = '$arg' LIMIT 1");
		}
		else
		{
			return FALSE;
		}
	}
	public function get_cat_all()
	{
		return $this->get_results("SELECT * FROM `category` ORDER BY `category_id` DESC");
	}
	public function get_all_cat(){
		return $this->get_results("SELECT * FROM category INNER JOIN super_category ON category.super_category_id =  super_category.super_category_id ORDER BY category.category_id DESC");
	}
	public function get_cat_name($arg){
		return $this->get_row("SELECT title from category");
	}
	public function get_products_bycat_id($arg){
		return $this->get_results("SELECT * from product INNER JOIN  WHERE product_id = $arg");
	}
	public function get_side_bar_cats()
	{
		$final = array();
		$scats = $this->get_all_super_cat();
		foreach ($scats as $key => $val) {
			$scid = $val['super_category_id'];
			$cats = $this->get_results("SELECT * FROM `category` WHERE `super_category_id` = '$scid' ORDER BY `title` ASC;");
			$final[$key]['scats'] = $val;
			$final[$key]['cats'] = $cats;
		}
		return $final;
	}
	public function get_cat_byslug($slug)
	{
		return $this->get_row("SELECT * FROM `category` WHERE `slug` = '$slug';");
	}


	/*
			****
		END CATEGORY SECTION
			****	
	*/





	/*
			****
		PACKAGE SECTION
			****	
	*/
	public function get_package_by_id($arg)
	{
		return $this->model->get_row("SELECT * FROM `package` WHERE `package_id` = '$arg'");
	}
	/*
			****	
		END PACKAGE SECTION
			****	
	*/
	





	/*
			****
		SHOP SECTION
			****	
	*/
	public function check_shop($phone, $email, $shop)
	{
		if(isset($shop) && is_string($shop) && strlen($shop) > 2)
		{
			return (bool)$this->get_row("SELECT * FROM `shop` WHERE `username` = '$user' OR `phone` = '$phone' OR `email` = '$email' OR `shop_name` = '$shop' LIMIT 1");
		}
		else
		{
			return FALSE;
		}
	}

	public function get_all_shops()
	{
		return $this->get_results("SELECT * FROM `shop` ORDER BY `shop_id` DESC LIMIT 1");
	}
	public function get_shop_all_by_id($arg)
	{
		return $this->get_row("SELECT * FROM `shop` WHERE `shop_id` = '$arg' LIMIT 1");
	}
	/*
			****
		END SHOP SECTION
			****	
	*/
	


	/*
			****
		PRODUCTS SECTION
			****	
	*/
	public function check_product($pro)
	{
		if(isset($pro) && is_string($pro) && strlen($pro) > 2)
		{
			return (bool)$this->get_row("SELECT * FROM `product` WHERE `name` = '$pro' LIMIT 1");
		}
		else
		{
			return FALSE;
		}
	}
	public function get_all_products($value='')
	{
		return $this->get_results("SELECT p.*, p.slug AS p_slug, sup.name AS sup_name, cat.title AS cat_name FROM product AS p INNER JOIN super_category AS sup ON p.super_category_id = sup.super_category_id INNER JOIN category AS cat ON p.category_id = cat.category_id ORDER BY p.product_id DESC");
	}
	public function get_product_by_slug($slug)
	{
		return $this->get_row("SELECT * FROM `product` WHERE `slug` = '$slug' LIMIT 1");
	}	
	public function get_product_byid($id)
	{
		return $this->get_row("SELECT * FROM `product` WHERE `product_id` = '$id' LIMIT 1");
	}
	public function get_all_active_products()
	{
		return $this->get_results("SELECT * FROM `product` WHERE `status` = 'active' ORDER BY `product_id` DESC LIMIT 20");
	}
	public function get_all_active_products_search($key)
	{
		return $this->get_results("SELECT * FROM `product` WHERE `name` LIKE '%$key%' AND `status` = 'active' ORDER BY `product_id` DESC");
	}
	public function get_all_active_products_rem($id = '')
	{
		return $this->get_results("SELECT * FROM `product` WHERE `status` = 'active' AND `product_id` < '$id' ORDER BY `product_id` DESC LIMIT 20");
	}
	public function get_all_active_products_by_category_id($cat)
	{
		return $this->get_results("SELECT * FROM `product` WHERE `category_id` = '$cat' AND `status` = 'active' ORDER BY `product_id` DESC LIMIT 20");
	}
	public function get_all_active_cat_products_rem($id = '',$cat)
	{
		return $this->get_results("SELECT * FROM `product` WHERE `status` = 'active' AND `category_id` = '$cat' AND `product_id` < '$id' ORDER BY `product_id` DESC LIMIT 20");
	}

	/*
			****
		END PRODUCTS SECTION
			****	
	*/


	/*
			****
		PHOTOS SECTION
			****	
	*/

	public function get_all_photos_by_proid($id)
	{
		return $this->get_results("SELECT * FROM `photos` WHERE `product_id` = '$id' ORDER BY `photos_id` DESC");
	}
	public function get_photo_by_id($id)
	{
		return $this->get_row("SELECT * FROM `photos` WHERE `photos_id` = '$id' LIMIT 1");
	}
	/*
			****
		END PHOTOS SECTION
			****	
	*/



}








