<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct()
	{
		error_reporting(0);
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->library('CommonFunctions');
	}
	function index()
	{
		$this->load->view('login/login');
	}
	
	function UserSignUp()
	{
		$data = array(
			'FULL_NAME' => $this->input->post('username'),
			'USER_MAIL' => $this->input->post('email'),
			'PASSWORD' => $this->input->post('password'),
		);
		$this->Common->addUsers($data);
		redirect('Home/confirmOrder');
	}
	function check_creditional()
	{
		$this->form_validation->set_rules('usermail','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('login/login');
		}else{
			$userName = $this->input->post('usermail');
			$password = $this->input->post('password');
			$encrypted_password = $this->commonfunctions->encryptIt($password);
			$response = $this->UserModel->login($userName,$encrypted_password);
			if($response!='' && !isset($response['error']))
			{
				$data = array(
					'userId'=> $response['user_id'],
					'name'=>$response['name'],
					'usermail'  =>$response['email'],
					'password'=>$response['password'],
				);
			$this->session->set_userdata('USER_SESSION',$data);
				redirect('Admin');
			}else{
				$this->session->set_flashdata('msg', 'Username or Password wrong or block by admin');
				redirect('Login');
			}
		}
	}
	function insertUser()
	{
		$encrypted_password = $this->commonfunctions->encryptIt($this->input->post('password'));
		$data = array(
			'USERNAME' => $this->input->post('fullname'),
			'USERMAIL' => $this->input->post('usermail'),
			'PASSWORD' => $encrypted_password,
			'CONFIRMPASS' => $this->input->post('confirmpass'),
			);
		$this->UserModel->addUser($data);
		redirect('Login');
	}
	function changePass()
	{
		$this->load->view('login/changePass_vw');
	}
	function checkoldPass()
	{
		
		$id = $this->input->post('u_id');
		$oldPass = $this->input->post('oldPass');
$oldPass = $this->commonfunctions->encryptIt($oldPass);
		$res = $this->UserModel->getoldPass($id,$oldPass);
		if($res!=NULL){
			echo "1";
		}else{
			echo "0";
		}
	}
	function newPass()
	{
		$password = $this->commonfunctions->encryptIt($this->input->post('password'));
		$id = $this->input->post('userid');
		//$password = $this->input->post('password');
		$this->UserModel->addNewPass($id,$password);
		redirect('Login');
			
	}
	function logout()
	{
		$this->session->unset_userdata('U_SESS_DATA');
		$this->session->unset_userdata('USER_APPS');
		redirect('Login');
	}
	function forgotPassword()
	{
		$email =$this->input->post('email');
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
		$password = $this->commonfunctions->encryptIt($random_password);
			if($email !=''){
			$res = $this->UserModel->getEmailid($email);
			if($res['user_status']==1)
			{
				$id=$res['user_id'];
				$email=$res['email'];
				$return = $this->UserModel->recoverPass($id, $password);
				if($return==1){
				$this->sendMail_registration($email,$random_password);
				$this->session->set_flashdata("msg","Record Updated Successfully");
				redirect('login');
				} else {
				$this->session->set_flashdata("msg","Error in sending Email.".show_error($this->email->print_debugger()));
				redirect('Login');
				}
			} else
			{
				$this->session->set_flashdata("msg","No record found Please enter valid Email Id or your account has been blocked");
				redirect('Login');
			}
			
		}
	}
		function sendMail_registration($email,$random_password)
	{
		$confg = $this->commonfunctions->config_array_gmail();
		$gmail_id = $confg['smtp_user'];
		$this->email->initialize($confg);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");
$pass = $random_password;
		$this->email->from($gmail_id,'OIRRC: Project Lumina');
		$this->email->to($email);
$this->email->subject('Recover Password');
$this->email->message('Dear User your password is "'.$pass.'" ');
		$this->load->library('encrypt');
		if($this->email->send()){
	$this->session->set_flashdata("email_sent","Email sent successfully.");
		} else {
			$this->session->set_flashdata("email_sent","Error in sending Email.".show_error($this->email->print_debugger()));
		}
	}
	function decryptIt($q){
		$pass = $this->commonfunctions->decryptIt($q);
		return $pass;
	}
	function encryptIt($q){
		$pass = $this->commonfunctions->encryptIt($q);
		return $pass;
	}
}