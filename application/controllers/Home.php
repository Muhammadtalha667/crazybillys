<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
function __construct()
	{
		parent::__construct();
		$this->current_controller =$this->router->fetch_class();
		$this->current_method =$this->router->fetch_method();
		$this->load->model('GeneralModel');
		$this->load->model('ProductsModel');
	}
	public function index()
	{
		$data['page']='userfiles/home';
		$data['subCategories'] = $this->GeneralModel->get('sub_category');
		$this->load->view('common_home/template',$data);
	}
	function products($id){
		$data['page']='userfiles/products';
		$data['products'] = $this->ProductsModel->Products_SubCategory($id);
		$data['category'] = $this->GeneralModel->get('category');
		$data['catProducts'] = $this->GeneralModel->get('sub_category');
		$data['subCategoryTitle'] = $this->GeneralModel->get_column('sub_category',array('sub_cat_id'=>$id),'title');
		$this->load->view('common_home/template',$data);
	}
	public function gift_baskets()
	{
		$data['page']='userfiles/gifts';
	$data['gallery'] = $this->GeneralModel->get('gallery');
		$this->load->view('common_home/template',$data);
	}
	public function specials()
	{
		$data['page']='userfiles/specials';
		$data['products'] = $this->ProductsModel->Products_specials();
		$data['category'] = $this->GeneralModel->get('category');
		$data['catProducts'] = $this->GeneralModel->get('sub_category');
		$this->load->view('common_home/template',$data);
	}
	public function did_you_know()
	{
		$data['page']='userfiles/did_you_know';
		$this->load->view('common_home/template',$data);
	}
	public function contact_us()
	{
		$data['page']='userfiles/contact_us';
		$this->load->view('common_home/template',$data);
	}
	public function events()
	{
		$data['page']='userfiles/events';
		$data['events'] = $this->GeneralModel->get('events');
		$this->load->view('common_home/template',$data);
	}
}
?>