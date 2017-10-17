<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TonalTest extends CI_Controller {
	
	/**
	 * This is TonalTest page controller.
	 * Develope on 21th July'2016 by Hemanth Kumar
	 */
	public function index()
	{
		if(isset($this->session->userdata['UserID']))
		{
			if(isset($_GET['level']))
			{
				$p_Level = $_GET['level'];
			}else
			{
				$p_Level = 3;
			}
			$this->load->model('frontendmodel');

			$arrData['Title'] = 'AIMS - Test';

			$Header = $this->load->view('header', $arrData,true);

			$arrData['Header'] = $Header;

			$arrData['Footer'] = $this->load->view('footer', $arrData,true);

			$arrData['Questions'] = $this->frontendmodel->FetchQuestions($p_Level);

			$arrData['CurrentLevel'] = $p_Level;

			$this->load->view('tonal_test', $arrData);
		}else
		{
			redirect('/', 'refresh');
		}
	}

	function saveuseranswer()
	{
		$this->load->model('frontendmodel');

		$this->frontendmodel->SaveUserAnswer();
	}
}
