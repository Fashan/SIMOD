<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		if (userdata()) redirect('dashboard');
        $data['judul'] = "Login";
        $this->load->view('sign-in',$data);
	}

	public function register()
	{
		if (userdata()) redirect('dashboard');
        $data['judul'] = "register";
        $this->load->view('sign-up',$data);
	}


     public function signup()
    {
        if (userdata()) redirect('dashboard');

       $config = [
               'username' => [
                    'field'    => 'nama',
                     'label'   => 'nama',
                     'rules'   => 'required|trim|min_length[6]',
                     'errors'    => [
                        'required' => 'kolom {field} wajib diisi',
                        'min_length' => 'minimal 6 karakter',
                     ]
                  ],
                  'email' => [
                    'field'    => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|trim',
                     'errors'    => [
                        'required' => 'kolom {field} wajib diisi',
                     ]
                  ],
                  'password' => [
                    'field'    => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required|trim|min_length[8]',
                     'errors'    => [
                        'required' => 'kolom {field} wajib diisi',
                        'min_length' => 'minimal 8 karakter',
                     ]
                  ],
                  'password2' => [
                    'field'    => 'password2',
                     'label'   => 'Password Confirmation',
                     'rules'   => 'required|trim|matches[password]',
                     'errors'    => [
                        'required' => 'kolom {field} wajib diisi',
                        'matches' => 'kolom {field} tidak sama',
                     ]
                  ]
             
            ];


        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            $this->load->view('sign-up');
        } else {
            $input = $this->input->post(null, true);
            $user = $input['email'];

            unset($input['password2']);
            $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
            $this->main->insert('users', $input);

            //membuat session user
            $getUser = $this->main->get_where('users', ['email' => $user]);
            $this->session->set_userdata('user_session', $getUser->user_id);
				$this->main->update('tb_sensor',['user_id' =>$getUser->user_id],['mac_address' => '98:CD:AC:26:21:76']);
				$this->main->update('tb_sensor',['user_id' =>$getUser->user_id],['mac_address' => 'C4:5B:BE:63:0B:40']);
				redirect('dashboard');

        }
    }


    public function signin(){

        
         $config = [
               'email' => [
                    'field'    => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|trim',
                     'errors'    => [
                        'required' => 'kolom {field} wajib disi',
                     ]
                  ],
                   'password' => [
                    'field'    => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required|trim',
                     'errors'    => [
                        'required' => 'kolom {field} wajib diisi',
                     ]
                  ],
              ];
            $this->form_validation->set_rules($config);


        if ($this->form_validation->run() == false) {
            $this->load->view('sign-in');
        } else {
            //pengambilan data
            $input = $this->input->post(null, true);
            $user = $input['email'];
            $pass = $input['password'];

            $getUser = $this->main->get_where('users', ['email' => $user]);
           
           //pengecekan user
		   if ($getUser) {
			// pengecekan password
			if (password_verify($pass, $getUser->password)) {
				$this->session->set_userdata('user_session', $getUser->user_id);
				$this->main->update('tb_sensor',['user_id' =>$getUser->user_id],['mac_address' => '98:CD:AC:26:21:76']);
				$this->main->update('tb_sensor',['user_id' =>$getUser->user_id],['mac_address' => 'C4:5B:BE:63:0B:40']);
				redirect('dashboard');
			} else {
				setFlashMsg('danger','Maaf','Password anda salah');
				$this->load->view('sign-in');
			}
			} else {
			//user belum terdaftar
			setFlashMsg('warning','Maaf','email belum terdaftar');
				$this->load->view('sign-in');
		}
        }
         // echo json_encode($response);
    }


    public function signout()
    {
        $this->session->unset_userdata('user_session');
        redirect('auth');
    }

}



/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
