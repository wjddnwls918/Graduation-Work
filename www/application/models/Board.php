<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
/**
 * 공통 게시판 모델
 */
 
class Board extends CI_Model 
{
    function __construct() {
        parent::__construct();
		$this -> load -> helper(array('url', 'date'));
    }
 
    function get_list() {
		$this->db->from('ci_board');
		$this->db->order_by('board_id', 'DESC');
		$data=$this->db->get();
        //$sql = "SELECT * FROM ci_board ORDER BY board_id DESC";
        //$query = $this -> db -> query($sql);
        //$result = $query -> result();
         $result = $data->result_array();
 
        return $result;
    }
	
	
	function total_entry()
    {
		
		$this->db->from('ci_board');
		
		//$this->db->where('drone_idx', $idx);		
		$query=$this->db->get();
	
        return $query->num_rows();
    }
	
	function gets($option)
    {
    	$start=($option['pagePerNumber']) * ($option['page']-1);
		
		$this->db->limit($option['pagePerNumber'], $option['page']);
		$this->db->order_by('board_id', 'DESC');
		
        return $this->db->get('ci_board')->result_array();
    }
	
	function view_get($board_id)
	{
		$this->db->from('ci_board');
		$this->db->where('board_id',$board_id);
		
		$data = $this->db->get();
		
		
		return $data->row_array(); 
	}
	
	function increase_hit($board_id)
	{
	
		$this->db->where('board_id',$board_id['board_id']);
		
		$data2= $board_id['hits']+1;
		$data = array(
			'hits'=>$data2
		);
	
		
		$this->db->update('ci_board',$data);
	}
	
	
	
	function insert_data($subject,$contents)
	{
		$data =array(
		 'board_pid' => 0,
		 'user_id' => 'wangtou',
		 'user_name' => 'admin',
		 'subject' => $subject,
		 'contents' => $contents,
		 'reg_date' => date('Y-m-d H:i:s')
		
		);
		
		$this->db->insert('ci_board', $data); 
	}
	
	function delete_data($board_id)
	{
		$this->db->delete('ci_board',array('board_id'=>$board_id['board_id']));
	}
	
	function modifiy_data($board_id,$subject,$contents)
	{
	
		$this->db->where('board_id',$board_id);
		
		//$data2= $board_id['hits']+1;
		$data = array(
			'subject'=>$subject,
			'contents'=>$contents
		);
	
		
		$this->db->update('ci_board',$data);
	}
	
}