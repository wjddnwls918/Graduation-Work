<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');

	class Map extends CI_Controller 
	{
	
	//드론관제 메인 페이지
	public function index()
	{
		if(!$this->session->userdata('is_login'))
		{
			$this->load->helper('url');
			redirect('/welcome');
		}
		
		else
		{	
			$this->load->model('map_model');		
			$droneID1 = 1; $droneID2 = 2; $droneID3 = 3;
			$data1 = $this->map_model->get_info($droneID1);
			$data2 = $this->map_model->get_info($droneID2);
			$data3 = $this->map_model->get_info($droneID3);
			
			
			$this->load->view('include/header');
			$this->load->view('map/index');
			$this->load->view('include/footer');
			$this->load->view('map/script', array("data1"=>$data1, "data2"=>$data2, "data3"=>$data3));
			$this->load->view('map/script2');
	
		}
	}
	

	//데이터베이스에서 데이터 얻어와 json_encode
	public function get_info_json(){
		
		$this->load->model('map_model');		

		$droneID1 = 1; $droneID2 = 2; $droneID3 = 3;
		
		$data1 = $this->map_model->get_info($droneID1);
		$data2 = $this->map_model->get_info($droneID2);
		$data3 = $this->map_model->get_info($droneID3);
		
		$data = array($data1, $data2, $data3);
		
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
	
	//팝업으로 드론의 실시간데이터를 표시하고 그래프로 표시
	public function pop_drone_info($id)
	{
	if(!$this->session->userdata('is_login'))
		{
			$this->load->helper('url');
			redirect('/welcome');
		}
				
		else
		{	
		$this->load->model('info_model1');		
		
	    $drone_idx=$id;
	    $data= $this->info_model1->get_info($drone_idx);
		$this->load->view('map/popup',array("data"=>$data));
		$this->load->view('info/script',array("drone_idx"=>$drone_idx));

		}
		
		
	}
}
