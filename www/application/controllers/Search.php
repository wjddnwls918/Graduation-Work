<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Search extends CI_Controller {

	public function index()
	{
		//�α��� �ȵ��� ��
		if(!$this->session->userdata('is_login'))
		{
			$this->load->view('include/login_header');
			
			$this->load->view('include/footer');
			
		}
				
		//�α��� ���� ��
		else
		{
			$data = array("_type"=>$_POST['_type'],"_text"=>$_POST['_text']);
			$this->load->model('search_model');
			
			$result = $this->search_model->find($data);
			
			$this->load->view('include/header');
			$this->load->view('upload/list',$result);
			$this->load->view('include/footer');
			
		}
		
	}
	
}
