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



	public function filter_by_date($min = '', $max = '' , $arg)
	{
		if ($arg == 'transaction') {
			return $this->get_results("SELECT *,p.name AS p_name, a.name AS a_name, t.status AS t_status, t.at AS t_at FROM $arg AS t LEFT JOIN painter AS p ON t.painter_id = p.painter_id LEFT JOIN affiliate AS a ON t.affiliate_id = a.affiliate_id WHERE DATE(t.at) >= '$min' AND DATE(t.at) <= '$max' ORDER BY `transaction_id` DESC;");	
		}else{
			return $this->get_results("SELECT * FROM `$arg` WHERE DATE(at) >= '$min' AND DATE(at) <= '$max';");	
		}
	}
	public function filter_by_date_paiter($min = '', $max = '', $id)
	{
		return $this->get_results("SELECT pl.*,l.*, pl.status AS pl_status, p.name AS p_name, l.at AS l_at FROM painter_lead AS pl INNER JOIN lead AS l ON pl.lead_id = l.lead_id INNER JOIN package AS p ON l.package_id = p.package_id WHERE pl.painter_id = '$id' AND l.status = 'valid' AND DATE(l.at) >= '$min' AND DATE(l.at) <= '$max';");

		// return $this->get_results("SELECT * FROM `$arg` WHERE DATE(at) >= '$min' AND DATE(at) <= '$max' AND `painter_id` = '$id';");	
	}
	public function filter_by_date_affiliate($min = '', $max = '' , $arg, $id)
	{
		return $this->get_results("SELECT * FROM `$arg` WHERE DATE(at) >= '$min' AND DATE(at) <= '$max' AND `affiliate_id` = '$id';");	
	}
	public function get_all_settings()
	{
		return $this->get_row("SELECT * FROM `setting` WHERE `setting_id` = '1' LIMIT 1;");	
	}

	public function get_lead_package($arg){
		return $this->get_row("SELECT * FROM lead AS l INNER JOIN package AS p ON l.package_id = p.package_id WHERE l.lead_id = '$arg' LIMIT 1;");	
	}





	/**
	 *  COUNT TOTALS 
	 */

	public function count_cat(){
		return $this->get_row("SELECT count(category_id) AS total FROM `category`;");
	}
	public function count_income(){
		return $this->get_row("SELECT SUM(amount) AS total FROM `transaction` WHERE `status` = 'credit';");
	}
	public function count_debit(){
		return $this->get_row("SELECT SUM(pending_amount) AS total FROM `affiliate`;");
	}
	public function count_package_lead(){
		$arg = $this->get_results("SELECT * FROM `package` ORDER BY package_id DESC;");
		foreach ($arg as $key => $p) {
			$da[] = $this->get_row("SELECT COUNT(*) AS total FROM `lead` WHERE `package_id` = '$p[package_id]';");
		}
		return $da;
	}
	public function count_painter(){
		return $this->get_row("SELECT (SELECT COUNT(*) FROM `painter` ) AS total, (SELECT COUNT(*) FROM `painter` WHERE `status` = 'active') AS total_active, (SELECT COUNT(*) FROM `painter` WHERE `status` = 'inactive') AS total_inactive;");
	}
	public function count_affiliate(){
		return $this->get_row("SELECT (SELECT COUNT(*) FROM `affiliate` ) AS total, (SELECT COUNT(*) FROM `affiliate` WHERE `status` = 'active') AS total_active, (SELECT COUNT(*) FROM `affiliate` WHERE `status` = 'inactive') AS total_inactive;");
	}
	public function count_worker(){
		return $this->get_row("SELECT (SELECT COUNT(*) FROM `worker` ) AS total, (SELECT COUNT(*) FROM `worker` WHERE `status` = 'active') AS total_active, (SELECT COUNT(*) FROM `worker` WHERE `status` = 'inactive') AS total_inactive;");
	}
	public function count_package(){
		return $this->get_row("SELECT (SELECT COUNT(*) FROM `package` ) AS total, (SELECT COUNT(*) FROM `package` WHERE `status` = 'active') AS total_active, (SELECT COUNT(*) FROM `package` WHERE `status` = 'inactive') AS total_inactive;");
	}
	public function count_lead(){
		return $this->get_row("SELECT (SELECT COUNT(*) FROM `lead` ) AS total, (SELECT COUNT(*) FROM `lead` WHERE `status` = 'new') AS total_new, (SELECT COUNT(*) FROM `lead` WHERE `status` = 'valid') AS total_valid, (SELECT COUNT(*) FROM `lead` WHERE `status` = 'invalid') AS total_invalid;");
	}

	public function count_lead_painter($arg){
		return $this->get_row("SELECT (SELECT COUNT(*) FROM `painter_lead` WHERE `painter_id` = '$arg' ) AS total, (SELECT COUNT(*) FROM `painter_lead` WHERE DATE(at) = DATE(NOW()) AND `painter_id` = '$arg') AS total_today, (SELECT COUNT(*) FROM `painter_lead` WHERE `at` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND `painter_id` = '$arg') AS total_week, (SELECT COUNT(*) FROM `painter_lead` WHERE at BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND CURDATE() AND `painter_id` = '$arg') AS total_month, (SELECT COUNT(*) FROM `painter_lead` WHERE at BETWEEN DATE_FORMAT(CURDATE() ,'%Y-01-01') AND CURDATE() AND `painter_id` = '$arg') AS total_year;");
	}

	public function count_lead_affiliate($arg){
		return $this->get_row("SELECT (SELECT COUNT(*) FROM `lead` WHERE `affiliate_id` = '$arg' ) AS total, (SELECT COUNT(*) FROM `lead` WHERE DATE(at) = DATE(NOW()) AND `affiliate_id` = '$arg') AS total_today, (SELECT COUNT(*) FROM `lead` WHERE `at` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND `affiliate_id` = '$arg') AS total_week, (SELECT COUNT(*) FROM `lead` WHERE at BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND CURDATE() AND `affiliate_id` = '$arg') AS total_month, (SELECT COUNT(*) FROM `lead` WHERE at BETWEEN DATE_FORMAT(CURDATE() ,'%Y-01-01') AND CURDATE() AND `affiliate_id` = '$arg') AS total_year;");
	}
	public function count_total_admin(){
		return $this->get_row("SELECT (SELECT COUNT(*) FROM `lead`) AS total_lead, (SELECT COUNT(*) FROM `lead` WHERE DATE(at) = DATE(NOW())) AS total_lead_today, (SELECT COUNT(*) FROM `lead` WHERE `at` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)) AS total_lead_week, (SELECT COUNT(*) FROM `lead` WHERE at BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND CURDATE()) AS total_lead_month, (SELECT COUNT(*) FROM `lead` WHERE at BETWEEN DATE_FORMAT(CURDATE() ,'%Y-01-01') AND CURDATE()) AS total_lead_year, (SELECT SUM(amount) FROM `transaction` WHERE `painter_id` > 0 ) AS total_painter_trasactions, (SELECT SUM(amount) FROM `transaction` WHERE DATE(at) = DATE(NOW()) AND `painter_id` > 0) AS total_painter_trasactions_today, (SELECT SUM(amount) FROM `transaction` WHERE `at` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND `painter_id` > 0) AS total_painter_trasactions_week, (SELECT SUM(amount) FROM `transaction` WHERE at BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND CURDATE() AND `painter_id` > 0) AS total_painter_trasactions_month, (SELECT SUM(amount) FROM `transaction` WHERE at BETWEEN DATE_FORMAT(CURDATE() ,'%Y-01-01') AND CURDATE() AND `painter_id` > 0) AS total_painter_trasactions_year, (SELECT SUM(amount) FROM `transaction` WHERE `affiliate_id` > 0) AS total_affiliate_trasactions, (SELECT SUM(amount) FROM `transaction` WHERE DATE(at) = DATE(NOW()) AND `affiliate_id` > 0) AS total_affiliate_trasactions_today, (SELECT SUM(amount) FROM `transaction` WHERE `at` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND `affiliate_id` > 0) AS total_affiliate_trasactions_week, (SELECT SUM(amount) FROM `transaction` WHERE at BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND CURDATE() AND `affiliate_id` > 0) AS total_affiliate_trasactions_month, (SELECT SUM(amount) FROM `transaction` WHERE at BETWEEN DATE_FORMAT(CURDATE() ,'%Y-01-01') AND CURDATE() AND `affiliate_id` > 0) AS total_affiliate_trasactions_year;");
	}
	
	public function count_lead_affiliate_package($arg){
		$package = $this->get_results("SELECT * FROM `package`");
		foreach ($package as $key => $p) {
			$id = $p['package_id'];
			$data[] = $this->get_row("SELECT COUNT(*) AS c, p.name AS p_name FROM lead AS l LEFT JOIN package AS p ON l.package_id = p.package_id WHERE l.affiliate_id = '$arg' AND l.package_id = '$id';");
		}
		return $data;
	}

	 /**
	 *  END COUNT TOTALS 
	 */



	/*
			****
		SLIDER SECTION
			****	
	*/
	public function get_all_slides()
	{
		return $this->get_results("SELECT * FROM `slider` ORDER BY `slider_id` ASC;");
	}
	public function get_slide_byid($id)
	{
		return $this->get_row("SELECT * FROM `slider` WHERE `slider_id` = '$id';");
	}
	
	/*
			****	
		END SLIDER SECTION
			****	
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
	public function get_category_by_slug($slug){
		return $this->get_row("SELECT * FROM `category` WHERE `slug` = '$slug' LIMIT 1");
	}
	public function get_cat_by_id($id){
		$services = explode(',', $id);
 		foreach ($services as $key => $s) {
			$data[] = $this->get_row("SELECT `name` FROM `category` WHERE `category_id` = '$s' LIMIT 1");
		}
		foreach ($data as $key => $d) {
			$row[] = $d['name'];
		}
		return implode(',', $row);
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
	public function get_all_painter_by_package($id)
	{
		return $this->get_results("SELECT * FROM `painter` WHERE `package_id` = '$id' ORDER BY `painter_id` DESC");
	}
	public function get_lead_by_painter($id){
		return $this->get_results("SELECT pl.*,l.*, pl.status AS pl_status, p.name AS p_name, l.at AS l_at FROM painter_lead AS pl INNER JOIN lead AS l ON pl.lead_id = l.lead_id INNER JOIN package AS p ON l.package_id = p.package_id WHERE pl.painter_id = '$id' AND l.status = 'valid';");
	}
	public function get_lead_by_painter_status($id, $arg){
		return $this->get_results("SELECT pl.*,l.*, pl.status AS pl_status, p.name AS p_name FROM painter_lead AS pl INNER JOIN lead AS l ON pl.lead_id = l.lead_id INNER JOIN package AS p ON l.package_id = p.package_id WHERE pl.painter_id = '$id' AND l.status = 'valid' AND pl.status = '$arg';");
	}
	public function get_count_lead_by_painter($id){
		return $this->get_row("SELECT COUNT(painter_lead_id) AS count FROM `painter_lead` WHERE `painter_id` = '$id' AND `status` = 'pending';");
	}
	public function count_trasaction_painter($arg){
		return $this->get_row("SELECT (SELECT SUM(amount) FROM `transaction` WHERE `painter_id` = '$arg' ) AS total, (SELECT SUM(amount) FROM `transaction` WHERE DATE(at) = DATE(NOW()) AND `painter_id` = '$arg') AS total_today, (SELECT SUM(amount) FROM `transaction` WHERE `at` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND `painter_id` = '$arg') AS total_week, (SELECT SUM(amount) FROM `transaction` WHERE at BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND CURDATE() AND `painter_id` = '$arg') AS total_month, (SELECT SUM(amount) FROM `transaction` WHERE at BETWEEN DATE_FORMAT(CURDATE() ,'%Y-01-01') AND CURDATE() AND `painter_id` = '$arg') AS total_year;");
	}
	public function count_trasaction_affiliate($arg){
		return $this->get_row("SELECT (SELECT SUM(amount) FROM `transaction` WHERE `affiliate_id` = '$arg' ) AS total, (SELECT SUM(amount) FROM `transaction` WHERE DATE(at) = DATE(NOW()) AND `affiliate_id` = '$arg') AS total_today, (SELECT SUM(amount) FROM `transaction` WHERE `at` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND `affiliate_id` = '$arg') AS total_week, (SELECT SUM(amount) FROM `transaction` WHERE at BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND CURDATE() AND `affiliate_id` = '$arg') AS total_month, (SELECT SUM(amount) FROM `transaction` WHERE at BETWEEN DATE_FORMAT(CURDATE() ,'%Y-01-01') AND CURDATE() AND `affiliate_id` = '$arg') AS total_year;");
	}
	/*
				****
		END PAINTER SECTION
				****
	*/

	/*
				****
		AFFILIATE SECTION
				****
	*/
	public function check_affiliate($email){
		return (bool) $this->get_row("SELECT * FROM `affiliate` WHERE `email` = '$email' LIMIT 1");
	}
	public function get_all_affiliate(){
		return $this->get_results("SELECT * FROM `affiliate` ORDER BY `affiliate_id` DESC");
	}
	public function get_all_affiliate_by_status($arg){
		return $this->get_results("SELECT * FROM `affiliate` WHERE `status` = '$arg' ORDER BY `affiliate_id` DESC");
	}
	public function get_affiliate_byid($id){
		return $this->get_row("SELECT * FROM `affiliate` WHERE `affiliate_id` = '$id' LIMIT 1");
	}
	/*public function get_count_lead_by_affiliate($id){
		return $this->get_row("SELECT COUNT(painter_lead_id) AS count FROM `painter_lead` WHERE `painter_id` = '$id' AND `status` = 'pending';");
	}*/
	/*
				****
		END AFFILIATE SECTION
				****
	*/
	

	/*
				****
		LEADS SECTION
				****
	*/
	public function get_all_lead(){
		return $this->get_results("SELECT * FROM `lead` ORDER BY `lead_id` DESC");
	}
	public function get_all_lead_by_status($arg){
		return $this->get_results("SELECT * FROM `lead` WHERE `status` = '$arg' ORDER BY `lead_id` DESC");
	}
	public function get_lead_byid($id){
		return $this->get_row("SELECT * FROM `lead` WHERE `lead_id` = '$id' LIMIT 1");
	}
	/*
				****
		END LEADS SECTION
				****
	*/
	
	/*
				****
		PAINTER LEADS SECTION
				****
	*/
	public function get_all_painter_lead(){
		return $this->get_results("SELECT * FROM `painter_lead` ORDER BY `painter_lead_id` DESC");
	}
	public function get_all_painter_lead_by_status($arg){
		return $this->get_results("SELECT * FROM `painter_lead` WHERE `status` = '$arg' ORDER BY `painter_lead_id` DESC");
	}
	public function get_painter_lead_byid($id){
		return $this->get_row("SELECT pl.*,l.*, pl.status AS pl_status FROM painter_lead AS pl INNER JOIN lead AS l ON pl.lead_id = l.lead_id INNER JOIN package AS p ON l.package_id = p.package_id  WHERE pl.painter_lead_id = '$id' LIMIT 1;");
	}
	/*
				****
		END PAINTER LEADS SECTION
				****
	*/

	/*
				****
		PACKAGES SECTION
				****
	*/
	public function check_package($name){
		return (bool) $this->get_row("SELECT * FROM `package` WHERE `name` = '$name' LIMIT 1");
	}
	public function get_all_package(){
		return $this->get_results("SELECT * FROM `package` ORDER BY `package_id` DESC");
	}
	public function get_all_package_by_status($arg){
		return $this->get_results("SELECT * FROM `package` WHERE `status` = '$arg' ORDER BY `package_id` DESC");
	}
	public function get_package_byid($id){
		return $this->get_row("SELECT * FROM `package` WHERE `package_id` = '$id' LIMIT 1");
	}
	/*
				****
		END PACKAGES SECTION
				****
	*/

	/*
				****
		WORKER SECTION
				****
	*/
	public function check_worker($email){
		return (bool) $this->get_row("SELECT * FROM `worker` WHERE `email` = '$email' LIMIT 1");
	}
	public function get_all_worker(){
		return $this->get_results("SELECT * FROM `worker` ORDER BY `worker_id` DESC");
	}
	public function get_all_worker_by_status($arg){
		return $this->get_results("SELECT * FROM `worker` WHERE `status` = '$arg' ORDER BY `worker_id` DESC");
	}
	public function get_worker_byid($id){
		return $this->get_row("SELECT * FROM `worker` WHERE `worker_id` = '$id' LIMIT 1");
	}
	/*
				****
		END WORKER SECTION
				****
	*/
				/*
				****
		TRANSACTIONS SECTION
				****
	*/
	public function get_all_transactions(){
		return $this->get_results("SELECT *,p.name AS p_name, a.name AS a_name, t.status AS t_status, t.at AS t_at FROM transaction AS t LEFT JOIN painter AS p ON t.painter_id = p.painter_id LEFT JOIN affiliate AS a ON t.affiliate_id = a.affiliate_id  ORDER BY `transaction_id` DESC");
	}
	public function get_all_transactions_by_status($arg){
		if ($arg == 'painters') {
			return $this->get_results("SELECT *,p.name AS p_name, a.name AS a_name, t.status AS t_status, t.at AS t_at FROM transaction AS t LEFT JOIN painter AS p ON t.painter_id = p.painter_id LEFT JOIN affiliate AS a ON t.affiliate_id = a.affiliate_id WHERE t.painter_id > 0 ORDER BY `transaction_id` DESC");
		}elseif ($arg == 'affiliates') {
			return $this->get_results("SELECT *,p.name AS p_name, a.name AS a_name, t.status AS t_status, t.at AS t_at FROM transaction AS t LEFT JOIN painter AS p ON t.painter_id = p.painter_id LEFT JOIN affiliate AS a ON t.affiliate_id = a.affiliate_id WHERE t.affiliate_id > 0 ORDER BY `transaction_id` DESC");
		}
	}
	public function get_transactions_byid($id){
		return $this->get_row("SELECT * FROM `transaction` WHERE `transaction_id` = '$id' LIMIT 1");
	}
	public function get_transactions_by_paiterid($id){
		return $this->get_results("SELECT * FROM `transaction` WHERE `painter_id` = '$id' ORDER BY `transaction_id` DESC;");
	}
	public function get_transactions_by_affiliateid($id){
		return $this->get_results("SELECT * FROM `transaction` WHERE `affiliate_id` = '$id' ORDER BY `transaction_id` DESC;");
	}
	/*public function get_count_lead_by_transactions($id){
		return $this->get_row("SELECT COUNT(painter_lead_id) AS count FROM `painter_lead` WHERE `painter_id` = '$id' AND `status` = 'pending';");
	}*/
	/*
				****
		END TRANSACTIONS SECTION
				****
	*/
}