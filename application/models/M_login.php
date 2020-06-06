<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class M_login extends CI_Model
{
	
	protected $table = "user";
	protected $_id = "id";
	function logging($user, $pass){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('username',$user);
		$this->db->where('password', md5($pass));
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return false;
		}
	}
}