<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AclModel extends Ci_Model
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
	function get($table,$where){
		$this->db->select('*');
		$this->db->where($where);
		$this->db->from($table);
		$result = $this->db->get();
		$result = $result->result_array();
		return $result;
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
	function get_all_data($table){
		$this->db->from($table);
		$result = $this->db->get();
		return $result->result_array();
	}
	function getParentModule($app_id){
		$this->db->select('*');
		$this->db->from('acl_permissions');
		$this->db->where('app',$app_id);
		$this->db->order_by('name','asc');
		$result = $this->db->get();
		return $result->result_array();
	}
	function ModuleList($take,$skip){
		$this->db->select('*');
		$this->db->from('acl_modules');
		$this->db->order_by('id','asc');
		$this->db->limit($take,$skip);
		$result = $this->db->get();
		return $result->result_array();
	}
	function totalModules(){
		$this->db->select('*');
		$this->db->from('acl_modules');
		$result = $this->db->get();
		return $result->num_rows();
	}
	function delete($table_name,$db_field,$value)
	{
		$this->db->where($db_field,$value);
		$this->db->delete($table_name);
	}
	function PermissionList($app_id,$take,$skip){
		$this->db->select('acl_permissions.*,acl_modules.name as module_title');
		$this->db->from('acl_permissions');
		$this->db->join('acl_modules','acl_modules.id=acl_permissions.module_id','left');
		$this->db->where('acl_permissions.app',$app_id);
		$this->db->order_by('acl_permissions.id','asc');
		$this->db->limit($take,$skip);
		$result = $this->db->get();

		return $result->result_array();
	}
	function totalPermissions($take,$skip){
		extract($_GET);
		if(!isset($app_id)){$app_id=1;}
		$this->db->select('acl_permissions.*,acl_modules.name as module_title');
		$this->db->from('acl_permissions');
		$this->db->join('acl_modules','acl_modules.id=acl_permissions.module_id','left');
		$this->db->where('acl_permissions.app',$app_id);
		$this->db->order_by('acl_permissions.id','asc');
		$result = $this->db->get();
		return $result->num_rows();
	}
	function AppRoleTitle($app_role_id='')
	{
		$this->db->select('acl_apps_roles.*,acl_apps.name,role.role_title');
		$this->db->from('acl_apps_roles');
		$this->db->join('acl_apps','acl_apps.id=acl_apps_roles.app_id');
		$this->db->join('role','role.role_id=acl_apps_roles.role_id');
		$this->db->where('acl_apps_roles.id',$app_role_id);
		$result = $this->db->get();
		return $result->row_array();
	}
	function get_menu_againt_parent($parent_id){
		$query = $this->db->select('*')->from('acl_permissions')->where('parent_menu',$parent_id)->get();
		return $query->result_array();
	}
	
	}
	
