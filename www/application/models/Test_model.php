<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_model extends CI_Model {

	public function put($input)
	{
		$data = array(
			'input' => $input
		);
		
		$this->db->insert('test',$data);		
	
	}

	public function get($idx)
	{
		$this->db->from('test');
		
		$this->db->where('idx',$idx);
		
		$data=$this->db->get();
		
		return $data->row_array();
	}
	public function getOne()
	{
		$this->db->from('test');
		$this->db->order_by('idx','DESC');
		
		$this->db->limit(1, 1);
		$data=$this->db->get();
		
		return $data->row_array();
	}
}
