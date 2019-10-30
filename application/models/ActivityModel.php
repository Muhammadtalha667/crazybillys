<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ActivityModel extends Ci_Model
{
	function __construct()
	{
		parent::__construct();
		$session = $this->session->userdata('U_SESS_DATA');
		$selected_study = $this->session->userdata('SELECTED_STUDY');
		$this->project = $selected_study['project_id'];
		$this->session_userid = $session['userId'];
		$this->load->library('CommonFunctions');
	}
	function add($table_name,$data)
	{ 
     		$this->db->insert($table_name, $data);
     		$insert_id = $this->db->insert_id();
   			return  $insert_id;
	}
	function update($table_name,$data,$db_field,$value)
	{ 
			$this->db->where($db_field,$value);
     		$result = $this->db->update($table_name, $data);
   			return  $result;
	}
	function ActivityList($take,$skip,$keyword='',$source='',$trans_id='')
	{
		$like='';
		if(isset($source) && $trans_id!=''){
				$like .= " and record_id = ".$trans_id." and activity='Update Transmission' ";
		}
		if(isset($keyword) && $keyword!=''){
				$like .= " and user.name LIKE '%".$keyword."%' ";
		}
		if(isset($take) && isset($skip)){
			$limit = ' limit '.$skip.' , '.$take ;
		}
		$select="SELECT activity_log.*,user.name, role.role_title 
			FROM activity_log 
			inner join admin_user as user on user.user_id = activity_log.user_id 
			inner join role on role.role_id = user.role
			where activity_log.project_id = ".$this->project." 
			".$like."
			order by id desc ".$limit;
		$result = $this->db->query($select);
		//echo $this->db->last_query();exit;
		return $result->result();
	}
	function totalActivity($source,$trans_id)

	{
          	$like='';
			if(isset($source) && $trans_id!=''){
				$like = " and record_id = ".$trans_id." and activity='Update Transmission' ";
		}

		$select="SELECT activity_log.*,user.name, role.role_title 
			FROM activity_log 
			inner join admin_user as user on user.user_id = activity_log.user_id 
			inner join role on role.role_id = user.role
			where activity_log.project_id = ".$this->project."
			".$like."
			order by id desc ";
		$result = $this->db->query($select);
		return $result->num_rows();
	}
	function get_details($activity_id){
	
		$select="SELECT activity_log.updates FROM activity_log where id='".$activity_id."'";
		$query=$this->db->query($select);
		$row= $query->result_array();
		return $row[0]['updates'];
	}
 	function save_activity($activity,$table_name,$record_id,$post_array='',$previous_array=''){
		$user_id = $this->session_userid;
		if(!empty($post_array) && !empty($previous_array)){
			$updates_html = $this->commonfunctions->get_updated_fields($post_array,$previous_array);
		}elseif(!empty($post_array) && empty($previous_array)){
			$updates_html = $this->commonfunctions->get_inserted_fields($post_array);
		}else{
			$updates_html = '';
		}
		$query = $this->db->query("insert into activity_log set  `db_table`='$table_name',`record_id`='$record_id', `activity`='$activity', `updates`='".$updates_html."', `user_id`='$user_id', `project_id`='".$this->project."' ");
		if($query){
			return true;
		}else{
		 echo $this->db->_error_message();
		 exit;
		}
	}
	 function save_multi($activity,$table_name,$records_id,$post_array_od='',$post_array_os='',$previous_array_od='',$previous_array_os=''){
		$user_id = $this->session_userid;
		if(!empty($post_array_od) && !empty($previous_array_od) && !empty($post_array_os) && !empty($previous_array_os)){
			$updates_html = $this->commonfunctions->get_updated_fields_od_os($post_array_od,$post_array_os,$previous_array_od,$previous_array_os);
		}elseif(!empty($post_array_od) && !empty($post_array_os) && empty($previous_array_od) && empty($previous_array_os)){
			$updates_html = $this->commonfunctions->get_inserted_fields_od_os($post_array_od,$post_array_os);
		}else{
			$updates_html = '';
		}
		$query = $this->db->query("insert into activity_log set  `db_table`='$table_name',`record_id`='$records_id', `activity`='$activity', `updates`='".$updates_html."', `user_id`='$user_id' `project_id`='".$this->project."' ");
		if($query){
			return true;
		}else{
		 echo $this->db->_error_message();
		 exit;
		}
	}
	function save_multi_activity_action($form_type='',$visits_data_details_id,$questions,$POST)
	{
		/*echo '<pre>';
		print_r($POST);
		echo 'questions';
		print_r($questions);*/
		$activity = 'INSERTED '.$this->lang->line($form_type).'';
		$user_id = $this->session_userid;
		$created_date = '';
		if(isset($_POST['created_date'])){
			$created_date = ' time="'.$_POST['created_date'].'" , ';
		}
		$updates_html = mysql_real_escape_string ($this->commonfunctions->get_inserted_fields_od_os($questions,$POST));
		$query = $this->db->query("insert into activity_log set `record_id`='$visits_data_details_id', ".$created_date." `activity`='$activity', `updates`='".$updates_html."', `user_id`='$user_id',`project_id`='".$this->project."' ");

	}
	function update_multi_activity_action($visits_data_details_id,$questions,$POST,$previous_data_this_visit)
	{
		$user_id = $this->session_userid;
		$updates_html = $this->commonfunctions->get_updated_fields_od_os($questions,$POST,$previous_data_this_visit);
		$query = $this->db->query("insert into activity_log set `record_id`='$visits_data_details_id', `activity`='$activity', `updates`='".$updates_html."', `user_id`='$user_id',`project_id`='".$this->project."' ");
	}
	function get_previous_data($table,$where){
		$query = $this->db->query("select * from $table where $where ");
		$result = $query->row_array($table,$where);
		// echo $this->db->last_query();exit;
		return $result;
	}
	function get_previous_data_adj($table,$where){
 		$this->db->select('*');
 		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		$resutl = $query->row_array();
		return $resutl;
	}

}