<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangMasuk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_BarangMasuk');

    }


    public function index()
    {
        $data = [
            'judul' => 'Barang Masuk',
            'isi' => 'admin/barang_masuk',
            'barang' => $this->M_Barang->getBarang(),
            'barangMasuk' => $this->M_BarangMasuk->getBm()

        ];

        $this->load->view('layout/v_isi', $data);
    }
    public function tambah()
    {
        $data = [
            'judul' => 'Tambah Barang Masuk',
            'isi' => 'admin/tambah_bm',
            'barang' => $this->M_Barang->getBarang(),
            'kode_bm' =>  $this->M_BarangMasuk->CreateCode()

        ];

        $this->load->view('layout/v_isi', $data);
    }

    // Model untuk tabel setting periode
//     class M_BarangMasuk extends CI_Model {
//     public function getStatusPeriodeTerbaru() {
//         $this->db->select('status');
//         $this->db->order_by('id_periode', 'DESC');
//         $this->db->limit(1);
//         $query = $this->db->get('tb_setting_periode');
//         return $query->row()->status;
//     }
// }
public function add()
{
    $this->form_validation->set_rules(
        'barang','Barang',"required|trim"
    );
    $this->form_validation->set_rules( 'tgl_masuk','Tanggal Masuk',"required|trim");
    $this->form_validation->set_rules( 'harga','Harga',"required|trim");
    $this->form_validation->set_rules( 'suplier','Supplier',"required|trim");
    $this->form_validation->set_rules( 'jumlah','Jumlah',"required|trim");
    
    if ($this->form_validation->run() == FALSE) {
        $this->tambah();
    } else {
        $this->M_BarangMasuk->addBm();
        $this->M_BarangMasuk->addStok();
        redirect('admin/BarangMasuk');
    }
} 

public function input_transaksi() {
    // Panggil method addBm() dari model M_BarangMasuk
    $result = $this->M_BarangMasuk->addBm();

    // Tampilkan notifikasi berdasarkan hasil return dari method addBm()
    if ($result === true) {
        // Jika input berhasil
        $this->session->set_flashdata('success', 'Input transaksi berhasil.');
    } else {
        // Jika input gagal
        $this->session->set_flashdata('error', $result);
    }

    redirect('halaman_input_transaksi');
}

public function editBm($id)
{
    
    $data = [
        'judul' => 'Edit Barang Masuk',
        'isi' => 'admin/editBm',
        'barang' => $this->M_Barang->getBarang(),
        'bm' => $this->M_BarangMasuk->getBmId($id)

    ];
    // var_dump($data['barangMasuk']);

    $this->load->view('layout/v_isi', $data);
}
public function edit()
{
    $this->M_BarangMasuk->editBm();
    redirect('admin/BarangMasuk');

}
public function release($id)
{
    $this->M_BarangMasuk->release($id);
    redirect('admin/BarangMasuk');
}
public function deleteBm($ids) {
    // No need to get the ID from POST data, as it's passed in the URL parameter
    // $id = $this->input->post('ids');

    // Pass the ID directly to the deleteBm method
    $this->M_BarangMasuk->deleteBm($ids);

    // Flash message for successful deletion
    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

    // Redirect back to the BarangMasuk page after deletion
    redirect('admin/BarangMasuk');
}

        
}

/* End of file BarangMasuk.php */
