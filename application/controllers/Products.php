<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends MY_Controller {
	function __construct()
	{
		parent::__construct();
			
	}
	function Main()
	{
		$data['page'] = 'products/products';
		$data['categories'] = $this->GeneralModel->get('sub_category');
		$this->load->view('common/template', $data);
	}
	function insertProduct()
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
		}else if($image =='' && $prod_id !='')
		{
			$image = $this->GeneralModel->get_column('products',array('prod_id' => $prod_id),'image');
		}
		$data  = array(
			'sub_cat_id' => $sub_cat_id,
			'title' => $title,
			'size' => $size,
			'quantity' => $quantity,
			'item_no' => $item_no,
			'price' => $price,
			'discount' => $discount,
			'type' => $type,
			'description' => $description,
			'image' => $image
		);
		if($prod_id ==''){
			$this->GeneralModel->add('products', $data);
			$this->session->set_flashdata('msg','Products added successfully');
		}else{
			$this->GeneralModel->update('products', $data,'prod_id',$prod_id);
			$this->session->set_flashdata('msg','Products updated successfully');
			}
		redirect('Products/Main');
	}
	function getProductList()
	{
		$list = $this->ProductsModel->ProductsList();
		$total = $this->ProductsModel->totalProducts();
		echo "{\"total\":".$total.",\"data\":" .json_encode($list). "}";
	}
	function deleteProduct()
	{
		extract($_POST);
		$this->GeneralModel->delete('products','prod_id',$prod_id);
	}
	
}