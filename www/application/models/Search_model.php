<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model
{
	public function find($data)
	{

		echo $data['_type'];
		echo $data['_text'];
		//if( $data['_type'] == 
		$this->db->from('ci_board');

		//return $result;

	}
	public function insertdb($temp,$hum,$CO2)
	{
		$data = array(
			'localId' => 2,
			'latitude' => 36.7637515,
			'longitude' => 127.2819829,
			'temperature' => $temp,
			'humidity' => $hum,
			'CO2' => $CO2
		);

		$this->db->insert('localData',$data);

	}

	public function deletedb($id)
	{
		$this -> db ->select('idx');

		$this->db->from('localData');
		$this->db->where('localId',$id);
		$this->db->order_by('idx','desc');

		$query = $this->db->get();

		$data = $query->row_array();

		$this->db->where('idx',$data['idx']);
		$this->db->delete('localData');
	}

	public function insert_Simuldb($id,$temp,$hmd,$co2,$vib,$water)
	{
		$sensorLatitude = [ 36.766474 , 36.764978 , 36.763454 , 36.76213 , 36.761547 , 36.760252];
	    $sensorLongitude = [ 127.28253 ,  127.280798 , 127.282329 , 127.284093 , 127.280664 , 127.278389 ];
			$data = array(
			'localId' => $id,
			'latitude' => $sensorLatitude[$id-1],
			'longitude' => $sensorLongitude[$id-1],
			'temperature' => $temp,
			'humidity' => $hmd,
			'CO2' => $co2,
			'vibration' => $vib,
			'waterlevel' => $water
		);

		$this->db->insert('localData',$data);
	}

	public function insert_SimulDronedb($id,$lat,$lng)
	{
		$temp = rand(18, 30);
		$hmd = rand(50, 80);
		$co2 = rand(350, 400);
		$al = rand(0, 15);
		$speed = rand(0, 20);

		$data = array(
			'drone_idx' => $id,
			'idx_date' => date("Y-m-d"),
			'idx_time' => date("H:i:s"),
			'temperature' => $temp,
			'humidity' => $hmd,
			'CO2' => $co2,
			'latitude' => $lat,
			'longitude' => $lng,
			'altitude' => $al,
			'speed' => $speed
		);

		$this->db->insert('practice_Drone_Data',$data);
	}

	public function getRssi($localId)
	{
		$this->db->from('rssi');

		$this->db->where('localId',$localId);
		$this->db->order_by('idx','DESC');

		$data=$this->db->get();

		return $data->row_array();
	}
}
