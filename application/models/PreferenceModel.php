<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PreferenceModel extends Ci_Model
{
	function __construct()
	{
		parent::__construct();
		$session = $this->session->userdata('U_SESS_DATA');
		$this->session_userid = $session['userId'];
		$selected_study = $this->session->userdata('SELECTED_STUDY');
		$this->project = $selected_study['project_id'];
		$this->load->library('CommonFunctions');
	}
	function get_value($field,$project_id=''){
		$row=$this->db->query("select $field from preferences where project_id='$project_id'");
		$data = $row->row_array();
		return $data[$field];
	}
	function set_value($field,$value,$project_id=''){
		return $result=$this->db->query("update preferences set $field='$value' where project_id='$project_id'");
	}
	function get($table_name,$where,$group_by=''){
		$this->db->select('*');
		$this->db->from($table_name);
		if($group_by!=''){
			$this->db->group_by($group_by);
		}
		$res=$this->db->where($where)->get();
		return  $res->result_array();
	}
	function add($table_name,$data){
		$this->db->insert($table_name,$data);
	}

}	