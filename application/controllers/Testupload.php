<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testupload extends CI_Controller {

	/**
	 * This is Testupload page controller.
	 */
	public function index()
	{
		$this->load->view('test_upload');
	}
}
