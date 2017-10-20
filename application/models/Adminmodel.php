<?php
/**
* This class is used to handle the customer related info.
*/
class Adminmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	function Login()
	{
		if(sizeof($_POST) > 0)
		{
			
			$strUserName = $_POST['userame'];

			$strPassword = md5($_POST['password']);

			$strQuery = 'SELECT * FROM employees WHERE username LIKE "'.$strUserName.'"';

			$objQuery = $this->db->query($strQuery);

			if($objQuery->num_rows() > 0)
			{
				$arrResult = $objQuery->result_array();

				$arrEmployee = $arrResult[0];

				if($arrEmployee['passwd'] == $strPassword && $arrEmployee['active'] == 1)
				{
					$this->session->set_userdata('EmployeeID', $arrEmployee['id']);

					$this->session->set_userdata('EmployeeFName', $arrEmployee['firstname']);

					$this->session->set_userdata('EmployeeLName', $arrEmployee['lastname']);
					
					$this->session->set_userdata('EmployeeRole', $arrEmployee['role']);

					return 1;
				}elseif($arrEmployee['passwd'] != $strPassword)
				{
					$this->session->set_flashdata('Errors', 'Password is not matching with the records.');
					return 0;
				}elseif($arrEmployee['active'] !== 1)
				{
					$this->session->set_flashdata('Errors', 'User is not active.');
					return 0;
				}
			}else
			{
				$this->session->set_flashdata('Errors', 'User is not registered with us. Please check username entered.');
				return 0;
			}

		}
	}

	function FetchQuestions()
	{
		$strQuery = 'SELECT * FROM tonal_questions WHERE show_or_hide = 1';

		$objQuery = $this->db->query($strQuery);

		if($objQuery->num_rows())
		{
			return $objQuery->result_array();
		}else
		{
			return array();
		}
	}

	function UploadQuestion()
	{
		if(sizeof($_POST))
		{
			$strQuestionCode = $_POST['questioncode'];

			$strOptionsCount = $_POST['optionscount'];

			$strQuestionLevel = $_POST['questionlevel'];

			$strOptionColor = $_POST['optioncolor'];

			$target_file1 = false;

			$strNewFileName = false;

			if($strQuestionCode)
			{
				$fileName = '';

				if($_FILES && $_POST['id'] == -1)
				{
					$target_dir = "uploads/";

			        $path = $target_dir.date('Ymd');
			        
			        if(!file_exists($path)) 
			        {
			        	$oldmask = umask(0);
			        	mkdir($path, 0777);
			        	umask($oldmask);
			        }

			        $fileInfo = pathinfo($_FILES["audioname"]["name"]);
			        
			        $strNewFileName = date('YmdHis').'.'.$fileInfo['extension'];
					
					$target_file = $path ."/". basename($_FILES["audioname"]["name"]);
				
			        $target_file1 = $path."/".$strNewFileName;
				
					if(!move_uploaded_file($_FILES["audioname"]["tmp_name"], $target_file1))
			        {
			    		return 0;
			        }
				}

				if($_POST['id'] == -1)
				{
					$arrData = array(
						'questioncode'  => $strQuestionCode, 
						'optionscount'  => $strOptionsCount,
						'optioncolor' 	=> $strOptionColor,
						'questionlevel' => $strQuestionLevel,
						'addeddate'	    => date('Y-m-d H:m:s'),
						'audiopath'		=> $target_file1,
						'audiofilename' => $strNewFileName,
						'answer' 		=> $_POST['answer']
					);
				}else
				{
					$arrData = array(
						'questioncode'  => $strQuestionCode, 
						'optionscount'  => $strOptionsCount,
						'optioncolor' 	=> $strOptionColor,
						'questionlevel' => $strQuestionLevel,
						'answer' 		=> $_POST['answer']
					);
				}

				if($_POST['id'] == -1)
				{
					$result = $this->db->insert('tonal_questions', $arrData);
				}
				else
				{
					$this->db->where('id', $_POST['id']);

					$result = $this->db->update('tonal_questions', $arrData);
				}

				if($result)
				{
					return $result;
				}else
				{
					return 0;
				}
			}
		}
	}

	function FetchUsers()
	{
		$strQuery = 'SELECT * FROM users ORDER BY id DESC';

		$objQuery = $this->db->query($strQuery);

		return $objQuery->result_array();
	}

	function FetchUserResult($id_user)
	{
		$arrTemp = $this->_userResults($id_user);

		$intCounter = 0;

		foreach ($arrTemp as $key => $value) {
			if($value['includeinscoring'] && ($value['optionid'] == $value['answer']))
			{
				$intCounter = $intCounter + 1;
			}
		}

		return $intCounter;
	}
	
	// Certile scores page functionality
	function fetch_certile_scores()
	{
		$strQuery = 'SELECT * FROM tonal_certile_scores ORDER BY id DESC';

		$objQuery = $this->db->query($strQuery);

		return $objQuery->result_array();
	}
	
	function edit_or_add_certilescores()
	{
		$id = $_POST['id'];
		$age = $_POST['age'];
		$gender = $_POST['gender'];
		$score = $_POST['score'];
		$certile = $_POST['certile'];
		
		$arrData = array(
                'age' => $age,
                'gender' => $gender,
                'score' => $score,
                'certile' => $certile
            );

		if($id == "")
		{
			//insert row
			$this->db->insert('tonal_certile_scores', $arrData);
			
			if($this->db->affected_rows()) {
				$success = array(
					"success" => "success",
					"status" => "insert",
					"message" => "Inserted successfully."
				);
			}
			else 
			{
				$success = array(
					"success" => "failed",
					"status" => "insert",
					"message" => "Something went wrong."
				);
			}
		}
		else
		{	
			//update the row
	 		$this->db->where('id', $id);

			$this->db->update('tonal_certile_scores', $arrData);
			
			if($this->db->affected_rows()) 
			{
				$success = array(
					"success" => "success",
					"status" => "update",
					"message" => "Updated successfully."
				);
			}
			else 
			{
				$success = array(
					"success" => "failed",
					"status" => "update",
					"message" => "Something went wrong."
				);
			}
		}
		return $success;
	}
	
	function delete_certile_score_row()
	{
		$id = $_POST['id'];

		if($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('tonal_certile_scores');
			
			if($this->db->affected_rows()) 
			{
				return true;
			} 
			else 
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	//Subscores page functionality
	//fetch subscores data to display in admin subscores view table
	function fetch_subscores()
	{
		$strQuery = 'SELECT * FROM tonal_subscores ORDER BY id DESC';

		$objQuery = $this->db->query($strQuery);

		return $objQuery->result_array();
	}
	
	function fetch_subscores_status() {
		
		$query = "select subscore_check from tonal_subscore_checkbox where id= 1";
		
		$objQuery = $this->db->query($query);

		return $objQuery->row_array();
		
	}
	
	//Update subscores row data in db
	function update_subscores()
	{
		$id = $_POST['id'];
		$questions = $_POST['questions'];
		$score_range = $_POST['score_range'];
		
		$arrData = array(
                'questions' => $questions,
                'score_range' => $score_range,
            );

		//update the row
		// $this->db->where('id', $id);
		if($id == "")
		{
			//insert row
			$this->db->insert('tonal_subscores', $arrData);
			
			if($this->db->affected_rows()) 
			{
				$success = array(
					"success" => "success",
					"status" => "Inserted",
					"message" => "Inserted successfully."
				);
			}
			else 
			{
				$success = array(
					"success" => "failed",
					"status" => "Inserted",
					"message" => "Something went wrong."
				);
			}
			
		}
		else {
			$this->db->where('id', $id);

			$this->db->update('tonal_subscores', $arrData);
			
			if($this->db->affected_rows()) 
			{
			$success = array(
				"success" => "success",
				"status" => "update",
				"message" => "Updated successfully."
			);
			}
			else 
			{
				$success = array(
					"success" => "failed",
					"status" => "update",
					"message" => "Something went wrong."
				);
			}
		
		}
		return $success;
	}
	
	// Change the subscore status in tonal_subscores table.
	function update_subscores_status()
	{
		$id = $_POST['rowId'];

		$status = $_POST['active'];

		if($id)
		{
			$arrData = array(
                'subscore_status' => $status
            );

	 		$this->db->where('id', $id);

			$this->db->update('tonal_subscores', $arrData);
			
			if($this->db->affected_rows()) 
			{
				return true;
			}
		}
		else
		{
			return false;
		}
	}
	
	function checkbox()
	{
		$subscore_check = $_POST['active'];

		$arrData = array(
			'subscore_check' => $subscore_check
		);

		$this->db->where('id', 1);

		$this->db->update('tonal_subscore_checkbox', $arrData);
		
		if($this->db->affected_rows()) 
		{
			return true;
		} else {
			return false;
		}
	}
	
	// deleting add subscore row in subscore table
	function delete_subscore_row()
	{
		$id = $_POST['id'];

		if($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('tonal_subscores');
			
			if($this->db->affected_rows()) 
			{
				return true;
			} 
			else 
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	//Sorting Questions functionality
	// Get the practice and test questions from tonal_questions table in db.
	function fetch_questions() 
	{
		
		$sql = 'SELECT * FROM tonal_questions_order WHERE type="questions"';

		$result = $this->db->query($sql);
		
		// Check the tonal_questions_order table have sorted questions or not.
		if($result->num_rows() > 0) 
		{
			$row = $result->row();
			
			// $obj = unserialize(base64_decode($row->question_order));
			$obj = unserialize($row->question_order);
			
			$array['order'] = $obj;
		}
			
		/* 
		//Get the practice test questions
		$strQuery = 'SELECT id,questioncode,audiofilename FROM tonal_questions WHERE questiontype="practice" and active = 1';

		$practiceQuery = $this->db->query($strQuery);
		
		$array['practice'] = $practiceQuery->result_array();
		*/
		
		//Get the test questions
		// $query = 'SELECT id,serial_number,audiofilename FROM tonal_questions WHERE questiontype="test" and active = 1';
		$query = 'SELECT id,serial_number,audiofilename FROM tonal_questions WHERE active = 1';

		$testQuery = $this->db->query($query);
		
		$array['test'] = $testQuery->result_array();
		
		return $array;	
	}
	
	// save the questions order in tonal_questions_order table in db.
	function save_questions_order() 
	{
		// $question_order = base64_encode(serialize($_POST['question_order']));
		$question_order = serialize($_POST['question_order']);

		if($question_order)
		{	
			$sql = "SELECT * FROM tonal_questions_order";
			$result = $this->db->query($sql);
			
			if($result->num_rows() > 0) 
			{
				$arrData = array(
						'question_order' => $question_order
						);
				
				$this->db->where('type', 'questions');

				$this->db->update('tonal_questions_order', $arrData);
				
			} 
			else 
			{
				$arrData = array(
							'type' => 'questions',
							'question_order' => $question_order,
						   );
				
				$this->db->insert('tonal_questions_order', $arrData);
			}
			
			if($this->db->affected_rows())
			{
				return "success";
			} 
			else 
			{
				return "fail";
			}
		}
	}
	
	//Upload question functionality
	// Change the active status in tonal_questions table.
	function inactive_question()
	{
		$id = $_POST['questionid'];

		$status = $_POST['active'];

		if($id)
		{
			$arrData = array(
                'active' => $status
            );

	 		$this->db->where('id', $id);

			$this->db->update('tonal_questions', $arrData);
			
			if($this->db->affected_rows()) 
			{
				//Push the new question id in sorted test questions order
				$new_id = $this->db->insert_id();
				
				$sql = 'SELECT * FROM tonal_questions_order WHERE type="questions"';
				$result = $this->db->query($sql);
				
				if($result->num_rows() > 0) 
				{
					$row = $result->row();
					$obj = unserialize($row->question_order);
					
					if($status == 1) 
					{
						array_push($obj['test'], $id);
					} 
					else 
					{
						foreach($obj['test'] as $key => $value) 
						{
							if($value == $id) 
							{
								//delete the element of question
								array_splice($obj['test'], $key, 1);
							}
						}
					}
					
					$arrData = array(
							'question_order' => serialize($obj)
							);
					
					$this->db->where('type', 'questions');

					$this->db->update('tonal_questions_order', $arrData);
				} 
			}
		}
		else
		{
			return false;
		}
	}
	
	function UpdateIncludeInScore()
	{
		$id = $_POST['questionid'];

		$status = $_POST['includeinscore'];

		if($id)
		{
			$arrData = array(
                'includeinscoring' => $status
            );

	 		$this->db->where('id', $id);

			$this->db->update('tonal_questions', $arrData);
		}
		else
		{
			return false;
		}
	}
	
	function delete_question_row()
	{
		$id = $_POST['id'];

		if($id)
		{
			/*
			//Delete the question in tonal_questions and delete that question user responses
			$this->db->where('questionid', $id);
			$this->db->delete('tonal_user_answers');
			
			$this->db->where('id', $id);
			$this->db->delete('tonal_questions');
			*/
			
			//Update the question show_or_hide field to hide the question
			$this->db->where('id', $id);
			$this->db->update('tonal_questions', array('show_or_hide'  => 0, 'active' => 0));
			
			if($this->db->affected_rows()) 
			{
				$sql = 'SELECT * FROM tonal_questions_order WHERE type="questions"';
				$result = $this->db->query($sql);
				
				if($result->num_rows() > 0) 
				{
					$row = $result->row();
					$obj = unserialize($row->question_order);
					
					foreach($obj['test'] as $key => $value) 
					{
						if($value == $id) 
						{
							//delete the element of question
							array_splice($obj['test'], $key, 1);
						}
					}
					
					$arrData = array(
							'question_order' => serialize($obj)
							);
					
					$this->db->where('type', 'questions');

					$this->db->update('tonal_questions_order', $arrData);
					
				} 
				/////
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function upload_question()
	{
		if(sizeof($_POST))
		{
			$serial_number = $_POST['serial_number'];
			$strQuestionCode = $_POST['questioncode'];
			$timestamp = time();

			$target_file1 = false;

			$strNewFileName = false;

			if($strQuestionCode)
			{
				$fileName = '';

				if($_FILES && $_POST['id'] == -1)
				{
					$target_dir = "uploads/";

			        $path = $target_dir.date('Ymd', $timestamp);
			        
			        if(!file_exists($path)) 
			        {
			        	$oldmask = umask(0);
			        	mkdir($path, 0777);
			        	umask($oldmask);
			        }

			        $fileInfo = pathinfo($_FILES["audioname"]["name"]);
			        
			        $strNewFileName = date('YmdHis', $timestamp).'.'.$fileInfo['extension'];
					
					$target_file = $path ."/". basename($_FILES["audioname"]["name"]);
				
			        $target_file1 = $path."/".$strNewFileName;
				
					if(!move_uploaded_file($_FILES["audioname"]["tmp_name"], $target_file1))
			        {
			    		return 0;
			        }
				}

				if($_POST['id'] == -1)
				{
					$arrData = array(
						'serial_number'  => $serial_number, 
						'questioncode'  => $strQuestionCode, 
						'questiontype'  => 'test', 
						'addeddate'	    => date('Y-m-d H:m:s', $timestamp),
						'audiopath'		=> $target_file1,
						'audiofilename' => $strNewFileName,
						'answer' 		=> $_POST['answer'],
						'optioncolor' 		=> $_POST['optioncolor'],
						'optionscount' 		=> $_POST['optionscount'],
						'questionlevel' 		=> $_POST['questionlevel']
					);
				}
				else
				{
					$arrData = array(
						'serial_number'  => $serial_number, 
						'questioncode'  => $strQuestionCode, 
						'answer' 		=> $_POST['answer'],
						'optioncolor' 		=> $_POST['optioncolor'],
						'optionscount' 		=> $_POST['optionscount'],
						'questionlevel' 		=> $_POST['questionlevel']
					);
				}

				if($_POST['id'] == -1)
				{
					$result = $this->db->insert('tonal_questions', $arrData);
					
					if($this->db->affected_rows()) 
					{
						//Push the new question id in sorted test questions order
						$new_id = $this->db->insert_id();
						
						$sql = 'SELECT * FROM tonal_questions_order WHERE type="questions"';
						$result = $this->db->query($sql);
						
						if($result->num_rows() > 0) 
						{
							$row = $result->row();
							$obj = unserialize($row->question_order);
							
							array_push($obj['test'], $new_id);
							
							$arrData = array(
									'question_order' => serialize($obj)
									);
							
							$this->db->where('type', 'questions');

							$this->db->update('tonal_questions_order', $arrData);
						} 
						
						$success = array(
							"success" => "success",
							"status" => "insert",
							"message" => "Inserted successfully."
						);
					}
					else
					{
						$success = array(
							"success" => "failed",
							"status" => "insert",
							"message" => "Something went wrong."
						);
					}
				}
				else
				{
					$this->db->where('id', $_POST['id']);

					$result = $this->db->update('tonal_questions', $arrData);
					
					if($this->db->affected_rows()) {
						$success = array(
							"success" => "success",
							"status" => "update",
							"message" => "Updated successfully."
						);
					}
					else
					{
						$success = array(
							"success" => "failed",
							"status" => "update",
							"message" => "Something went wrong."
						);
					}
				}
				
				return $success;
			}
		}
	}
	
	//////
	function FetchCertile()
	{
		$strQuery = 'SELECT * FROM tonal_certile ORDER BY id DESC';

		$objQuery = $this->db->query($strQuery);

		return $objQuery->result_array();
	}
	
	//Get the certile score based on user age, gender and score from tonal_certile_scores table in db
	function FetchCertileWRT($p_intScore, $age , $gender)
	{
		$strQuery = 'SELECT age,score,certile FROM tonal_certile_scores WHERE gender = "'.$gender.'"';

		$objQuery = $this->db->query($strQuery);

		$temp = 0;
		
		if($objQuery->num_rows())
		{
			//Get the certile score based on user age, gender and score
			foreach($objQuery->result_array() as $row) 
			{
				//Explode the certile age and score for checking in between the user age and score. 
				$certile_age = explode("-",$row['age']);
				$certile_score = explode("-",$row['score']);
				
				if($age == $certile_age['0'] || $age >= $certile_age['0'] && $age <= $certile_age['1']) 
				{
					if($p_intScore == $certile_score['0'] || $p_intScore >= $certile_score['0'] && $p_intScore <= $certile_score['1']) 
					{
						$temp = $row['certile'];
						break;
					} 
				}
			}
		}
		return $temp;
	}
	/*function FetchCertileWRT($p_intScore, $age , $gender)
	{
		$strQuery = 'SELECT certile FROM tonal_certile WHERE score = '.$p_intScore;

		$objQuery = $this->db->query($strQuery);

		if($objQuery->num_rows())
		{
			$temp = $objQuery->row_array();

			return $temp['certile'];
		}else
		{
			return 0;
		}

		return $objQuery->result_array();
	}*/

	function _userResults($id_user)
	{
		
		$strQuery = 'SELECT ua.`questionid`, ua.`optionid`, q.`answer`, q.includeinscoring FROM tonal_user_answers ua INNER JOIN tonal_questions q ON q.id = ua.`questionid` WHERE userid = '.$id_user;

		$objQuery = $this->db->query($strQuery);

		if($objQuery->num_rows() > 0)
		{
			return $objQuery->result_array();
		}else
		{
			return array();
		}
	}

	function FetchTestResult()
	{
		$arrUsers = $this->FetchUsers();
		foreach ($arrUsers as $key => &$value) {
			$value['test_result'] = $this->_userResults($value['id']);
		}
		
		return $arrUsers;
	}

	function DeleteQuestion()
	{
		$id = $_POST['questionid'];

		$status = $_POST['active'];

		if($id)
		{
			$arrData = array(
                'active' => $status
            );

	 		$this->db->where('id', $id);

			$this->db->update('aims_questions', $arrData);
		}else
		{
			return false;
		}
	}

}
?>