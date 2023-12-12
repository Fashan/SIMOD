<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Sensor extends CI_Controller {

public function index()
{
                
}


public function get_data(){
	$input = $this->input->post(null,true);
	$user_id = userdata()->user_id;
	$data = $this->db->select('*')->from('tb_data')->where(['barang_id' => $input['barang_id'],'sensor_id' => $input['sensor_id'],'user_id' => $user_id])->order_by('id','desc')->limit(1)->get();
	$data = $data->row();
	echo json_encode($data);
}

public function get_date(){
	$input = $this->input->post(null,true);
	$sensor = $this->main->get_where('tb_sensor',['mac_address' => $input['mac_address']]);
	$allrows = $this->sensor->get_date(0,0,$sensor);
	
	if (count($allrows) > 5) {
		$limit = 5;
		$rowno = count($allrows) - $limit;
		$date_data = $this->sensor->get_date($limit,$rowno,$sensor);
	}else {
		$date_data = $this->sensor->get_date(0,0,$sensor);
	}

	$date = [];
	$energy = [];
	foreach ($date_data as $data) {
		$date[] = custom_date(('d-M-Y'),$data->date);
		$energy[] = $data->energy;
	}
	
	$response = [
		"energy" => $energy,
		"date" => $date,
		
	];
	echo json_encode($response);
}








public function get_week(){
	$input = $this->input->post(null,true);
	$sensor = $this->main->get_where('tb_sensor',['mac_address' => $input['mac_address']]);
	$allrows = $this->sensor->get_week(0,0,$sensor);
	if (count($allrows) > 5) {
		$limit = 5;
		$rowno = count($allrows) - $limit;
		$week_data = $this->sensor->get_week($limit,$rowno,$sensor);
	}else {
		$week_data = $this->sensor->get_week(0,0,$sensor);
	}
	
	$week = [];
	$energy = [];
	

	foreach ($week_data as $data) {
		$week[] = custom_date('d-M-Y',$data->week);
		$energy[] = $data->energy;
	}
	
	$response = [
		"week" => $week,
		"energy" => $energy,
	];
	echo json_encode($response);
}

public function get_month(){
	$input = $this->input->post(null,true);
	$sensor = $this->main->get_where('tb_sensor',['mac_address' => $input['mac_address']]);
	$allrows = $this->sensor->get_month(0,0,$sensor);
	if (count($allrows) > 5) {
		$limit = 5;
		$rowno = count($allrows) - $limit;
		$month_data = $this->sensor->get_month($limit,$rowno,$sensor);
	}else {
		$month_data = $this->sensor->get_month(0,0,$sensor);
	}
	
	$month = [];
	$energy = [];
	
	foreach ($month_data as $data) {
			$month[]=custom_date('d-M-Y',$data->month);
			$energy[]=$data->energy;
		
	}
	
	$response = [
		"month" => $month,
		"energy" => $energy,
	];
	echo json_encode($response);
}

public function send_data($energy,$voltage,$current,$power,$mac_address){
	$sensor = $this->main->get_where('tb_sensor',['mac_address' => $mac_address]);
	$sensor_id = $sensor->id;
	$barang_id = $sensor->barang_id;
	$user_id = $sensor->user_id;
	$input = [
		'energy' => $energy,
		'voltage' => $voltage,
		'current' => $current,
		'power' => $power,
		'sensor_id' => $sensor_id,
		'barang_id' => $barang_id,
		'user_id' => $user_id,
	];
	
	if ($input['power'] < 600) {
		$data = $this->main->insert('tb_data',$input);
	}

	if ($data) {
		echo "success to save data :)";
	}else{
		echo "failed";
	}
	
}

public function data_notification(){
	$sensor = $this->main->get('tb_sensor');

	$this->db->select('*');
	$this->db->where('sensor_id = '.$sensor[0]->id.' AND barang_id = '.$sensor[0]->barang_id.' AND user_id = '.userdata()->user_id );
	$data1 = $this->db->get('tb_data');
	$data1 = $data1->result();

	$this->db->select('*');
	$this->db->where('sensor_id = '.$sensor[1]->id.' AND barang_id = '.$sensor[1]->barang_id.' AND user_id = '.userdata()->user_id );
	$data2 = $this->db->get('tb_data');
	$data2 = $data2->result();

	$this->db->select('*');
	$this->db->where('id = '.$sensor[0]->barang_id.' OR id = '.$sensor[1]->barang_id);
	$data3 = $this->db->get('tb_barang');
	$data3 = $data3->result();
	
	$response =[
		'barang1' => $data3[0]->nama_barang,
		'energi1' => $data1[count($data1)-1]->energy,
		'barang2' => $data3[1]->nama_barang,
		'energi2' => $data2[count($data2)-1]->energy,
		
	];
	echo json_encode($response);
}

        
}
        
    /* End of file  sensor.php */
        
                            