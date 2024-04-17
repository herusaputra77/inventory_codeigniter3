<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminBeranda extends CI_Controller {

    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'isi' => 'admin/beranda',

        ];
        // $data['notif'] =  $this->M_diamond->notif();
        $this->load->view('layout/v_isi', $data);
    }

}

/* End of file Controllername.php */
