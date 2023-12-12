<?php 

Class Template{
	//variabel untuk menampung data view yang akan ditampilkan***
	var $template_data = array();

	//fungsi untuk mengambil data view yang ingin ditampilkan
	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}

	function view($template= '', $view= '', $view_data= array(), $return = FALSE)
	{	//agar class dapat mengakses  CodeIgniter’s native resources 	      seperti MVC pada CI
		$this->CI =& get_instance();
	
		if ($view) {
			//mengubah view menjadi data sehingga dapat dikirimkan oleh variabel yang disediakan
		$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
		return $this->CI->load->view($template, $this->template_data,$return);
		}else{
			// default view
			return $this->CI->load->view($template, $view_data,$return);
		}
	}


}
