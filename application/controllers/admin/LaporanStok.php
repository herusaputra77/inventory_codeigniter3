<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanStok extends CI_Controller
{

        public function __construct() {
            parent::__construct();
            $this->load->model('M_LaporanStok');
        }
    
    

    public function index()
    {
        $data = [
            'judul' => 'Laporan Stok Akhir',
            'isi' => 'admin/laporan_stok',

        ];

        $this->load->view('layout/v_isi', $data);
    }
    public function laporan_bulan()
    {

		
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
        $data = [
            'judul' => 'Laporan Stok Akhir',
            'isi' => 'admin/view_laporan',
            'stok_akhir' => $this->M_LaporanStok->get_stok_akhir($bulan, $tahun),

        ];

        $this->load->view('layout/v_isi', $data);
    }
}

/* End of file BarangKeluar.php */
