<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	public function index()
	{
		$this->load->view('include/header');
		$this->load->view('data/item');
		$this->load->view('include/footer');
	}
	
	public function test()
	{
		$this->load->view('include/header');

		$this->load->view('data/index');
		$this->load->view('include/footer');
	}
}
