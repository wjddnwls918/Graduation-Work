<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {

    function gets($option,$idx)
    {
    	$start=($option['pagePerNumber']) * ($option['page']-1);

		$this->db->select('idx_date,drone_idx');
		$this->db->distinct();

		$this->db->where('drone_idx',$idx);
		$this->db->limit($option['pagePerNumber'], $option['page']);
		$this->db->order_by('idx', 'DESC');

        return $this->db->get('practice_Drone_Data')->result_array();
    }

	function detail_db($drone_idx,$time)
	{
		$this->db->where('drone_idx',$drone_idx);
		$this->db->where('idx_date',$time);
		$this->db->order_by('idx', 'DESC');
		return $this->db->get('practice_Drone_Data')->row_array();


	}

	function detail_info($drone_idx,$time)
	{

		$this->db->where('drone_idx',$drone_idx);
		$this->db->where('idx_date',$time);
		$this->db->order_by('idx');

		return $this->db->get('practice_Drone_Data')->result_array();
	}

	function total_entry($idx)
    {
		$this->db->select('idx_date,drone_idx');
		$this->db->distinct();

		$this->db->from('practice_Drone_Data');

		$this->db->where('drone_idx', $idx);
		$query=$this->db->get();

        return $query->num_rows();
    }
  
}
