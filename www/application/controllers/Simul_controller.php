<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simul_controller extends CI_Controller {

	public function index($page=1)
	{
	    $page= $this->input->get("page");
		
		if(!$this->session->userdata('is_login'))
		{
			$this->load->helper('url');
			redirect('/welcome');
		}
		
		else
		{

		$this->load->view('include/header');
		$this->load->view('simulation/simul_view');
		$this->load->view('include/footer');
		//$this->load->view('simulation/script');
		$this->load->view('simulation/localscript');
		}
	}
	
	public function insert($temp,$hum,$CO2)
	{
		$this->load->model('simul_model');
		
		$this->simul_model->insertdb($temp,$hum,$CO2);
		$this->load->helper('url');
		redirect('/local_controller/index');
	}
	
	public function del($idx)
	{
		$this->load->model('simul_model');

		$this->simul_model->deletedb($idx);
		$this->load->helper('url');
		redirect('/simul_controller/index');	
	}
	
	public function insertSimul($id,$temp,$hmd,$co2,$vib,$water)
	{
		$this->load->model('simul_model');
		
		//echo  "!!";
		$this->simul_model->insert_Simuldb($id,$temp,$hmd,$co2,$vib,$water);
		//$this->load->helper('url');
		//redirect('/simul_controller/index');
	}
	
	public function insertDronesimul($id,$lat,$lng)
	{
		$this->load->model('simul_model');
		$this->simul_model->insert_SimulDronedb($id,$lat,$lng);
	}
	
	public function rssi($localId)
	{
		$this->load->model('simul_model');
		$data = $this->simul_model->getRssi($localId);
		
		echo json_encode($data);
	}
	
	public function pop()
	{
		if(!$this->session->userdata('is_login'))
		{
			$this->load->helper('url');
			redirect('/welcome');
		}//if문 끝
		
			else
		{
			$this->load->view('simulation/popup');
			//$this->load->view('include/footer');
		}
	}
}
