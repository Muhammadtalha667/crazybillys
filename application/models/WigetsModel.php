<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WigetsModel extends Ci_Model
{
	function __construct()
	{
		parent::__construct();
		$selected_study = $this->session->userdata('SELECTED_STUDY');
		$this->project = $selected_study['project_id'];
	}
	function totalusers()
	{
		$res = $this->db->select('*')->from('admin_user')->where('project_id',$this->project)->get();
		return $res->num_rows();
	}
	function totalSubject()
	{
		$res = $this->db->query('SELECT count(subject_id) as total FROM `subject` 
		WHERE project_id ='.$this->project.' AND status="enrolled"');
		$result =  $res->result_array();
		return $result[0]['total'];
	}
	function exitSubjects()
	{
		$res = $this->db->query('SELECT count(subject_id) as total FROM `subject` 
		WHERE project_id ='.$this->project.' AND status="screen_only"');
		$result =  $res->result_array();
		return $result[0]['total'];
	}
	function incompleteVisit()
	{
		$res = $this->db->query('SELECT count(id) as total FROM `visit_date_subject` 
		WHERE project_id ='.$this->project.' AND is_completed="pending" AND  confirmation_status="confirm" AND visit_date <= CURRENT_DATE
');
		$result =  $res->result_array();
		return $result[0]['total'];
	}
	function completeVisit()
	{
		$res = $this->db->query('SELECT count(id) as total FROM `visit_date_subject` 
		WHERE project_id ='.$this->project.' AND is_completed!="pending"');
		$result =  $res->result_array();
		return $result[0]['total'];
	}
	function qcoCompleted()
	{
		$res = $this->db->query('SELECT count(visits_status.id) as total FROM `visits_status` INNER JOIN visit_date_subject ON visit_date_subject.id = visits_status.id 
		WHERE visit_date_subject.project_id ='.$this->project.' AND visits_status.qco_oct_status!=0 AND visits_status.qco_cfp_status!=0 AND visits_status.qco_fa_status!=0 AND visits_status.qco_octa_status!=0');
		$result =  $res->result_array();
		return $result[0]['total'];
	}
	function qcoIncompleted()
	{
		$res = $this->db->query('SELECT count(visits_status.id) as total FROM `visits_status` INNER JOIN visit_date_subject ON visit_date_subject.id = visits_status.id 
		WHERE visit_date_subject.project_id ='.$this->project.' AND visit_date_subject.confirmation_status="confirm" AND visit_date_subject.visit_date <= CURRENT_DATE AND ( visits_status.qco_oct_status=0 OR visits_status.qco_cfp_status=0 OR visits_status.qco_fa_status=0 OR visits_status.qco_octa_status=0)');
		$result =  $res->result_array();
		return $result[0]['total'];
	}
	function graderCompleted()
	{
		$res = $this->db->query('SELECT count(visits_status.id) as total FROM `visits_status`  INNER JOIN visit_date_subject ON visit_date_subject.id = visits_status.id 
		WHERE 
			visit_date_subject.project_id ='.$this->project.' 
			AND visit_date_subject.confirmation_status="confirm" 
			AND visits_status.grader1_oct_status=1 AND visits_status.grader1_cfp_status=1

			OR (visits_status.grader2_cfp_status=1 AND visits_status.grader2_oct_status=1
 			AND visit_date_subject.project_id ='.$this->project.' 
			AND visit_date_subject.confirmation_status="confirm")

			OR (visits_status.grader1_fa_status=1 AND visits_status.grader2_fa_status=1
 			AND visit_date_subject.project_id ='.$this->project.'
			AND visit_date_subject.confirmation_status="confirm" )

			OR (visits_status.grader1_octa_status=1 AND visits_status.grader2_octa_status=1
 			AND visit_date_subject.project_id ='.$this->project.'
			AND visit_date_subject.confirmation_status="confirm" )');
		$result =  $res->result_array();
		return $result[0]['total'];
	}
	function graderIncompleted()
	{
		$res = $this->db->query('SELECT count(visits_status.id) as total FROM `visits_status` INNER JOIN visit_date_subject ON visit_date_subject.id = visits_status.id 
			WHERE visit_date_subject.project_id ='.$this->project.' 
			AND visit_date_subject.confirmation_status="confirm" 
			AND visits_status.grader1_oct_status=0 AND visits_status.grader1_cfp_status=0
			OR (visits_status.grader2_cfp_status=0 AND visits_status.grader2_oct_status=0
 			AND visit_date_subject.project_id ='.$this->project.' 
			AND visit_date_subject.confirmation_status="confirm") 

			OR( visits_status.grader1_fa_status=0 AND visits_status.grader2_fa_status=0
 			AND visit_date_subject.project_id ='.$this->project.'
			AND visit_date_subject.confirmation_status="confirm" )

			OR( visits_status.grader1_octa_status=0 AND visits_status.grader2_octa_status=0
 			AND visit_date_subject.project_id ='.$this->project.'
			AND visit_date_subject.confirmation_status="confirm" )');
		$result =  $res->result_array();
		return $result[0]['total'];
	}
	function VisitSubject($take,$skip)
	{
		$date=date('Y-m-d');
		if(isset($take) && isset($skip)){
			$limit = ' limit '.$skip.' , '.$take ;
		}
		$result = $this->db->query('SELECT `visit_date_subject`.`visit_date`,`visit_date_subject`.`is_completed`, `visit`.*, `subject`.`subject_patient_id`, `admin_user`.`name`,`visits_status`.`qco_oct_status`,`visits_status`.`qco_cfp_status`,`visits_status`.`qco_fa_status`,`visits_status`.`grader1_cfp_status`,`visits_status`.`grader1_oct_status`,`visits_status`.`grader2_cfp_status`,`visits_status`.`grader2_oct_status`,`visits_status`.`grader1_id`,`visits_status`.`grader2_id`,`visit_date_subject`.`fp_images`,`visit_date_subject`.`oct_images`,`visit_date_subject`.`fa_images`
		FROM `visit_date_subject`
		INNER JOIN `visit` ON `visit`.`visit_id`=`visit_date_subject`.`visit_id`
		INNER JOIN `subject` ON `subject`.`subject_id`=`visit_date_subject`.`subject_id` 
		INNER JOIN `admin_user` ON `admin_user`.`user_id`=`subject`.`created_by` 
		INNER JOIN `visits_status` ON `visits_status`.`id`=`visit_date_subject`.`id`
		WHERE visit_date_subject.project_id = '.$this->project.' AND visit_date_subject.confirmation_status="confirm" AND visit_date_subject.visit_date <= "'.$date.'"
		ORDER BY `visit_date_subject`.`id` DESC '.$limit);
			//echo $this->db->last_query();exit; 
		return $result->result();
	}
	function totalVisitSubject()
	{
		$date=date('Y-m-d');
		$res = $result = $this->db->query('SELECT `visit_date_subject`.`visit_date`,`visit_date_subject`.`is_completed`, `visit`.*, `subject`.`subject_patient_id`, `admin_user`.`name`,`visits_status`.`qco_oct_status`,`visits_status`.`qco_cfp_status`,`visits_status`.`qco_fa_status`,`visits_status`.`grader1_cfp_status`,`visits_status`.`grader1_oct_status`,`visits_status`.`grader2_cfp_status`,`visits_status`.`grader2_oct_status`,`visits_status`.`grader1_id`,`visits_status`.`grader2_id`,`visit_date_subject`.`fp_images`,`visit_date_subject`.`oct_images`,`visit_date_subject`.`fa_images`
		FROM `visit_date_subject`
		INNER JOIN `visit` ON `visit`.`visit_id`=`visit_date_subject`.`visit_id`
		INNER JOIN `subject` ON `subject`.`subject_id`=`visit_date_subject`.`subject_id`
		INNER JOIN `admin_user` ON `admin_user`.`user_id`=`subject`.`created_by`
		INNER JOIN `visits_status` ON `visits_status`.`id`=`visit_date_subject`.`id`
		WHERE visit_date_subject.project_id = '.$this->project.' AND visit_date_subject.confirmation_status="confirm"AND visit_date_subject.visit_date <= "'.$date.'"
		ORDER BY `visit_date_subject`.`id` DESC ');
		return $res->num_rows();
	}
	function totalVists()
	{
		$date=date('Y-m-d');
		$query = $this->db->select('visit_date_subject.id as total')
				 ->from('visit_date_subject')
				 ->where('project_id',$this->project)
				 ->where('confirmation_status','confirm')
				 ->where('visit_date <=', $date)
				 ->get();
		$result =  $query->result_array();
		return $result[0]['total'];	 
	}
	function adjCompleted()
	{
		$res = $this->db->query('SELECT count(id) as total FROM `adjudicator_verifications` 
		WHERE verification_status="completed"');
		$result =  $res->result_array();
		return $result[0]['total'];;
	}
	function adjIncompleted()
	{
		$res = $this->db->query('SELECT count(id) as total FROM `adjudicator_verifications` 
		WHERE verification_status="pending"');
		$result =  $res->result_array();
		return $result[0]['total'];
	}
	function adjVisits()
	{
		$res = $this->db->query('SELECT vs.*, ad.*
			FROM visit_date_subject as vs 
			INNER JOIN adjudicator_verifications as ad on vs.id=ad.visit_date_id');
		return $res->num_rows();
	}
	function adjVisitSubject($take,$skip)
	{
		$result = $this->db->select('vs.*, vv.*, subj.*,adj.*')
				->from('visit_date_subject  as vs')
				->join ('visit as vv', 'vv.visit_id=vs.id', 'left')
				->join ('subject as subj', 'subj.subject_id=vs.subject_id', 'left')
				->join ('adjudicator_verifications as adj', 'adj.visit_date_id=vs.id', 'inner')
				->where('vs.project_id',$this->project)
				->order_by("vs.id",'DESC')
				->limit($take,$skip)
				->get();
		return $result->result();
	}
	function totaladjVisitSubject()
	{
		$res = $this->db->select('vs.*, vv.*, subj.*,adj.*')
				->from('visit_date_subject  as vs')
				->join ('visit as vv', 'vv.visit_id=vs.id', 'left')
				->join ('subject as subj', 'subj.subject_id=vs.subject_id', 'left')
				->join ('adjudicator_verifications as adj', 'adj.visit_date_id=vs.id', 'inner')
				->where('vs.project_id',$this->project)
				->order_by("vs.id",'DESC')
				->get();
		return $res->num_rows();
	}
	function isGrader()
	{
		$res = $this->db->query("SELECT count(visit_date_subject.id) as total FROM `visit_date_subject` WHERE is_completed='completed_by_grader_entry' AND project_id=".$this->project."");
		$result =  $res->result_array();
		return $result[0]['total'];
	}
	function isAdj()
	{
		$res = $this->db->query("SELECT count(visit_date_subject.id) as total FROM `visit_date_subject` WHERE is_completed='updated_completed_by_adjudicator' AND project_id=".$this->project."");
		$result =  $res->result_array();
		return $result[0]['total'];
	}
	function totalExpectedCFP()
	{
		$res = $this->db->query("SELECT count(visit_date_subject.id) as total
			FROM visit_date_subject 
		 	WHERE confirmation_status ='confirm' 
		 	AND fp_form_status ='Active'
		 	AND project_id = ".$this->project." 
		 	group by id");
			$result =  $res->result_array();
			return $result[0]['total'];
	}
	function totalExpectedOCT()
	{
		$res = $this->db->query("SELECT count(visit_date_subject.id) as total
			FROM visit_date_subject  
		 	WHERE confirmation_status ='confirm' 
		 	AND oct_form_status ='Active'
		 	AND project_id=".$this->project." 
		 	group by id");
			$result =  $res->result_array();
			return $result[0]['total'];
	}
	function totalExpectedFA()
	{
		$res = $this->db->query("SELECT count(visit_date_subject.id) as total
			FROM visit_date_subject  
		 	WHERE confirmation_status ='confirm' 
		 	AND fa_form_status ='Active'
		 	AND project_id=".$this->project." 
		 	group by id");
			$result =  $res->result_array();
			return $result[0]['total'];;
	}
	function imagesReceivedCFP()
	{
		$res = $this->db->query("SELECT count(visit_date_subject.id) as total
			FROM visit_date_subject as vs 
		 	WHERE confirmation_status ='confirm' 
		 	AND fp_form_status ='Active'
		 	AND fp_images ='received'
		 	AND project_id=".$this->project." 
		 	group by id");
			$result =  $res->result_array();
			return $result[0]['total'];
	}
	function imagesReceivedOCT()
	{
		$res = $this->db->query("SELECT count(visit_date_subject.id) as total
			FROM visit_date_subject as vs 
		 	WHERE confirmation_status ='confirm' 
		 	AND oct_form_status ='Active'
		 	AND oct_images ='received'
		 	AND project_id=".$this->project." 
		 	group by id");
			$result =  $res->result_array();
			return $result[0]['total'];
	}
	function imagesReceivedFA()
	{
		$res = $this->db->query("SELECT count(visit_date_subject.id) as total
			FROM visit_date_subject as vs 
		 	WHERE confirmation_status ='confirm' 
		 	AND fa_form_status ='Active'
		 	AND fa_images ='received'
		 	AND project_id=".$this->project." 
		 	group by id");
			$result =  $res->result_array();
			return $result[0]['total'];
	}
	function qcOCT()
	{
		$res = $this->db->query("SELECT vs.*, status.*
			FROM visit_date_subject as vs 
			INNER JOIN visits_status as status on vs.id=status.id
		 	WHERE vs.confirmation_status ='confirm' 
		 	AND vs.oct_form_status ='Active'
		 	AND vs.oct_images ='received'
		 	AND status.qco_oct_status != 0
		 	AND vs.project_id=".$this->project."
		 	group by vs.id");
			return $res->num_rows();
	}
	function qcCFP()
	{
		$res = $this->db->query("SELECT vs.*, status.*
			FROM visit_date_subject as vs 
			INNER JOIN visits_status as status on vs.id=status.id
		 	WHERE vs.confirmation_status ='confirm' 
		 	AND vs.fp_form_status ='Active'
		 	AND vs.fp_images ='received'
		 	AND status.qco_cfp_status != 0
		 	AND vs.project_id=".$this->project."
		 	group by vs.id");
			return $res->num_rows();
	}
	function qcFA()
	{
		$res = $this->db->query("SELECT vs.*, status.*
			FROM visit_date_subject as vs 
			INNER JOIN visits_status as status on vs.id=status.id
		 	WHERE vs.confirmation_status ='confirm' 
		 	AND vs.fa_form_status ='Active'
		 	AND vs.fa_images ='received'
		 	AND status.qco_fa_status != 0
		 	AND vs.project_id=".$this->project."
		 	group by vs.id");
			return $res->num_rows();
	}
	function gradedCFP()
	{
		$res = $this->db->query("SELECT vs.*, status.*
			FROM visit_date_subject as vs 
			INNER JOIN visits_status as status on vs.id=status.id
		 	WHERE vs.confirmation_status ='confirm' 
		 	AND vs.fa_form_status ='Active'
		 	AND vs.fa_images ='received'
		 	AND status.grader1_cfp_status != 0
		 	AND status.grader2_cfp_status != 0
		 	AND vs.project_id=".$this->project."
		 	group by vs.id");
			return $res->num_rows();
	}
	function gradedOCT()
	{
		$res = $this->db->query("SELECT vs.*, status.*
			FROM visit_date_subject as vs 
			INNER JOIN visits_status as status on vs.id=status.id
		 	WHERE vs.confirmation_status ='confirm' 
		 	AND vs.oct_form_status ='Active'
		 	AND vs.oct_images ='received'
		 	AND status.grader1_oct_status != 0
		 	AND status.grader2_oct_status != 0
		 	AND vs.project_id=".$this->project."
		 	group by vs.id");
			return $res->num_rows();
	}
	function gradedFA()
	{
		$res = $this->db->query("SELECT vs.*, status.*
			FROM visit_date_subject as vs 
			INNER JOIN visits_status as status on vs.id=status.id
		 	WHERE vs.confirmation_status ='confirm' 
		 	AND vs.fa_form_status ='Active'
		 	AND vs.fa_images ='received'
		 	AND status.grader1_fa_status != 0
		 	AND status.grader2_fa_status != 0
		 	AND vs.project_id=".$this->project."
		 	group by vs.id");
			return $res->num_rows();
	}
	function queriesCFP()
	{
		 $res = $this->db->query("SELECT * FROM queries  
		 	WHERE imaging_modality ='CFP' 
		 	AND status != 'close_resolved'
		 	AND project_id=".$this->project." 
		 	group by reference");
		    return $res->num_rows();
	}
	function queriesOCT()
	{
		 $res = $this->db->query("SELECT * FROM queries  
		 	WHERE imaging_modality ='OCT' 
		 	AND status != 'close_resolved'
		 	AND project_id=".$this->project." 
		 	group by reference");
		    return $res->num_rows();
	}
	function queriesFA()
	{
		 $res = $this->db->query("SELECT * FROM queries  
		 	WHERE imaging_modality ='FA' 
		 	AND status != 'close_resolved'
		 	AND project_id=".$this->project." 
		 	group by reference");
		    return $res->num_rows();
	}
}