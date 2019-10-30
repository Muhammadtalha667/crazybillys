<?php
class CommonFunctions {
	public function __construct() {	
	  error_reporting(1);	
	  $CI =& get_instance();		
	  $selected_study = $CI->session->userdata('SELECTED_STUDY');
	  $CI->project = $selected_study['project_id'];	
}

public function get_missmatch_array_new($array1,$array2){
		foreach($array1 as $key=>$val) {
		//$current_index = $key;
		$check_key = array_key_exists ($key,$array2);
		if($check_key){
			if($val['answer_od']!=$array2[$key]['answer_od']){
			 	$miss_match_index[$val['question_id']] = 1;
			 	$miss_match_grader1_od[$val['question_id']] = $val['answer_od'];
			 	$miss_match_grader2_od[$val['question_id']] = $array2[$key]['answer_od'];
			}
			if($val['answer_os']!=$array2[$key]['answer_os']){
			 	$miss_match_index[$val['question_id']] = 1;
			 	$miss_match_grader1_os[$val['question_id']] = $val['answer_os'];
			 	$miss_match_grader2_os[$val['question_id']] = $array2[$key]['answer_os'];
			}
		}
	}
	return  array('miss_match_index'=>$miss_match_index,'miss_match_grader1_od'=>$miss_match_grader1_od,'miss_match_grader2_od'=>$miss_match_grader2_od,'miss_match_grader1_os'=>$miss_match_grader1_os,'miss_match_grader2_os'=>$miss_match_grader2_os);
}

public function get_missmatch_array($array1,$array2){
	foreach($array1 as $key=>$val) {
		$current_index = $key;
		$check_key = array_key_exists ($key,$array2);
		if($check_key){
			if($val!=$array2[$key]){
			 	$miss_match_index[$key] = 1;
			 	$miss_match_grader1[$key] = $val;
			 	$miss_match_grader2[$key] = $array2[$key];
			}
		}
	}
	return  array('miss_match_index'=>$miss_match_index,'miss_match_grader1'=>$miss_match_grader1,'miss_match_grader2'=>$miss_match_grader2);
	}
	function get_inserted_fields_od_os($questions,$POST)
	{
		extract($POST);
		$insert_html = "<table class=activity_table border=1><tr><th>Questions</th><th>OD Data</th><th>OS Data</th></tr>";
		for($i=0;$i<sizeof($questions);$i++) {
			$answer_od = $_POST['question_'.$questions_id[$i].'_od'];
			$answer_os = $_POST['question_'.$questions_id[$i].'_os'];
			$insert_html .= "<tr><td>".$questions[$i]."</td><td>".$answer_od."</td><td>".$answer_os."</td></tr>";
		}
		$insert_html .="</table>";
		return $insert_html;
	}
	// maping fields inserted
	function get_inserted_fields($post_data){
		$CI = get_instance();
		$CI->lang->load('qco_lang','english');
		$CI->lang->load('Adjudicator_lang','english');
		$CI->lang->load('grader_lang','english');
		$CI->lang->load('subject_lang','english');
		$CI->lang->load('visit_date_subject_lang','english');
		$insert_html = "<table class=activity_table border=1><tr><th>Fields</th><th>Data</th></tr>";
		foreach($post_data as $key=>$val) {
				$insert_html .= "<tr><td>".$CI->lang->line($key)."</td><td>".$val."</td></tr>";
		}
		$insert_html .="</table>";
		return $insert_html;		
	}
	// maping changes with old feld data
	function get_updated_fields($post_data,$previous_result){
		$CI = get_instance();
		$CI->lang->load('qco_lang','english');
		$CI->lang->load('transmission_lang','english');
		$CI->lang->load('Adjudicator_lang','english');
		$CI->lang->load('grader_lang','english');
		$CI->lang->load('subject_lang','english');
		$CI->lang->load('visit_date_subject_lang','english');		
		$updates_html = "<table class=activity_table border=1><tr><th>Fields</th><th>Previous Data</th><th>Updated Data</th></tr>";
		foreach($previous_result as $key=>$val) {
   			$updating_key = $key;
			$check_key = array_key_exists ($key,$post_data);
			if($check_key){
				 if($val!=$post_data[$key]){
						$updates_html .= "<tr><td>".$CI->lang->line($key)."</td><td>".$val."</td><td>".$post_data[$key]."</td></tr>";
				 }
			}
		}
		$updates_html .="</table>";
		return $updates_html;		
	}	
// maping od / os changes with old feld data
	function get_updated_fields_od_os($questions,$POST,$previous_data_this_visit){
		

		extract($POST);
		$updates_html = "<table class=activity_table border=1><tr><th>Questions</th><th>Previous Data OS</th><th>Updated Data OS</th><th>Previous Data OD </th><th>Updated Data OD</th></tr>";
		$j = 0;
		for($i=0;$i<sizeof($questions);$i++) {			
			$updates_html .= "<tr><td>".$questions[$i]."</td>";
			$answer_od = $_POST['question_'.$questions_id[$i].'_od'];
			$answer_os = $_POST['question_'.$questions_id[$i].'_os'];
			$previous_answer_od=''; $previous_answer_os='';
			foreach($previous_data_this_visit as $previous_data){
				 if($previous_data['question_id']==$questions_id[$i]){
				 			$previous_answer_od = $previous_data['answer_od'];
				 			$previous_answer_os = $previous_data['answer_os'];
					break;
				 }
			}
			
			$updates_html .= "<td>".$previous_answer_os."</td>";
			$updates_html .= "<td>".$answer_os."</td>";
			$updates_html .= "<td>".$previous_answer_od."</td>";
			$updates_html .= "<td>".$answer_od."</td>";
			$updates_html .= "</tr>";
		$j++;	
		}
		$updates_html .="</table>";
		return $updates_html;		
	}
	function sendMail_registration($email,$random_password,$id)
	{
		 $config = Array(
              'protocol' => 'smtp',
              'smtp_host' => 'ssl://smtp.googlemail.com',
              'smtp_port' => 465,
              'smtp_user' => '',
              'smtp_pass' => ''
   		 );
    	$this->load->library('email',$config);
		$from_email = "ahmadwaqas562@gmail.com"; 
		$url = base_url()."Login/changePass/".$id."";
	        $pass = $random_password;
		    $this->email->set_newline("\r\n");
			$this->email->from("ahmadwaqas562@gmail.com");
			$this->email->to($email);
	        $this->email->subject('Change Password'); 
	        $this->email->message('Dear User your password is "'.$pass.'" if you need to update your password click on link  "'.$url.'" '); 
		
			if($this->email->send())
			{
	        	$this->session->set_flashdata("email_sent","Email sent successfully."); 
			} else {
				$this->session->set_flashdata("email_sent","Error in sending Email.".show_error($this->email->print_debugger())); 

			}
		
	}

