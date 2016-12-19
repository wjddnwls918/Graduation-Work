<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_model1 extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}

    public function gets($option)
    {
    	$start=($option['pagePerNumber']) * ($option['page']-1);
		

		$this->db->limit($option['pagePerNumber'], $start);
		$this->db->order_by('idx', 'DESC');
        return $this->db->get('data')->result_array();
    }

	public function get_tem()
	{
		$this->db->where('idx_drone','1');
		$this->db->order_by('idx','DESC');
		return $this->db->get('data')->row_array();
		
	}
	
	public function get_info($idx)
	{
		$this->db->from('practice_Drone_Data');
		
		$this->db->where('drone_idx',$idx);
		$this->db->order_by('idx','DESC');
		
		$data=$this->db->get();
		
		return $data->row_array();	
	}

	//data테이블에서 얻는거
	public function get_data($idx_drone)
	{
		$this->db->select('temperature,humidity');
		$this->db->from('data');
		$this->db->where('idx_drone',$idx_drone);
		$this->db->order_by('idx','DESC');
		
		$data = $this->db->get();
		
		return $data->row_array();
		
	}
	
	//moving_route에서 얻을거
	public function get_moving_route($idx_drone)
	{
		$this->db->select('idx_drone,temperature,humidity,latitude,longitude,altitude,speed');
		$this->db->from('moving_route');
		$this->db->where('idx_drone',$idx_drone);
		$this->db->order_by('idx','DESC');
		
		$data = $this->db->get();
		return $data->row_array();
	
	}
	
	//drones 에서 얻어오기
	public function drones($idx_drone)
	{
		$this->db->select('start_lat,start_lng,cur_lat,cur_lng,des_lat,des_lng,status');
		$this->db->from('drones');
		$this->db->where('idx_drone',$idx_drone);
		$this->db->order_by('idx','DESC');
		$data = $this->db->get();
		
		return $data->row_array();			
	}
}
