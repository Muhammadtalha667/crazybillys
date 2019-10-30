<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categories extends MY_Controller {
	function __construct()
	{
		parent::__construct();
	}
	function Main()
	{
		$data['page'] = 'category/main_category';
		$this->load->view('common/template', $data);
	}
	function getCatList()
	{
		$list = $this->CategoriesModel->CategoryList();
		$total = $this->CategoriesModel->totalCategory();
		echo "{\"total\":".$total.",\"data\":" .json_encode($list). "}";
	}
	function insertMainCategory()
	{
		extract($_POST);
		$data  = array(
			'title' => $title
		);
		if($cat_id ==''){
			$this->GeneralModel->add('category', $data);
			$this->session->set_flashdata('msg','Category added successfully');
		}else{
			$this->GeneralModel->update('category', $data,'cat_id',$cat_id);
			$this->session->set_flashdata('msg','Category updated successfully');
			}
		redirect('Categories/Main');
	}
	function deletecategory()
	{
		extract($_POST);
		$this->GeneralModel->delete('category','cat_id',$cat_id);
	}
	function subCategory()
	{
		$data['page'] = 'category/sub_category';
		$data['categories'] = $this->GeneralModel->get('category');
		$this->load->view('common/template', $data);
	}
	function getSubcatList()
	{
		$list = $this->CategoriesModel->SubCategoryList();
		$total = $this->CategoriesModel->totalSubCategory();
		echo "{\"total\":".$total.",\"data\":" .json_encode($list). "}";
	}
	function insertSubCategory()
	{
		extract($_POST);
		$image = '';
		$config = array(
			'upload_path' => "./asset/uploads/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			);
		$this->load->library('upload', $config);
		if($this->upload->do_upload('userfile'))
		{
		$data = array('upload_data' => $this->upload->data());
		$image = $data['upload_data']['file_name'];
		}else if($image =='' && $sub_cat_id !='')
		{
			$image = $this->GeneralModel->get_column('sub_category',array('sub_cat_id' => $sub_cat_id),'image');
		}
		$data  = array(
			'cat_id' => $cat_id,
			'title' => $title,
			'url' => $url,
			'image' => $image
		);
		if($sub_cat_id ==''){
			$this->GeneralModel->add('sub_category', $data);
			$this->session->set_flashdata('msg','Sub Category added successfully');
		}else{
			$this->GeneralModel->update('sub_category', $data,'sub_cat_id',$sub_cat_id);
			$this->session->set_flashdata('msg','Sub Category updated successfully');
			}
		redirect('Categories/subCategory');
	}
	function deleteSubcategory()
	{
		extract($_POST);
		$this->GeneralModel->delete('sub_category','sub_cat_id',$sub_cat_id);
		$this->GeneralModel->delete('products','sub_cat_id',$sub_cat_id);
	}
}
?>