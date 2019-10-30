<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
	function __construct()
	{
		error_reporting(1);
		parent::__construct();
		$session = $this->session->userdata('USER_SESSION');
		$this->username = $session['name'];
		$this->email =  $session['usermail'];
		$this->userid = $session['userId'];
        $this->current_controller =$this->router->fetch_class();
        $this->current_method =$this->router->fetch_method();
		if ($session =='') 
		{
			redirect('login');
		}
		$this->load->model('AclModel');
		$this->load->model('ActivityModel');
		$this->load->model('GeneralModel');
		$this->load->model('NotificationModel');
		$this->load->model('PreferenceModel');
		$this->load->model('ProductsModel');
		$this->load->model('UserModel');
		$this->load->model('CategoriesModel');
		$this->load->model('GalleryModel');
		$this->load->library('commonfunctions');

	}
	
}	