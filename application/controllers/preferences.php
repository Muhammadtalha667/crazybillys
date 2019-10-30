<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Preferences extends MY_Controller {
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		$where = array('project_id' => $this->project);
		$data['project_name'] = $this->PreferenceModel->get('project',$where);
		$data['reverify_after'] = $this->PreferenceModel->get_value('reverify_after',$this->project);
		$data['reverify_percent'] = $this->PreferenceModel->get_value('reverify_percent',$this->project);
		$data['no_of_graders'] = $this->PreferenceModel->get_value('no_of_graders',$this->project);
		$data['slack_channel'] = $this->PreferenceModel->get_value('slack_channel',$this->project);
		$data['email'] = $this->PreferenceModel->get_value('email',$this->project);
		$data['reply_email'] = $this->PreferenceModel->get_value('reply_to',$this->project);
		$data['password'] = $this->PreferenceModel->get_value('password',$this->project);
		$data['study_type'] = $this->PreferenceModel->get_value('study_type',$this->project);
		$data['study_eye'] = $this->PreferenceModel->get_value('study_eye',$this->project);
		$data['study_diseases'] = $this->PreferenceModel->get_value('study_diseases',$this->project);
		$data['QC_OU_visits'] = $this->PreferenceModel->get_value('QC_OU_visits',$this->project);
		$data['cc_emails'] = $this->PreferenceModel->get_value('cc_emails',$this->project);
		$data['qco_forms'] = $this->PreferenceModel->get_value('study_forms',$this->project);
		$data['graders_forms'] = $this->PreferenceModel->get_value('study_grading_forms',$this->project);
		$data['page'] = 'admin/preferences';
		$this->load->view('common/template', $data);
	}	
	function insertPreferences()
	{
		$qco_forms=$this->input->post('study_forms');
		foreach ($qco_forms as  $value) {
			if($qco_form_types) 
			$qco_form_types.=',';
			$qco_form_types.=$value;
		}
		$qco_form_types; 
        $grading_forms=$this->input->post('study_grading_forms');
		foreach ($grading_forms as  $value) {
			if($grading_form_types) 
			$grading_form_types.=',';
			$grading_form_types.=$value;
		}
		$grading_form_types;
		$where = array('project_id' => $this->project);
		$check_project = $this->PreferenceModel->get('preferences',$where);
		$project = $check_project[0];
		if($project !=''){
			$this->PreferenceModel->set_value('reverify_after',$this->input->post('reverify_after'),$this->project);
			$this->PreferenceModel->set_value('reverify_percent',$this->input->post('reverify_percent'),$this->project);
			$this->PreferenceModel->set_value('no_of_graders',$this->input->post('no_of_graders'),$this->project);
			$this->PreferenceModel->set_value('slack_channel',$this->input->post('slack_channel'),$this->project);
			$this->PreferenceModel->set_value('email',$this->input->post('email'),$this->project);
			$this->PreferenceModel->set_value('reply_to',$this->input->post('reply_email'),$this->project);
			$this->PreferenceModel->set_value('password',$this->input->post('password'),$this->project);
			$data['study_type'] = $this->PreferenceModel->set_value('study_type',$this->input->post('study_type'),$this->project);
			$data['study_eye'] = $this->PreferenceModel->set_value('study_eye',$this->input->post('study_eye'),$this->project);
			$data['study_diseases'] = $this->PreferenceModel->set_value('study_diseases',$this->input->post('study_diseases'),$this->project);
			$data['QC_OU_visits'] = $this->PreferenceModel->set_value('QC_OU_visits',$this->input->post('QC_OU_visits'),$this->project);
			$data['cc_emails'] = $this->PreferenceModel->set_value('cc_emails',$this->input->post('cc_emails'),$this->project);
			$this->PreferenceModel->set_value('study_forms',$qco_form_types,$this->project);
			$this->PreferenceModel->set_value('study_grading_forms',$grading_form_types,$this->project);
			$this->session->set_flashdata("update","Record Updated successfully.");
		}else{
			$data = array(
				'project_id' => $this->project,
				'reverify_after' => $this->input->post('reverify_after'),
				'reverify_percent' => $this->input->post('reverify_percent'),
				'no_of_graders' => $this->input->post('no_of_graders'),
				'slack_channel' => $this->input->post('slack_channel'),
				'email' => $this->input->post('email'),
				'reply_to' => $this->input->post('reply_email'),
				'password' => $this->input->post('password'),
				'study_type' => $this->input->post('study_type'),
				'study_eye' => $this->input->post('study_eye'),
				'study_diseases' => $this->input->post('study_diseases'),
				'QC_OU_visits' => $this->input->post('QC_OU_visits'),
				'study_forms' => $qco_form_types,
				'study_grading_forms' => $grading_form_types
				);
			// print_r($data);exit;
			$this->PreferenceModel->add('preferences',$data);
			$this->session->set_flashdata("update","Record Added successfully.");
		}
		redirect('preferences');
	}
}
?>