<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProductsModel extends Ci_Model
{
	function __construct()
	{
		parent::__construct();
		
	}
	function ProductsList()
	{
		extract($_GET);
		$where = '';
		if($keyword!=''){
			$where = "pds.title like '%". $keyword."%'";
		}
		$this->db->select('pds.*,sbc.title as sub_cat_name,sbc.sub_cat_id');
		$this->db->from('products as pds');
		$this->db->join('sub_category as sbc', 'pds.sub_cat_id = sbc.sub_cat_id', 'inner');
		if($keyword !=''){
			$this->db->where($where);
		}
		$this->db->limit($take,$skip);
		$query = $this->db->get();
				return $query->result();
	}
	function totalProducts()
	{
		extract($_GET);
		$where = '';
		if($keyword!=''){
			$where = "pds.title like '%". $keyword."%'";
		}
		$this->db->select('pds.*,sbc.title as sub_cat_name,sbc.sub_cat_id');
		$this->db->from('products as pds');
		$this->db->join('sub_category as sbc', 'pds.sub_cat_id = sbc.sub_cat_id', 'inner');
		if($keyword !=''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	function Products_SubCategory($id)
	{
		$query=$this->db->query("SELECT products.*,sub_category.title as sub_category_title FROM `products` JOIN sub_category on sub_category.sub_cat_id=products.sub_cat_id WHERE products.sub_cat_id='$id'");
				return $query->result_array();
	}
	function total_SubCategory($id){
		$query=$this->db->query("SELECT products.*,sub_category.title as sub_category_title FROM `products` JOIN sub_category on sub_category.sub_cat_id=products.sub_cat_id WHERE products.sub_cat_id='$id'");
		return $query->num_rows();
	}
	function Products_specials()
	{
		$query=$this->db->query("SELECT products.*,sub_category.title as sub_category_title FROM `products` JOIN sub_category on sub_category.sub_cat_id=products.sub_cat_id WHERE products.type='special'");
		  return $query->result_array();
	}
}