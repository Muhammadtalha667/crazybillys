<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
// ====================================================//
		// function to view data in pre formate form and die
//=====================================================//
if(!function_exists('vd'))
{
	function vd($data = '')
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		die;
	}
}
//=========================================================//
		// login user id stored in session
//==========================================================//
if(!function_exists('user_session_id'))
{
	function user_session_id()
	{
		$CI = get_instance();
		$session = $CI->session->userdata('U_SESS_DATA');
		return $session['UID'];
	}
}
//==========================================================//
	//
//===========================================================//
if(!function_exists('check_user_status'))
{
	function check_user_Status()
	{
		$CI = get_instance();
		$CI->db->where('LID',user_session_id());
		$data = $CI->db->get('login');
		$res = $data->row_array();
		return $res['IS_ACTIVE'];
	}
}


function get_sub_permissions_controller($permissions,$parent_id){
		foreach($permissions as $sub_menu){
                if($sub_menu['parent_menu']!=0 && $sub_menu['parent_menu']==$parent_id){
                	$controllers[] = $sub_menu['controller'];
                	foreach($permissions as $sub_child){
                		if($sub_child['parent_menu']!=0 && $sub_child['parent_menu']==$sub_menu['id']){
                			$controllers[] = $sub_child['controller'];
                		}
                	}

                }
        }
        return $controllers;
}


function get_sub_permissions_method($permissions,$parent_id){
		foreach($permissions as $sub_menu){
                if($sub_menu['parent_menu']!=0 && $sub_menu['parent_menu']==$parent_id){
                	$method[] = $sub_menu['action'];
                	foreach($permissions as $sub_child){
                		if($sub_child['parent_menu']!=0 && $sub_child['parent_menu']==$sub_menu['id']){
                			$method[] = $sub_child['action'];
                		}
                	}

                }
        }
        return $method;
}

function rendar_access($access_type,$allowed_html,$denied_html){

	$CI = get_instance();
	$session = $CI->session->userdata('U_SESS_DATA');
	$permissions = $session['permissions'];
	$current_controller =$CI->router->fetch_class();
    $current_method =$CI->router->fetch_method();

	foreach($permissions as $permission){
		
       if($current_controller==$permission['controller'] && $current_method==$permission['action']){
       		$sub_permissions = explode(',',$permission['sub_permissions']);
       		if($permission['sub_permissions']!='' && sizeof($sub_permissions)>0 && in_array($access_type,$sub_permissions)){
       			echo $allowed_html;
       			return true;
       		}
		}
    }
    echo $denied_html;
	return true;
}
?>