<?php
/**
* This class is used to handle the customer related info.
*/
class Frontendmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function FetchQuestions($p_Level)
	{
		$strQuery = 'SELECT * FROM aims_questions WHERE active = 1 AND questionlevel = '.$p_Level.'';

		$objQuery = $this->db->query($strQuery);

		if($objQuery->num_rows())
		{
			return $objQuery->result_array();
		}else
		{
			return array();
		}
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

		$result = $this->db->insert('aims_user_answers', $arrData);

		return $result;

	}

	function FetchResult()
	{
		$strQuery = "SELECT userid,questionid,includeinscoring, optionid, answer, IF(optionid = answer, 1,0) AS result FROM aims_user_answers ua
			INNER JOIN aims_questions q ON q.id = ua.`questionid`
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
}
?>