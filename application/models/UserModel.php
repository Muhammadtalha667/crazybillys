<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserModel extends Ci_Model
{
	function __construct()
	{
		error_reporting(0);
		parent::__construct();
		$session = $this->session->userdata('U_SESS_DATA');
		$this->role = $session['role_id'];
		$selected_study = $this->session->userdata('SELECTED_STUDY');
		$this->project = $selected_study['project_id'];
		
	}
	function login($username,$password)
	{
		$result = $this->db->select('au.*')->from('admin_user as au')
				->where('email',$username)
					->where('password',$password)
					->where('user_status', 1)
				->get();
		$record =  $result->row_array();
		return $record;
	}
	function addAdminuser($id,$data)
	{
		//print_r($data); exit;
	if($id ==''){
		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('admin_user', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}else{
		$this->db->where('user_id',$id)->update('admin_user',$data);
	}
	}
	function usersList($take,$skip,$keyword='')
	{
		$where = '';
		if($keyword!=''){
			$where = " where name like '%". $keyword."%' OR email like '%". $keyword."%' OR role like '%". $keyword."%' OR user_type like '%". $keyword."%'";
		}
		if(isset($take) && isset($skip)){
			$limit = ' limit '.$skip.' , '.$take ;
		}else{$limit='';}
		$query_string = 'select admin_user.*,
		group_concat(DISTINCT project.project_title) project_title,
		group_concat(DISTINCT project.project_id) project_id,
		group_concat(DISTINCT project_role.role_title) role_title,
		group_concat(DISTINCT project_role.role_id) role_id,
		group_concat(DISTINCT acl_apps.name) apps_title,
		group_concat(DISTINCT acl_apps.id) apps_id,
		group_concat(DISTINCT apps_role_ids.role_title) app_role_title,
		group_concat(DISTINCT apps_role_ids.role_id) app_role_id
		from admin_user
		left join project on find_in_set(project_id,admin_user.project)
		left JOIN role as project_role on find_in_set(project_role.role_id,admin_user.role)
		left JOIN acl_apps on find_in_set(id,admin_user.user_apps)
		left JOIN role as apps_role_ids on find_in_set(apps_role_ids.role_id,admin_user.apps_role)
		group by admin_user.user_id
		order by admin_user.user_id desc'.$limit ;
		$query = $this->db->query($query_string);
				//echo $this->db->last_query(); exit;
		return $query->result();
	}
	function totalusers()
	{
		$this->db->select('au.*,rl.*,pt.*');
		$this->db->from('admin_user as au');
		$this->db->join('role as rl', 'au.role = rl.role_id', 'inner');
		$this->db->join('project as pt', 'au.project = pt.project_id', 'inner');
		$this->db->order_by('user_id','desc');
		$result = $this->db->get();
		return $result->num_rows();
	}
	function RemoveUser($id)
	{
		$this->db->where('user_id',$id)->delete('admin_user');
	}
	function getoldPassword($id)
	{
		$qry = $this->db->select('*')->from('admin_user')->where('user_id', $id);
	$qry = $this->db->get();
	return $qry->row_array();
	}
	function addProject($id, $data)
	{
		if($id ==''){
		$this->db->insert('project', $data);
	}else{
		$this->db->where('project_id',$id)->update('project',$data);
	}
	}
	function ProjectList($take,$skip)
	{
		$result = $this->db->select('*')->from('project')->get();
		return $result->result();
	}
	function EventsList()
	{
		extract($_GET);
		$where = '';
		if($keyword!=''){
			$where = "address like '%". $keyword."%'";
		}
		$this->db->select('*');
		$this->db->from('events');
		if($keyword !=''){
		   $this->db->where($where);
		}
		$this->db->order_by("id", "desc");
		$this->db->limit($skip,$take);
		$query = $this->db->get();
		return $query->result_array();
	}
	function totalEvents()
	{
		$query = $this->db->query('select * from events');
		return $query->num_rows();
	}
	
}