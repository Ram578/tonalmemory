<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newexampleinfo extends CI_Controller {

	/**
	 * This is Newexampleinfo page controller.
	 */
	public function index()
	{
		if(!isset($this->session->userdata['UserID']))
		{
			redirect('/', 'refresh');
		}else
		{
			$arrData['Title'] = 'AIMS - Test';

			$Header = $this->load->view('header', $arrData,true);

			$arrData['Header'] = $Header;

			$arrData['Footer'] = $this->load->view('footer', $arrData,true);

			$this->load->view('new_example_info', $arrData);
		}
	}
}
