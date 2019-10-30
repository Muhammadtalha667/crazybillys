<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends MY_Controller {
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		$data['page'] = 'admin/homeView';
		$this->load->view('common/template', $data);
	}
	function adminUser()
	{
		$data['page'] = 'admin/adminUser_vw';
		$data['role'] = $this->UserModel->getRole();
		$data['project'] = $this->UserModel->getProject();
		$data['apps'] = $this->AclModel->get_all_data('acl_apps');
		$data['appsRoles'] = $this->UserModel->getAppsRoles('role');
		$this->load->view('common/template', $data);
	}
	function insertAdminUser()
	{
	
		extract($_POST);
		$id= $this->input->post('user_id');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$role = $this->input->post('role_title');
		$user_type = $this->input->post('user_type');
		$project = $this->input->post('project_title');
		//echo $project_ids=json_encode(implode(",", $project)); exit;
		foreach ( $project as $value_project)
		{
			if ($project_ids) $project_ids .= ',';
			$project_ids .= $value_project;
			}
		$project_ids;
		// role ids
		foreach ( $role as $value_role)
		{
			if ($roles_ids) $roles_ids .= ',';
			$roles_ids .= $value_role;
			}
		$roles_ids;
		// apps
		foreach ( $user_apps as $value_apps)
		{
			if ($apps_ids) $apps_ids .= ',';
			$apps_ids .= $value_apps;
			}
		$apps_ids;
		// Roles against Roles
		foreach ( $apps_role as $value_apps_roles)
		{
			if ($apps_roles_ids) $apps_roles_ids .= ',';
			$apps_roles_ids .= $value_apps_roles;
			}
		$apps_roles_ids;
		if($id !=''){
			$res = $this->UserModel->getoldPassword($id);
			$random_password = $res['password'];
		}
		if($id == ''){
			function random_password()
			{
			$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			$password = array();
			$alpha_length = strlen($alphabet) - 1;
			for ($i = 0; $i < 8; $i++)
			{
			$n = rand(0, $alpha_length);
			$password[] = $alphabet[$n];
			}
			return implode($password);
			}
			$random_password = random_password();
			
		}
		$encrypted_password = $this->commonfunctions->encryptIt($random_password);
	
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			//'password' =>  $encrypted_password,
			'role' =>  $roles_ids,
			'project' =>  $project_ids,
			'user_apps' =>  $apps_ids,
			'apps_role' =>  $apps_roles_ids
		);
			if($id == ''){
		$data['password'] = $encrypted_password;
	}
	//	print_r($data); exit;
		if($id !=''){
			$result=$this->UserModel->getOldrecord($id);
				if($result['name']!=$name || $result['role']!=$role || $result['project']!=$project){
				if($result['name']!=$name && $result['name']!=''){
					$oldname=$result['name'];
					$final_name= '<strong>Name:</strong> From '.$oldname.' to '.$name;
					}
				if($result['role']!=$role && $result['role']!=''){
					$role_id=$result['role'];
					$res=$this->UserModel->getnewRole($role);
					$new_role_title=$res['role_title'];
					$result=$this->UserModel->getOldRole($role_id);
					$old_role_title=$result['role_title'];
					$final_role= '<strong>Role:</strong> From '.$old_role_title.' to '.$new_role_title;
				}
				if($result['project']!=$project && $result['project']!=''){
					$project_id=$result['project'];
					$res=$this->UserModel->getnewProject($project);
					$new_project_title=$res['project_title'];
					$result=$this->UserModel->getOldProject($project_id);
					$old_project_title=$result['project_title'];
					$final_project= '<strong>Project:</strong> From '.$old_project_title.' to '.$new_project_title;
				}
				//$this->sendMail_updation($email,$final_name,$final_role,$final_project);
			}
			$id = $this->UserModel->addAdminuser($id, $data);
			$this->session->set_flashdata("email","Record Updated Successfully");
			redirect('Admin/adminUser');
		}else{
			$result = $this->UserModel->checkEmail($email,$role);
			}
		if($result ==''){
			$id = $this->UserModel->addAdminuser($id, $data);
			$this->sendMail_registration($email,$random_password,$id);
		}else{
			$this->session->set_flashdata("email","User Already Exists.");
		}
		redirect('Admin/adminUser');
	}
	
	function sendMail_registration($email,$random_password,$id)
	{
		$projectName = $this->GeneralModel->get_record('project','project_id',$this->project);
		$confg = $this->commonfunctions->config_array_gmail();
		$gmail_id = $confg['smtp_user'];
		$this->email->initialize($confg);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");
		$url = base_url()."Login/changePass/".$id;
$pass = $random_password;
		$this->email->from($gmail_id,'OIRRC: Project '.$projectName[0]['project_title']);
		$this->email->to($email);
$this->email->subject('Change Password');
$this->email->message('Dear User your password is "'.$pass.'" if you need to update your password click on link  "'.$url.'" ');
		$this->load->library('encrypt');
		if($this->email->send()){
	$this->session->set_flashdata("email_sent","Email sent successfully.");
		} else {
			$this->session->set_flashdata("email_sent","Error in sending Email.".show_error($this->email->print_debugger()));
		}
	}
	function getUserList()
	{
		$keyword = $this->input->get('keyword');
		$take = $this->input->get('take');
		$skip = $this->input->get('skip');
		$list = $this->UserModel->usersList($take,$skip,$keyword);
		$total = $this->UserModel->totalusers();
		echo "{\"total\":".$total.",\"data\":" .json_encode($list). "}";
	}
	function deleteUser()
	{
		$id = $this->input->post('u_id');
		$this->UserModel->RemoveUser($id);
	}
	
	function changeStatus()
	{
		$id = $this->input->post('u_id');
		$this->UserModel->UpdateStatus($id);
	}
	function subjectVisit()
	{
		$take = $this->input->get('take');
		$skip = $this->input->get('skip');
		$list = $this->WigetsModel->VisitSubject($take,$skip);
		$total = $this->WigetsModel->totalVisitSubject();
		echo "{\"total\":".$total.",\"data\":" .json_encode($list). "}";
	}
	function sendMail_updation($email,$final_name,$final_project,$final_role)
	{
		$projectName = $this->GeneralModel->get_record('project','project_id',$this->project);
		$data = $final_name.'<br>'.$final_project.'</br>'.$final_role;
		$confg = $this->commonfunctions->config_array_gmail();
		$gmail_id = $confg['smtp_user'];
		$this->email->initialize($confg);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");
		$this->email->from($gmail_id,'OIRRC: Project '.$projectName[0]['project_title']);
		$this->email->to($email);
		$this->email->subject('Account Updation');
		$this->email->message('Dear User your account has been updated. '.$data.'');
		$this->load->library('encrypt');
		if($this->email->send()){
			$this->session->set_flashdata("email_sent","Email sent successfully.");
		} else {
			$this->session->set_flashdata("email_sent","Error in sending Email.".show_error($this->email->print_debugger()));
		}
	}
	function sendMail_regection($email,$comments)
	{
		$projectName = $this->GeneralModel->get_record('project','project_id',$this->project);
		$confg = $this->commonfunctions->config_array_gmail();
		$gmail_id = $confg['smtp_user'];
		$this->email->initialize($confg);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");
		$this->email->from($gmail_id,'OIRRC: Project '.$projectName[0]['project_title']);
		$this->email->to($email);
		$this->email->subject('Reason for rejection of the request');
		$this->email->message('Dear User your request has been rejected due to  "'.$comments.'" ');
		$this->load->library('encrypt');
		if($this->email->send()){
			$this->session->set_flashdata("email_sent","Email sent successfully.");
		} else {
			$this->session->set_flashdata("email_sent","Error in sending Email.".show_error($this->email->print_debugger()));
		}
	}
	function events()
	{
		$data['page'] = 'admin/events';
		$this->load->view('common/template', $data);
	}
	function insertEvent()
	{
		extract($_POST);
		$data = array(
				'address' => $address, 
				'date' => $date, 
				'from_time' => $from_time, 
				'to_time' => $to_time, 
				'description' => $description, 
		);
		if($id ==''){
			$this->GeneralModel->add('events', $data);
			$this->session->set_flashdata('msg','Event added successfully');
		}else{
			$this->GeneralModel->update('events', $data,'id',$id);
			$this->session->set_flashdata('msg','Event updated successfully');
			}
		redirect('Admin/events');
	}
	function getEvents()
	{
		$list = $this->UserModel->EventsList();
		$total = $this->UserModel->totalEvents();
		echo "{\"total\":".$total.",\"data\":" .json_encode($list). "}";
	}
	function deleteEvent()
	{
		extract($_POST);
		$this->GeneralModel->delete('events','id',$event_id);
	}
	
}
?>