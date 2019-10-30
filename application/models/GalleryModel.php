<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GalleryModel extends Ci_Model
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
	
	function GalleryList()
	{
		extract($_GET);
		$where = '';
		if($keyword!=''){
			$where = " where title like '%". $keyword."%'";
		}
		if(isset($take) && isset($skip)){
			$limit = ' limit '.$skip.' , '.$take ;
		}else{$limit='';}
	   	$qry = $this->db->query('select * from gallery'.$where. ''.$limit);
		return $qry->result();
	}
	function totalGallery()
	{
		extract($_GET);
		$where = '';
		if($keyword!=''){
			$where = " where title like '%". $keyword."%'";
		}
		
	   	$qry = $this->db->query('select * from gallery'.$where);
		return $qry->num_rows();
	}
}