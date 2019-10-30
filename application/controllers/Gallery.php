<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery extends MY_Controller {
	function __construct()
	{
		parent::__construct();
	}
	function Main()
	{
		$data['page'] = 'gallery/gallery';
		$this->load->view('common/template', $data);
	}
	function getGalleryList()
	{
		$list = $this->GalleryModel->GalleryList();
		$total = $this->GalleryModel->totalGallery();
		echo "{\"total\":".$total.",\"data\":" .json_encode($list). "}";
	}
	function insertGallery()
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
		}else if($image =='' && $gallery_id !='')
		{
			$image = $this->GeneralModel->get_column('gallery',array('gallery_id' => $gallery_id),'image');
		}
		$data  = array(
			'title' => $title, 
			'image' => $image 
		);
		if($gallery_id ==''){
			$this->GeneralModel->add('gallery', $data);
			$this->session->set_flashdata('msg','Gallery added successfully');
		}else{
			$this->GeneralModel->update('gallery', $data,'gallery_id',$gallery_id);
			$this->session->set_flashdata('msg','Gallery updated successfully');
		}	
		redirect('Gallery/Main');
	}
	function deleteGallery()
	{
		extract($_POST);
		$this->GeneralModel->delete('gallery','gallery_id',$gallery_id);
	}
}

?>