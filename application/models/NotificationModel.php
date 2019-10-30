<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NotificationModel extends Ci_Model
{
	function __construct()
	{
		parent::__construct();
		$session = $this->session->userdata('U_SESS_DATA');
		$this->session_userid = $session['userId'];
		$selected_study = $this->session->userdata('SELECTED_STUDY');
		$this->project = $selected_study['project_id'];
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
	function getTotalNotification()
	{
		$res=$this->db->query('SELECT COUNT(*) AS total FROM `notifications` left JOIN visit_date_subject as vs ON vs.id=notifications.visit_date_id  WHERE is_archieves=0 and vs.project_id='.$this->project.' ');
		$result =  $res->row_array();
		return $result['total'];

	}
	function getNotification()
	{
		$result=$this->db->query('SELECT noti.*, vs.id, subj.subject_patient_id, user.name, noti.id as notification_id FROM notifications as noti
			left JOIN visit_date_subject as vs ON vs.id=noti.visit_date_id 
			left JOIN subject as subj on subj.subject_id=vs.subject_id
            left JOIN admin_user as user on user.user_id= noti.created_by
			
			where vs.project_id='.$this->project.'
			ORDER BY noti.id DESC ');
		return $result->result_array();
	}
	function acceptNotification($id)
	{
		$result=$this->db->query("UPDATE `notifications` 
			SET status='accepted', is_archieves=1 WHERE id='$id'");
		return $result;
	}
	function rejectNotification($id,$comments)
	{
		$result=$this->db->query("UPDATE `notifications` 
			SET status='rejected',receiver_message='$comments', is_archieves=1 WHERE id='$id'");
		return $result;
	}


}