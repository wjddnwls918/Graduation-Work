<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dummy extends CI_Controller 
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
	public function insert_flight_record(){
		$this->load->helper('file');
		$idx_drone=rand(1,200);
		$start_point_lat=mt_rand(-1800000,1800000)/10000;
		$start_point_lng=mt_rand(-1800000,1800000)/10000;
		$target_point_lat=$start_point_lat+mt_rand(-100000,100000)/10000;
		$target_point_lng=$start_point_lng+mt_rand(-100000,100000)/10000;
		$flight_time=date("H:i:s", time()+mt_rand(10,50000));  
		$moving_distance=mt_rand(1000,100000)/1000;
		$start_time=date("y-m-d H:i:s", time()+mt_rand(10,10000));  
		$landing_time=date("y-m-d H:i:s", strtotime($start_time)+mt_rand(100,7200));  
		
		$data="INSERT INTO  `deokkyun`.`flight_record` (
		`idx` ,
		`idx_drone` ,
		`start_point_lat` ,
		`start_point_lng` ,
		`target_point_lat` ,
		`target_point_lng` ,
		`flight_time` ,
		`moving_distance` ,
		`start_time` ,
		`landing_time`
		)
		VALUES (
		NULL ,  '{$idx_drone}',  '{$start_point_lat}',  '{$start_point_lng}',  '{$target_point_lat}',  '{$target_point_lng}',  '{$flight_time}',  '{$moving_distance}',  '{$start_time}',  '{$landing_time}'
		)\r\n;";
		
		
		if ( ! write_file('./public/sql/flight_record.txt', $data,'a+'))
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