	function get_visit_subject_details($visit_date_id)
	{
		$CI =& get_instance();
		$CI->load->model('UserModel');
		$qry = $CI->db->query('SELECT subject.subject_patient_id,subject.enrolment_date,visit.visit_title,visit_date_subject.visit_date,project.project_title,admin_user.name,preferences.address ,preferences.email,preferences.reply_to
		
		FROM `visit_date_subject` 
		INNER JOIN subject ON subject.subject_id= visit_date_subject.subject_id 
		INNER JOIN visit ON visit.visit_id = visit_date_subject.visit_id 
		INNER JOIN project ON project.project_id = visit_date_subject.project_id 
		INNER JOIN admin_user ON admin_user.user_id = subject.created_by 
		INNER JOIN preferences on preferences.project_id = visit_date_subject.project_id 
		WHERE visit_date_subject.id = "'.$visit_date_id.'" 
		AND visit_date_subject.project_id = "'.$CI->project.'" ');
		
		return $qry->row_array();
	}
	function send_link_to_reply_query($query_id,$site_email,$name,$query_reply_code,$PM_email='',$cc='')
	{	
		//echo $PM_email; exit;
		$url = base_url();
		$CI =& get_instance();
		$CI->load->model('QueryModel');
		$CI->load->model('GeneralModel');
	    $CI->load->library('slack');
	    $confg = $this->config_array_gmail();
		$slack_channel = $confg['slack_channel']; 
		$query_details = $CI->QueryModel->get_query_record('queries','query_id',$query_id);
		$details_transmission = $CI->GeneralModel->get_record('transmissions','Transmission_Number',$query_details[0]['reference']);
	
		$conversation = $CI->QueryModel->getVisitConversation($query_id);
		
		$chatt='';
		foreach($conversation as $value){
            $chatt .= '<small><b>'.ucfirst($value['first_name']).' '.ucfirst($value['last_name']).'</b> '.date('h:i:sa',strtotime($value['created_date'])).'</small>: '.$value['comments'].'<br>';
		}

	
		$warning_html_no_reply = '<h1 style="text-align: center; font-size: 20px; line-height: 28px; font-family: Arial, sans-serif;"><span style="color:red;"><strong>Attention! This is system generated email, Please do not reply to it.</strong></span></h1>';

		if($query_reply_code == 'notify'){
			$subject = 'Query-'.$query_id.' responce submited'. '-' .'Transmission Number:'.$details_transmission[0]['Transmission_Number'];
			$message = 'Dear '.$name.' ,<br>
					Responce submited successfully for Query-'.$query_id.' at '.$details_transmission[0]['Study_Name'].' EDC . Below are the details of the query created.<br><br>
					Query Id: '.$query_id.' <br>
					Subject ID: '.$details_transmission[0]['Subject_ID'].' <br>
					Visit Name: '.$details_transmission[0]['visit_name'].' <br>
					Imaging Modality: '.$details_transmission[0]['ImageModality'].' <br>
					Visit Date: '.$details_transmission[0]['visit_date'].' <br>
					Query Created By: '.$query_details[0]['first_name'].'  '.$query_details[0]['last_name'].' <br><br>
					<b>Query Details:</b> <br>
					'.$chatt.'
					<br>
					'.$warning_html_no_reply.'
					Best wishes,
					*OIRRC Team*
					';
					$subject_PM = 'Query-'.$query_id.' responce submited'. '-' .'Transmission Number:'.$details_transmission[0]['Transmission_Number'];
			$message_PM = 'Dear Project Manager ,<br>
					Responce submited successfully for Query-'.$query_id.' at '.$details_transmission[0]['Study_Name'].' EDC . Below are the details of the query created.<br><br>
					Query Id: '.$query_id.' <br>
					Subject ID: '.$details_transmission[0]['Subject_ID'].' <br>
					Visit Name: '.$details_transmission[0]['visit_name'].' <br>
					Imaging Modality: '.$details_transmission[0]['ImageModality'].' <br>
					Visit Date: '.$details_transmission[0]['visit_date'].' <br>
					Query Created By: '.$query_details[0]['first_name'].'  '.$query_details[0]['last_name'].' <br><br>
					<b>Query Details:</b> <br>
					'.$chatt.'
					<br>
					'.$warning_html_no_reply.'
					Best wishes,
					*OIRRC Team*
					';

				$slac_msg = strip_tags('Query-'.$query_id.' responce submited'. '-' .'Transmission Number:'.$details_transmission[0]['Transmission_Number']);

		}else{
			$html_reply_button = '<div align=center><a href="'.$url.'QueryConversation/reply/'.$query_reply_code.'" style=" background: #80bf2e; color:#fff;border-radius: 3px;display: inline-block;font-size: 14px;font-weight: bold;line-height: 24px;padding: 6px 12px;text-align: center;text-decoration: none !important;">Reply Link</a></div>';

			$subject = 'New Query-'.$query_id. '-' .'Regarding Transmission Number:'.$details_transmission[0]['Transmission_Number']. ' Created';
			$message = 'Dear '.$name.' ,<br>
					A New query OR a new update to a previous query is created at '.$details_transmission[0]['Study_Name'].' EDC and needs your urgent attention. Below are the details of the query created.<br><br>
					Query Id: '.$query_id.' <br>
					Subject ID: '.$details_transmission[0]['Subject_ID'].' <br>
					Visit Name: '.$details_transmission[0]['visit_name'].' <br>
					Imaging Modality: '.$details_transmission[0]['ImageModality'].' <br>
					Visit Date: '.$details_transmission[0]['visit_date'].' <br>
					Query Created By: '.$query_details[0]['first_name'].'  '.$query_details[0]['last_name'].' <br><br>
					<b>Query Details:</b> <br>
					'.$chatt.'
					<br>
					'.$warning_html_no_reply.'
					<div align=center>To reply this query, click on below link .</div>
					<br>
					'.$html_reply_button.'
					<br><br>
					<div align=center>OR copy this link and paste it in your browser<br>
					'.$url.'QueryConversation/reply/'.$query_reply_code.' <br><br></div>

					Best wishes,
					*OIRRC Team*
					';
					$subject_PM = 'New Query-'.$query_id. '-' .'Regarding Transmission Number:'.$details_transmission[0]['Transmission_Number']. ' Created';
			$message_PM = 'Dear Project Manager,<br>
					A New query OR a new update to a previous query is created at '.$details_transmission[0]['Study_Name'].' EDC and needs your urgent attention. Below are the details of the query created.<br><br>
					Query Id: '.$query_id.' <br>
					Subject ID: '.$details_transmission[0]['Subject_ID'].' <br>
					Visit Name: '.$details_transmission[0]['visit_name'].' <br>
					Imaging Modality: '.$details_transmission[0]['ImageModality'].' <br>
					Visit Date: '.$details_transmission[0]['visit_date'].' <br>
					Query Created By: '.$query_details[0]['first_name'].'  '.$query_details[0]['last_name'].' <br><br>
					<b>Query Details:</b> <br>
					'.$chatt.'
					<br>
					'.$warning_html_no_reply.'
					Best wishes,
					*OIRRC Team*
					';
					$slac_msg = strip_tags('New Query-'.$query_id. '-' .'Regarding Transmission Number:'.$details_transmission[0]['Transmission_Number']. ' Created');
				
		}
		$CI->slack->send_slack_msg($slac_msg,$slack_channel);
	  	$CI->load->library('email');
		$CI->email->initialize($confg);
		$CI->email->set_mailtype("html");
		$CI->email->set_newline("\r\n");
		$to=$site_email;
		$CI->email->from($gmail_id,'OIRRC: Project '.trim($details_transmission[0]['Study_Name']));
		$CI->email->to($to);
		$CI->email->cc($cc);
		$CI->email->subject($subject);
		$CI->email->message($message);
		$CI->load->library('encrypt');
		$CI->email->send();

		if(isset($PM_email) && $PM_email!=''){
			$CI->load->library('email');
			$CI->email->initialize($confg);
			$CI->email->set_mailtype("html");
			$CI->email->set_newline("\r\n");
			//$to='ahmadwaqas562@gmail.com';
			$CI->email->from($gmail_id,'OIRRC: Project '.trim($details_transmission[0]['Study_Name']));
			$CI->email->to($PM_email);
			$CI->email->subject($subject_PM);
			$CI->email->message($message_PM);
			$CI->load->library('encrypt');
			$CI->email->send();
			/*if($CI->email->send()){ echo 'mail send';}
			exit;*/
		}
		exit;
	}

	function send_query_email_to_PM($PM_email,$query_id,$email_type='query_open')
	{
		$CI =& get_instance();
		$CI->load->model('QueryModel');
		$CI->load->model('GeneralModel');
		$query_details = $CI->QueryModel->get_query_record('queries','query_id',$query_id);
		$details_transmission = $CI->GeneralModel->get_record('transmissions','Transmission_Number',$query_details[0]['reference']);
		$projectName = $CI->GeneralModel->get_record('project','project_id',$CI->project);
		$conversation = $CI->QueryModel->getVisitConversation($query_id);
		$chatt='';
		foreach($conversation as $value){
            $chatt .= '<small><b>'.ucfirst($value['first_name']).' '.ucfirst($value['last_name']).'</b> '.date('h:i:sa',strtotime($value['created_date'])).'</small>: '.$value['comments'].'<br>';
		}$confg = $this->config_array_gmail();
		if($email_type=='query_open'){
		$subject = 'New Query-'.$query_id. '-' .'Regarding Transmission Number:'.$details_transmission[0]['Transmission_Number']. ' Created';
		$message = 'Dear Sir ,<br>
					A New query OR a new update to a previous query is created at '.$projectName[0]['project_title'].'. Below are the details of the query created.<br><br>
					Subject ID: '.$details_transmission[0]['Subject_ID'].' <br>
					Visit Name: '.$details_transmission[0]['visit_name'].' <br>
					Imaging Modality: '.$details_transmission[0]['ImageModality'].' <br>
					Visit Date: '.$details_transmission[0]['visit_date'].' <br>
					Query Created By: '.$query_details[0]['first_name'].'  '.$query_details[0]['last_name'].' <br><br>
					<b>Query Details:</b> <br>
					'.$chatt.'
					<br>

					Best wishes,
					*OIRRC Team*
					';
				}else if($email_type=='query_responce'){

				}
	     $CI->load->library('email');
		$CI->email->initialize($confg);
		$CI->email->set_mailtype("html");
		$CI->email->set_newline("\r\n");
		$CI->email->to($PM_email);
		$CI->email->from($gmail_id,'OIRRC: Project '.$projectName[0]['project_title']);
		$CI->email->subject($subject);
		$CI->email->message($message);
		$CI->load->library('encrypt');
		$CI->email->send();
	}
	function config_array_gmail($email='',$pass='')
	{
		$CI =& get_instance();
		$CI->load->model('UserModel');
		$project = $CI->UserModel->get_email();
		$email = $project['email'];
		$pass = $project['password'];
		$config = array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => $email,
		  'smtp_pass' => $pass,
		  'mailtype'  => 'html',
		  'charset'   => 'utf-8',
		  'slack_channel' => $project['slack_channel'],
		  'reply_to' => $project['reply_to'],
			);
		return $config;
	}
	 function decryptIt($q) {
	
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    }
     function encryptIt($q) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }

}