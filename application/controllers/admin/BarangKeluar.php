<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangKeluar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_BarangKeluar');
    }



    public function index()
    {
        $data = [
            'judul' => 'Barang keluar',
            'isi' => 'admin/barang_keluar',
            'barang' => $this->M_Barang->getBarang(),
            'barangKeluar' => $this->M_BarangKeluar->getBk()

        ];

        $this->load->view('layout/v_isi', $data);
    }
    public function tambah()
    {
        $data = [
            'judul' => 'Tambah Barang keluar',
            'isi' => 'admin/tambah_bk',
            'barang' => $this->M_Barang->getBarang(),
            'kode_bk' =>  $this->M_BarangKeluar->CreateCode()

        ];

        $this->load->view('layout/v_isi', $data);
    }
    public function add()
    {
        $id_brg = $this->input->post('barang');
        $jumlah = $this->input->post('jumlah');
        $kode_brg = $this->db->query("SELECT kode_brg from barang where id_brg = '$id_brg'")->row()->kode_brg;
        $stok_brg = $this->M_BarangKeluar->checkStock($kode_brg);
        $jumlah_sisa = $stok_brg['jumlah_sisa'];

        if ($jumlah_sisa < $jumlah) {
            $this->session->set_flashdata('error', 'Gagal input jumlah keluar melebihi stok');
            redirect('admin/BarangKeluar');
        }

        $data = [
            'judul' => 'Tambah Barang Keluar',
            'isi' => 'admin/tambah_bk',
            'barang' => $this->M_Barang->getBarang(),
            'kode_bk' =>  $this->M_BarangKeluar->CreateCode()
        ];

        $this->load->view('layout/v_isi', $data);

        $this->M_BarangKeluar->addBk();
        $this->M_BarangKeluar->addStok();

        redirect('admin/BarangKeluar');
    }
    public function editBk($id)
    {

        $data = [
            'judul' => 'Edit Barang Keluar',
            'isi' => 'admin/edit_bk',
            'barang' => $this->M_Barang->getBarang(),
            'bk' => $this->M_BarangKeluar->getBkId($id)

        ];
        // var_dump($data['barangMasuk']);

        $this->load->view('layout/v_isi', $data);
    }
    public function edit()
    {
        $this->M_BarangKeluar->editBk();
        redirect('admin/BarangKeluar');
    }
    public function release($id)
    {
        $this->M_BarangKeluar->release($id);
        redirect('admin/BarangKeluar');
    }

    public function delete($id)
    {
        $result = $this->M_BarangKeluar->deleteBk($id);

        if ($result) {
            $this->session->set_flashdata('success', 'Barang keluar berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus barang keluar');
        }
        redirect('admin/BarangKeluar'); // Change the URL if necessary
    }
}

/* End of file BarangKeluar.php */
