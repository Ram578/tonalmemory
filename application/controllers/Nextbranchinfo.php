<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nextbranchinfo extends CI_Controller {

	/**
	 * This is Nextbranchinfo page controller.
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

			$this->load->view('next_branch_info', $arrData);
		}
	}
}
