<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function index()
    {
        $data = [
            'judul' => 'User',
            'isi' => 'user/user',

        ];
        $data['user'] = $this->M_User->get_user();
        $data['roles'] = $this->db->get('role')->result_array();
        // $data['notif'] =  $this->M_diamond->notif();
        $this->load->view('layout/v_isi', $data);
    }
    public function add()
    {
        $this->_rules();
        $this->M_User->addUser_user();
        redirect('user/User');
    }
    public function delete($id)
    {
        $this->_rules();
        $this->M_User->deleteUser($id);
        redirect('user/User');
    }
    public function edit()
    {
        $this->_rules();
        $this->M_User->editUser_user($id);
        redirect('user/User');
    }
    public function profile()
    {
        
        $data = [
            'judul' => 'Profile',
            'isi' => 'user/profile',

        ];
        $id = $this->session->userdata('id_user');
        
        $data['user'] = $this->M_User->getUserId($id);
        // var_dump($data['user']);
        // $data['notif'] =  $this->M_diamond->notif();
        $this->load->view('layout/v_isi', $data);
        
    }
    public function ganti_pass()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password2', 'trim|required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            $this->profile();
        } else {
            $this->M_User->gantiPass();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data Berhasil di tambah</div>');
            redirect('welcome/logout');
        }
    }
    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        // $this->form_validation->set_rules('no_hp', 'No Hp', 'trim|required');
    }

}

/* End of file User.php */
