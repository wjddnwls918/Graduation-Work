<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rand extends CI_Controller 
{
	public function index()
	{
		
	}
	public function insert_moving_route()
	{
		$this->load->helper('file');
		$idx_flight_record =rand(1,300);
		$idx_drone=rand(1,200);
		$time=date("y-m-d H:i:s", time()+mt_rand(10,10000));
		$latitude=mt_rand(-1800000,1800000)/10000;
		$longitude=mt_rand(-1800000,1800000)/10000;  
		$altitude=rand(1,500);
		$speed=rand(1,50);  	

		$data="INSERT INTO  `deokkyun`.`moving_route` (
		`idx` ,
		`idx_flight_record` ,
		`idx_drone` ,
		`time` ,
		`latitude` ,
		`longitude` ,
		`altitude` ,
		`speed` 
		)
		VALUES (
		NULL ,  '{$idx_flight_record}',  '{$idx_drone}',  '{$time}',  '{$latitude}',  '{$longitude}',  '{$altitude}',  '{$speed}'
		)\r\n;";
		
		
		if ( ! write_file('./public/sql/moving_record.txt', $data,'a+'))
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
