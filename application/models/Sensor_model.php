<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Sensor_model extends CI_Model {
                        
public function login(){
                        
                                
}
public function get_data_rangedate($start_date,$end_date){
	$user_id = userdata()->user_id;
	$this->db->select('tb_data.*,tb_barang.nama_barang');
	$this->db->from('tb_data');
	$this->db->where('DATE(tb_data.date) BETWEEN "'.$start_date.'" AND "'.$end_date.'" AND tb_data.user_id = '.$user_id);
	$this->db->join('tb_barang','tb_barang.id = tb_data.barang_id');
	$query = $this->db->get();
	return $query->result();
}



public function get_allrow($mac_address,$barang_id){
	$this->db->select("tb_data.*");
	$this->db->where('tb_data.barang_id = '.$barang_id.'');
	$this->db->from("tb_data");
	$this->db->join('tb_sensor','tb_sensor.mac_address ='.$mac_address);
	$query = $this->db->get();

	return $query->num_rows();
} 


public function get_date($limit,$rowno,$sensor){
	
	$this->db->select('date,AVG(energy) AS energy');
	$this->db->where('sensor_id = '.$sensor->id.' AND barang_id = '.$sensor->barang_id.' AND user_id = '.$sensor->user_id  );
	$this->db->group_by('DATE(date)');
	$query = $this->db->get('tb_data',$limit,$rowno);
	return $query->result();
	
	
	
}

public function get_week($limit,$rowno,$sensor){
	$this->db->select('date as week,AVG(energy) AS energy');
	$this->db->where('sensor_id = '.$sensor->id.' AND barang_id = '.$sensor->barang_id.' AND user_id = '.$sensor->user_id  );
	$this->db->group_by('YEARWEEK(date)');
	$query = $this->db->get('tb_data',$limit,$rowno);
	return $query->result();
}

public function get_month($limit,$rowno,$sensor){
	
	$this->db->select('date as month, AVG(energy) AS energy');
	$this->db->where('sensor_id = '.$sensor->id.' AND barang_id = '.$sensor->barang_id.' AND user_id = '.$sensor->user_id  );
	$this->db->group_by('MONTH(date)');
	$this->db->order_by('YEARWEEK(date)');
	$query = $this->db->get('tb_data',$limit,$rowno);
	return $query->result();
}




                        
}
                        
/* End of file sensor.php */
    
                        