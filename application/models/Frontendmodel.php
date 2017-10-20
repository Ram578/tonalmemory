<?php
/**
* This class is used to handle the customer related info.
*/
class Frontendmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('date');
	}

	/*function FetchQuestions($p_Level)
	{
		$strQuery = 'SELECT * FROM tonal_questions WHERE active = 1 AND questionlevel = '.$p_Level.'';

		$objQuery = $this->db->query($strQuery);

		if($objQuery->num_rows())
		{
			return $objQuery->result_array();
		}else
		{
			return array();
		}
	}*/
	
	function FetchQuestions($p_Level)
	{
		$sql = 'SELECT * FROM tonal_questions_order WHERE type="questions"';

		$result = $this->db->query($sql);
		
		// Check the tonal_questions_order table have sorted questions or not.
		if($result->num_rows() > 0) 
		{
			$row = $result->row();
			
			$obj = unserialize($row->question_order);
			
			$array['order'] = $obj;
		}
		
		$strQuery = 'SELECT * FROM tonal_questions WHERE active = 1 AND questionlevel = '.$p_Level.'';

		$objQuery = $this->db->query($strQuery);

		$array['test'] = $objQuery->result_array();
		
		return $array;	
	}
	
	//Get the subscores data from tonal_subscores table
	function fetch_subscores() 
	{
		$sql = 'SELECT * FROM tonal_subscores where subscore_status = 1';

		$result = $this->db->query($sql);
		
		$rows = $result->result_array();
		$subscores_data = array(); 
		
		foreach($rows as $row) {
			// $row['subscore_status'] = $subscore_status;
			$score_range = explode("-", $row['score_range']);
		
			$row['min_score'] = $score_range[0];
			$row['max_score'] = isset($score_range[1])? $score_range[1] : "";
			
			// $rowsubscore_status
			$subscores_data[] = $row;
		}
		// var_dump($subscores_data);
		return $subscores_data;
		
		// $score_array = array();
		// $score_arr = array_push($score_array, $score_data);
		// var_dump($score_arr);
		
		// $row = $result->row_array();
				
		// $score_range = explode("-", $row['score_range']);
		
		// $row['min_score'] = $score_range[0];
		// $row['max_score'] = isset($score_range[1])? $score_range[1] : "";
		
		//return $row;
	}
	
	function fetch_subscores_status() 
	{
		$sql = "SELECT subscore_check FROM tonal_subscore_checkbox WHERE id=1";
		
		$objQuery = $this->db->query($sql);

		return $objQuery->row_array();
	}

	function SaveUserAnswer()
	{
		$intQuestionID = $_POST['questionid'];

		$intSelectedOption = $_POST['selectedoption'];

		$arrData = array(
			'userid'  => $this->session->userdata('UserID'), 
			'questionid'  => $intQuestionID,
			'optionid' => $intSelectedOption,
			'addeddate'	    => date('Y-m-d H:m:s'),
		);

		$result = $this->db->insert('tonal_user_answers', $arrData);

		return $result;

	}

	function FetchResult()
	{
		$strQuery = "SELECT userid,questionid,includeinscoring, optionid, answer, IF(optionid = answer, 1,0) AS result FROM tonal_user_answers ua
			INNER JOIN tonal_questions q ON q.id = ua.`questionid`
			WHERE userid = ".$this->session->userdata('UserID');
			
		$objQuery = $this->db->query($strQuery);

		if($objQuery->num_rows())
		{
			return $objQuery->result_array();
		}else
		{
			return array();
		}
	}
	
	//Save the user tonal test completed date in users table after the exam is completed.
	function update_test_completed_date()
	{
		$status = $_POST['test_status'];
		$user_id = $this->session->userdata('UserID');	
		
		//Check and save for next -> 1 and for more examples -> 2
		if($status == "completed") 
		{
			$timestamp = time();
			$date_format = date("Y-m-d H:i:s", $timestamp);
			$this->db->where('id', $user_id);
			$this->db->update('users', array('tonal_completed_date' => $date_format));
		} 
	}
}
?>