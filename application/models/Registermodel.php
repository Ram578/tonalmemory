<?php
/**
* This class is used to handle the customer related info.
*/
class Registermodel extends CI_Model
{
	function Registermodel() 
  	{
    	parent::__construct();
  	}
	
	function RegisterUser()
	{
		if(sizeof($_POST) > 0)
		{
			$arrUserData = array
			(
				'firstname'  	=> $_POST['firstname'],
				'lastname' 		=> $_POST['lastname'],
				'age'			=> $_POST['age'],
				'gender'		=> $_POST['gender'],
				'filenumber'	=> $_POST['filenumber'],
				'addeddate'		=> date('Y-m-d H:m:s'),
				'active'		=> 1,
			);

			$result = $this->db->insert('aims_users', $arrUserData);

			if($result)
			{
				$intUserID = $this->db->insert_id();

				$this->session->set_userdata("UserName", $_POST['firstname']);
				$this->session->set_userdata("LastName", $_POST['lastname']);
				$this->session->set_userdata("Gender", $_POST['gender']);
				$this->session->set_userdata("UserID", $intUserID);
				return $intUserID;
			}else
			{
				return array('OOPS...! We are not able to register you now. Please try again later.');
			}
		}
	}
}
?>