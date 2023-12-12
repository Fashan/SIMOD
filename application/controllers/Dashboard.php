<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Dashboard extends CI_Controller {

public function index()
{
	check_session();
$data['sensor'] = $this->main->get_where('tb_sensor',['mac_address' => '98:CD:AC:26:21:76']);
$data['barang'] = $this->main->get_where('tb_barang',['id' => $data['sensor']->barang_id]);
  $this->tmp->view('templates/template','dashboard1',$data);             
}
  

public function dashboard2()
{
	$data['sensor'] = $this->main->get_where('tb_sensor',['mac_address' => 'C4:5B:BE:63:0B:40']);
	$data['barang'] = $this->main->get_where('tb_barang',['id' => $data['sensor']->barang_id]);
	$this->tmp->view('templates/template','dashboard2',$data);              
}

public function barang()
{
	$data['barang'] = $this->main->get('tb_barang');
	$this->tmp->view('templates/template','barang',$data);              
}

public function tambah_barang(){
	$get_data = $this->input->post(null,true);
	$this->main->insert('tb_barang',$get_data);
	setFlashMsg('success', 'data', 'berhasil di simpan');
	redirect('dashboard/barang');
}

public function hapus_barang($id){
	$this->main->delete('tb_barang',['id' => $id]);
	setFlashMsg('success', 'data', 'berhasil di hapus');
	redirect('dashboard/barang');
}

public function get_barang(){
	$id = $this->input->post('id',true);
	$barang = $this->main->get_where('tb_barang',['id' => $id]);
	echo json_encode($barang);
}

public function edit_barang(){
	$get_data = $this->input->post(null,true);
	$this->main->update('tb_barang',$get_data,['id' => $get_data['id']]);
	setFlashMsg('success', 'data', 'berhasil di edit');
	redirect('dashboard/barang');
}

public function set_barang(){
	$get_data = $this->input->post(null,true);
	if ($get_data['barang1']) {
		$this->main->update('tb_sensor',['barang_id' => $get_data['barang1']],['mac_address' => '98:CD:AC:26:21:76']);
	}
	if ($get_data['barang2']) {
		$this->main->update('tb_sensor',['barang_id' => $get_data['barang2']],['mac_address' => 'C4:5B:BE:63:0B:40']);
	}
	$client = $_SERVER['HTTP_REFERER'];
	setFlashMsg('success', 'SETUP ALAT', 'berhasil di lakukan');
	redirect($client);
}

}
        
    /* End of file  dashboard.php */
        
                            