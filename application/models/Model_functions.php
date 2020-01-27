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
		CATEGORY SECTION
				****
	*/
	public function check_cat($id){
		return (bool) $this->get_row("SELECT * FROM `category` WHERE `category_id` = '$id' LIMIT 1");
	}
	public function get_all_category(){
		return $this->get_results("SELECT * FROM `category` ORDER BY `category_id` DESC");
	}
	public function get_category_byid($id){
		return $this->get_row("SELECT * FROM `category` WHERE `category_id` = '$id' LIMIT 1");
	}
	/*
				****
		END CATEGORY SECTION
				****
	*/

	/*
				****
		PAINTER SECTION
				****
	*/
	public function check_painter($email){
		return (bool) $this->get_row("SELECT * FROM `painter` WHERE `email` = '$email' LIMIT 1");
	}
	public function get_all_painter(){
		return $this->get_results("SELECT * FROM `painter` ORDER BY `painter_id` DESC");
	}
	public function get_all_painter_by_status($arg){
		return $this->get_results("SELECT * FROM `painter` WHERE `status` = '$arg' ORDER BY `painter_id` DESC");
	}
	public function get_painter_byid($id){
		return $this->get_row("SELECT * FROM `painter` WHERE `painter_id` = '$id' LIMIT 1");
	}
	/*
				****
		END PAINTER SECTION
				****
	*/
}