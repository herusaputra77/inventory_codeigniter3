<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

    
    public function index()
    {
        $this->load->model('M_Stok');
        $bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
        $data = [
            'judul' => 'Stok',
            'isi' => 'admin/stok',
            'stok' => $this->M_Stok->getStok($bulan,$tahun),
        ];

        var_dump($data['stok']);
        // die;

        $this->load->view('layout/v_isi', $data);
    }
    public function filter()
    {
        $this->load->model('M_Stok');
        $bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
        $data = [
            'judul' => 'Stok',
            'isi' => 'admin/stok',
            'stok' => $this->M_Stok->getStok($bulan,$tahun),
        ];

        // var_dump($data['stok']);
        // die;

        $this->load->view('layout/v_isi', $data);
    }
}


