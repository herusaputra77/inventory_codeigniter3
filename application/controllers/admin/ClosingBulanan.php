
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ClosingBulanan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_ClosingBulanan');
    }



    public function index()
    {
        $data = [
            'judul' => 'Closing Bulanan',
            'isi' => 'admin/closing_bulanan',
            // 'stok_akhir' => $this->M_ClosingBulanan->get_stok_akhir(),
        ];
        // Ambil bulan dan tahun saat ini
        $bulan = date('m');
        $tahun = date('Y');
        $belum_closing = $this->M_ClosingBulanan->getBelumClosing($bulan, $tahun); // Ganti Nama_Model dengan nama model Anda

        // $data['result'] = $this->db->query("SELECT tanggal FROM stok ORDER BY tanggal ASC LIMIT 1")->result_array();
        // $data['result2'] = $belum_closing;
        // var_dump($belum_closing);
        // die;

        $this->load->view('layout/v_isi', $data);
    }
    //TAMPILKAN BULAN YANG BELUM DI CLOSING
    public function tampilkan_bulan_belum_closing()
    {
        // Ambil bulan dan tahun saat ini
        $bulan = date('m');
        $tahun = date('Y');

        // Query database untuk mendapatkan bulan yang belum di-closing
        $belum_closing = $this->M_ClosingBulanan->getBelumClosing($bulan, $tahun); // Ganti Nama_Model dengan nama model Anda

        // Kirim data ke view
        $data['belum_closing'] = $belum_closing;

        // Load view untuk menampilkan data
        $this->load->view('closing_bulanan', $data);
    }

    //AKSI CLOSING
    public function aksi_closing()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
    
        $bulan_sekarang = intval(date('n'));
        $tahun_sekarang = intval(date('Y'));
    
        if ($tahun > $tahun_sekarang || ($tahun == $tahun_sekarang && $bulan >= $bulan_sekarang)) {
            // Jika tahun yang diberikan lebih besar dari tahun sekarang, atau jika tahun sama tapi bulan lebih besar atau sama dengan bulan sekarang
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Anda belum bisa melakukan Closing untuk bulan ini.</div>');
            redirect('admin/ClosingBulanan');
            return;
        }
            // Buat string untuk kolom periode_closing
            $periode_closing = $tahun . $bulan;
     
        // Lanjutkan proses penutupan
        $closing = $this->M_ClosingBulanan->aksi_closing($bulan, $tahun);
    
        if ($closing['response'] == 'GAGAL') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">DATA TIDAK DITEMUKAN</div>');
            redirect('/admin/ClosingBulanan', 'refresh');
        } elseif ($closing['response'] == 'SUKSES') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">DATA BERHASIL DICLOSING</div>');
            redirect('/admin/ClosingBulanan', 'refresh');
        }
    }
    
}
