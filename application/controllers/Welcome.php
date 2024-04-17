<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	 public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->library('form_validation');
        $this->load->model('M_User');
    }
	public function index()
	{
		$this->load->view('index.php');
	}
	public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('index');
        } else {
            $auth = $this->M_User->cek_login();
            // var_dump($auth);
            if ($auth == false) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
						 Email dan Password anda salah!!!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>');
                redirect('welcome/login');
            }elseif($auth['status'] ==0){
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
						Akun tidak aktif, Silahkan Hubungin Team IT!!!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>');
                redirect('welcome/login');
            
            } else {
                $this->session->set_userdata('id_user', $auth['id_user']);
                 $this->session->set_userdata('nama', $auth['nama']);
                $this->session->set_userdata('email', $auth['email']);
                 $this->session->set_userdata('role_id', $auth['role_id']);
                
                $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
						Selamat Datang!!!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>');
                        // var_dump($auth['role_id']);
                        // die;
                switch ($auth['role_id']) {
                    case 1:
                        redirect('admin/AdminBeranda');
                        break;
                    case 2:
                        redirect('user/UserBeranda');
                        break;
                    default:
                        break;
                }
            }
        }
    }
	public function register()
	{
		$this->load->view('register.php');
	}
	public function reg_aksi()
    {

		
        $this->_rules();
        if ($this->form_validation->run() ==  FALSE) {
            $this->register();
        } else {
            $this->M_User->register();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Register Berhasil!!!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>');

            redirect('welcome', 'refresh');
        }
    }
	public function logout()
    {
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('email');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Anda Berhasil Keluar!!!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>');
        redirect('welcome');
    }
	
	public function _rules()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password]');
        // $this->form_validation->set_rules('no_hp', 'No Hp', 'trim|required');
    }
}
