<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		$this->load->model('test_model');		
	
		$this->test_model->put($this->input->post('input'));
	}
	public function input(){
		$this->load->model('test_model');		
	
		$this->test_model->put($this->input->post('input'));
		//$this->test_model->put();
		//$this->test_model->put($input);
	}
	public function get(){
		
		$this->load->model('test_model');	
		echo $this->test_model->getOne()['input'];
	}
}
?>