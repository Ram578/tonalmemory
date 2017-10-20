<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usertestresult extends CI_Controller {

	/**
	 * This is Usertestresult page controller.
	 */
	public function index()
	{
		$this->load->model('adminmodel');

		$arrData['TestResults'] = $this->adminmodel->FetchTestResult();

		// $arrData['Certiles'] = $this->adminmodel->FetchCertile();
		foreach ($arrData['TestResults'] as $key => &$value) 
		{
			$intScore = $this->adminmodel->FetchUserResult($value['id']);

			$value['score'] = $intScore;

			$value['certile'] = $this->adminmodel->FetchCertileWRT($intScore, $value['age'], $value['gender']);
		}

		$this->load->view('user_test_result', $arrData);
	}

	public function export()
	{
		$this->load->model('adminmodel');

		$arrResult = $this->adminmodel->FetchTestResult();

		$arrTemp = array();

		$arrHeaders = array('ID','First Name', 'Last Name', 'Age', 'Gender', 'File Number', 'Score', 'Certile');
		
		foreach ($arrResult as $key => &$value) {
			$intScore = $this->adminmodel->FetchUserResult($value['id']);

			$value['score'] = $intScore;

			$value['certile'] = $this->adminmodel->FetchCertileWRT($intScore, $value['age'], $value['gender']);
		}

		foreach ($arrResult as $key => &$value) {
			$intQt = 1;
			if(count($value['test_result']) > 0)
			{
				foreach ($value['test_result'] as $key => $qt) {
					$value['Answer '.$intQt] = $qt['optionid'];
					$arrHeaders[] = $intQt;
					$intQt++;
				}
			}

			$arrTempRow = $value;
			unset($arrTempRow['test_result']);
			unset($arrTempRow['active']);
			unset($arrTempRow['addeddate']);
			unset($arrTempRow['pitch_completed_date']);
			unset($arrTempRow['time_completed_date']);
			unset($arrTempRow['tonal_completed_date']);
			unset($arrTempRow['pitch_status']);
			unset($arrTempRow['time_status']);
			unset($arrTempRow['tonal_status']);
			$arrTemp[] = $arrTempRow;
		}
		
		$maxColumns = max(array_map(function($row){
			    return count($row);
			}, $arrTemp));

		//$this->cleanArray($arrTemp);

		foreach ($arrTemp as &$value) {
			$intTempCount = count($value);
			if($maxColumns > $intTempCount)
			{
				for($intCtr = ($intTempCount-6); $intCtr < ($maxColumns-$intTempCount); $intCtr++)
				{
					$value['Answer '.($intCtr+1)] = ' ';
				}
			}
		}
		//print_r($arrTemp); exit;

		$arrHeaders = array_unique($arrHeaders);
		
		// Enable to download this file
		$filename = "UsersTestResult.csv";
		 		
		header("Pragma: public");
		header("Content-Type: text/plain");
		header("Content-Disposition: attachment; filename=\"$filename\"");

		ob_clean();

		$display = fopen("php://output", 'w');

		fputcsv($display, array_values($arrHeaders), ",", '"');
		
		foreach ($arrTemp as $file) {
		    $result = [];
		    array_walk_recursive($file, function($item) use (&$result) {
		        $result[] = $item;
		    });
		    fputcsv($display, $result);
		}

		$flag = false;
		/*if(count($arrTemp)) {
		    if(!$flag) {
		      // display field/column names as first row
		      fputcsv($display, array_values($arrHeaders), ",", '"');
		      $flag = true;
		    }
		    foreach ($arrTemp as $key => $value) {
			    fputcsv($display, array_values($value), ",", '"');
			}
		  }*/
		 
		fclose($display);

	}

	function cleanArray(&$array)
	{
	    end($array);
	    $max = key($array); //Get the final key as max!
	    for($i = 0; $i < $max; $i++)
	    {
	        if(!isset($array[$i]))
	        {
	            $array[$i] = '';
	        }
	    }
	}
}
