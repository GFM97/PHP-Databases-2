<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		// if the user isn't logged in, he will be thrown out
		if (!$this->check_login())
		{
			redirect('home');
		}
	}

	public function index()
	{
		//var_dump($this->session->userdata()); die;
		$this->load->view('backend');
	}
}
