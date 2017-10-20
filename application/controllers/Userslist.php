<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userslist extends CI_Controller {

	/**
	 * This is Userslist page controller.
	 */
	public function index()
	{
		if(isset($this->session->userdata['EmployeeID']))
		{
			$this->load->model('adminmodel');

			$arrData['Users'] = $this->adminmodel->FetchUsers();

			foreach ($arrData['Users'] as $key => &$value) {
				$intScore = $this->adminmodel->FetchUserResult($value['id']);

				$value['score'] = $intScore;

				$value['certile'] = $this->adminmodel->FetchCertileWRT($intScore, $value['age'], $value['gender']);
			}

			$this->load->view('userslist', $arrData);
		}else
		{
			redirect('/admin', 'refresh');
		}

	}

	public function export()
	{
		$this->load->model('adminmodel');

		$arrData['Users'] = $this->adminmodel->FetchUsers();
		
		$arrTemp = array();
		
		foreach ($arrData['Users'] as $key => &$value) {
			$intScore = $this->adminmodel->FetchUserResult($value['id']);

			$value['score'] = $intScore;

			$value['certile'] = $this->adminmodel->FetchCertileWRT($intScore, $value['age'], $value['gender']);
			
			$arrTempRow = $value;
			unset($arrTempRow['pitch_completed_date']);
			unset($arrTempRow['time_completed_date']);
			unset($arrTempRow['pitch_status']);
			unset($arrTempRow['time_status']);
			unset($arrTempRow['tonal_status']);
			$arrTemp[] = $arrTempRow;
		}

		// Enable to download this file
		$filename = "UsersList.csv";
		 
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: text/csv");
		 
		$display = fopen("php://output", 'w');
		 
		$arrHeaders = array('ID', 'First Name', 'Last Name', 'Age', 'Gender', 'File Number', 'Created Date', 'Completed Date', 'Active', 'Score', 'Certile');
		
		$flag = false;
		
		$users = $arrTemp;
		
		if(count($users)) {
		    if(!$flag) {
		      // display field/column names as first row
		      fputcsv($display, array_values($arrHeaders), ",", '"');
		      $flag = true;
		    }
		    foreach ($users as $key => $value) {
			    fputcsv($display, array_values($value), ",", '"');
			}
		  }
		 
		fclose($display);
	}
}
