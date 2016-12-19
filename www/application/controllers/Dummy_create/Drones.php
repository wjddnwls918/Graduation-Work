<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drones extends CI_Controller 
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
	}
	public function insert_drones()
	{
		$str = array('flight','charge','stop');

		$this->load->helper('file');
		$flight_cnt = rand(1,50);
		$flight_distance= rand(1,500);

		$no = rand(0,count($str) - 1);
		$status= $str[$no];
		$idx_drone = rand(1,3);
		

		$data="INSERT INTO  `deokkyun`.`drones` (
		`idx` ,
		`flight_cnt` ,
		`flight_distance` ,
		`status` ,
		`idx_drone`
		
		)
		VALUES (
		NULL ,  '{$flight_cnt}',  '{$flight_distance}',  '{$status}' , '{$idx_drone}')\r\n;";
		
		
		if ( ! write_file('./public/sql/drones.txt', $data,'a+'))
		{
				//echo 'Unable to write the file';
		}
		
		else
		{
				//echo 'File written!';
		}

		echo $data;	
	}	
}
