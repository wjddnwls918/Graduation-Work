<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		//로그인 
		if(!$this->session->userdata('is_login'))
		{
			$this->load->view('include/login_header');
			$this->load->view('index');
			$this->load->view('include/footer');
		}
				
		//로그인 됐을 때
		else
		{
			$this->load->view('include/header');
			$this->load->view('test');
			$this->load->view('include/footer');

		}
	}
	public function aa(){
		echo "asda";
	}
	
}
