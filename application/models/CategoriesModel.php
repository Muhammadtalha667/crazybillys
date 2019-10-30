<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CategoriesModel extends Ci_Model
{
	function __construct() 
	{
		parent::__construct();
	}
	function CategoryList()
	{
		extract($_GET);
		$where = '';
		if($keyword!=''){
			$where = " where title like '%". $keyword."%'";
		}
		if(isset($take) && isset($skip)){
			$limit = ' limit '.$skip.' , '.$take ;
		}else{$limit='';}
	   	$qry = $this->db->query('select * from category'.$where. ''.$limit);
		return $qry->result();
	}
	function totalCategory()
	{
		extract($_GET);
		$where = '';
		if($keyword!=''){
			$where = " where title like '%". $keyword."%'";
		}
	   	$qry = $this->db->query('select * from category'.$where);
		return $qry->num_rows();
	}
	
	function SubCategoryList()
	{
		extract($_GET);
		$where = '';
		if($keyword!=''){
			$where = " where title like '%". $keyword."%'";
		}
		if(isset($take) && isset($skip)){
			$limit = ' limit '.$skip.' , '.$take ;
		}else{$limit='';}
	   	$qry = $this->db->query('select * from sub_category'.$where. ''.$limit);
		return $qry->result();
	}
	function totalSubCategory()
	{
		extract($_GET);
		$where = '';
		if($keyword!=''){
			$where = " where title like '%". $keyword."%'";
		}
		
	   	$qry = $this->db->query('select * from sub_category'.$where);
		return $qry->num_rows();
	}
}