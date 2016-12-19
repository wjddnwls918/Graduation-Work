<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map_model extends CI_Model 
{
	public function get_info($idx)
	{
		$this->db->from('practice_Drone_Data');
				
		$this->db->where('drone_idx',$idx);
		$this->db->order_by('idx','DESC');
		
		$data=$this->db->get();
		
		return $data->row_array();	
	}
}
