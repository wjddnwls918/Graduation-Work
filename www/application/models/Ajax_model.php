<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model
{
	public function get_info($idx)
	{
		$this->db->from('localData');
		
		$this->db->where('localId',$idx);
		$this->db->order_by('idx','DESC');
		
		$data=$this->db->get();
		
		return $data->row_array();	
	}
}
