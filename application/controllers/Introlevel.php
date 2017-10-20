<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Introlevel extends CI_Controller {

	/**
	 * This is Introlevel page controller.
	 */
	public function index()
	{
		if(isset($_GET['level']))
		{
			$p_intLevel = $_GET['level'];
		}else
		{
			$p_intLevel = 3;
		}

		$arrData['Title'] = 'AIMs - Tonal Memory Registration Form';

		$Header = $this->load->view('header', $arrData,true);

		$arrData['Header'] = $Header;

		$arrData['Footer'] = $this->load->view('footer', $arrData,true);

		$arrData['CurrentLevel'] = $p_intLevel;
	
		$this->load->view('intro_level', $arrData);
	}
}
