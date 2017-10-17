<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {	
	/**
	 * This is Home page controller.
	 */ 

	public function index()
	{
		/**
		* Checking the session and redirecting to respective pages
		*/
		if(isset($this->session->userdata['UserID']))
		{
			redirect('/welcome', 'refresh');
		}else
		{
			$arrData['Title'] = 'AIMs - Tonal Memory Registration Form';

			$Header = $this->load->view('header', $arrData,true);

			$arrData['Header'] = $Header;

			$arrData['Footer'] = $this->load->view('footer', $arrData,true);

			$this->load->view('home', $arrData);
		}
	}

	public function logout()
	{
		//$this->session->session_destroy();

		$this->session->unset_userdata('UserID');
		
		redirect('/', 'refresh');
	}

	public function register()
	{
		/* Load the database model:
      	/application/models/Register.php */

    	$this->load->model('registermodel');

    	$result = $this->registermodel->RegisterUser();

    	if(is_integer($result))
    	{
    		 redirect('/welcome', 'refresh');
    	}else
    	{
    		$this->session->set_flashdata('Errors', array($result)); 

    		redirect('/', 'refresh');
    	}

	}
}
