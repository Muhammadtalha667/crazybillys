<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GeneralModel extends Ci_Model
{
	function __construct()
	{
		error_reporting(0);
		parent::__construct();
		$session = $this->session->userdata('U_SESS_DATA');
		$this->role = $session['role'];
		$selected_study = $this->session->userdata('SELECTED_STUDY');
		$this->project = $selected_study['project_id'];
		
	}
	function add($table_name,$data)
	{
		$this->db->insert($table_name, $data);
 		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	function update_where($table_name,$data,$where)
	{
		$this->db->where($where);
     	$result = $this->db->update($table_name, $data);
   		return  $this->db->affected_rows();
	}
	function update($table_name,$data,$db_field,$value)
	{
		$this->db->where($db_field,$value);
     	$result = $this->db->update($table_name, $data);
   		return  $result;
	}
	function get_column($table,$where,$column){
		$this->db->select($column);
		$this->db->where($where);
		$this->db->from($table);
		$result = $this->db->get();
		$result = $result->result_array();
		return $result[0][$column];
	}
	function get_record($table,$db_field,$value){
		$this->db->where($db_field,$value);
		$this->db->from($table);
		$result = $this->db->get();
		return $result->result_array();
	}
	function get_bywhere($table,$where){
		$this->db->where($where);
		$this->db->from($table);
		$result = $this->db->get();
		return $result->num_rows();
	}
	function get_bywhere_array($table,$where){
		$this->db->where($where);
		$this->db->from($table);
		$result = $this->db->get();
		return $result->result_array();
	}
	function getGraders(){
		$query = $this->db->query('select name from admin_user where project='.$this->project.' and role = 2');
		return $query->result_array();
	}
	function delete_by_where($table_name,$where){
		$this->db->where($where);
		$this->db->delete($table_name);
	}
	function delete($table_name,$db_field,$value)
	{
		$this->db->where($db_field,$value);
		$this->db->delete($table_name);
	}
	function get($table_name)
	{
		$query = $this->db->select('*')->from($table_name)->get();
		return $query->result_array();
	}
	
}