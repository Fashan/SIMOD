<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Laporan extends CI_Controller {

public function index()
{
	$data['data'] = '';
  $this->tmp->view('templates/template','laporan',$data);              
}

public function rangedate(){
	$input = $this->input->post(null,true);
	$data['start_date'] = $input['start_date'];
	$data['end_date'] = $input['end_date'];
	$data['data'] = $this->sensor->get_data_rangedate($input['start_date'],$input['end_date']);
	$this->tmp->view('templates/template','laporan',$data);
}

public function print(){
	$input = $this->input->post(null,true);
	require_once FCPATH . '/vendor/autoload.php';
	$data['data'] = $this->sensor->get_data_rangedate($input['start_date'],$input['end_date']);
	$html = $this->load->view('cetak_laporan',$data,TRUE);
	$mpdf = new \Mpdf\Mpdf();
	$mpdf->WriteHTML($html);
	$mpdf->Output('Laporan_penggunaan.pdf',"D");

	var_dump($data);
}

public function tampilan_print(){
	$data['data'] = $this->sensor->get_data_rangedate("2022-06-01","2022-06-01");
	$this->load->view('cetak_laporan',$data);
}
}
        
    /* End of file  laporan.php */
        
                            