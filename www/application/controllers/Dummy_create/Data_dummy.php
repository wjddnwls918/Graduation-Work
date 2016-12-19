<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_dummy extends CI_Controller 
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
	public function insert_movie_record(){
		$this->load->helper('file');
		$drone_idx=rand(1, 3);
		$mktime = time();
		
		$idx_date=date("Y-m-d", $mktime );
		$idx_time=date("H:i:s", $mktime);
		$temperature=rand(0, 150);
		$humidity=rand(0, 100);
		$CO2=rand(0, 100);
		$latitude=mt_rand(36759765, 36767000)/1000000;
		$longitude=mt_rand(127277215,127284284)/1000000;
		$altitude=mt_rand(0, 1500);
		$speed=mt_rand(0, 100);
		
		/*		
		$idx_flight_record=mt_rand(-1800000,1800000)/10000;
		$file_size=mt_rand(-1800000,1800000)/10000;
		$runtime=date("H:i:s", time()+mt_rand(10,50000));  
		$start_record_time=date("y-m-d H:i:s", time()+mt_rand(10,10000));  
		$end_record_time=date("y-m-d H:i:s", strtotime($start_record_time)+mt_rand(100,7200));  
		*/
		$data="INSERT INTO  `deokkyun`.`practice_Drone_Data` (
		`idx` ,
		`drone_idx`,
		`idx_date`,
		`idx_time`,
		`temperature`,
		`humidity`,
		`CO2`,
		`latitude`,
		`longitude`,
		`altitude`,
		`speed`
		)
		VALUES (
		NULL ,  '{$drone_idx}', '{$idx_date}', '{$idx_time}', '{$temperature}', '{$humidity}', '{$CO2}', '{$latitude}', '{$longitude}', '{$altitude}', '{$speed}')\r\n;";
		
		
		if ( ! write_file('./public/sql/recode_file.txt', $data,'a+'))
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
