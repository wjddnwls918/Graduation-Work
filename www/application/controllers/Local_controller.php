<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Local_controller extends CI_Controller 
{
	public function index()
	{
		if(!$this->session->userdata('is_login'))
		{
			$this->load->helper('url');
			redirect('/welcome');
		}
	
		else
		{
		
		$this->load->view('include/header');
		
		$this->load->view('local/local_index');
		$this->load->view('include/footer');
		$this->load->view('local/local_script');		
		}		
	}
	
	
	//데이터베이스에서 얻어와서 json 형식으로 넘김
	public function get_info_json($localID=1){
		
		$this->load->model('local_model');		
	
	    //드론 번호 1 
		$data= $this->local_model->get_json_info($localID);

		echo json_encode($data);		
	}
	
	
	public function get_info_fire()
	{
		$this->load->model('local_model');	
		
		$data1= $this->local_model->get_info(1);
	
		$data2= $this->local_model->get_info(2);
		$data3= $this->local_model->get_info(3);
		
		$data4= $this->local_model->get_info(4);
		$data5= $this->local_model->get_info(5);
		$data6= $this->local_model->get_info(6);
	
		$data = array($data1,$data2,$data3,$data4,$data5,$data6);
		
		echo json_encode($data);	
		
	}
	
	//팝업으로 로컬센서의 실시간 데이터와 그래프 출력 및 알고리즘 적용
	public function pop_local_info($id){
		if(!$this->session->userdata('is_login'))
		{
			$this->load->helper('url');
			redirect('/welcome');
		}
				
		else
		{	
			$this->load->model('local_model');		
			$localID=$id;
			$data= $this->local_model->get_info($localID);
			
			//$this->load->view("include/header");
			$this->load->view("local/popup",array("data"=>$data));
			//$this->load->view("include/footer");
			$this->load->view('local/script',array("localID"=>$localID));
		}
	}
}

