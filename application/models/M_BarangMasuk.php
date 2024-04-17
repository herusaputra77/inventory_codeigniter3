<?php



defined('BASEPATH') or exit('No direct script access allowed');

class M_BarangMasuk extends CI_Model
{
    public function getBm()
    {

        $this->db->join('barang', 'barang.id_brg = brg_masuk.id_brg');
        return  $this->db->get('brg_masuk')->result_array();
    }

    public function CreateCode()
    {
        $this->db->select('RIGHT(brg_masuk.notr,5) as kode_bm', FALSE);
        $this->db->order_by('kode_bm', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('brg_masuk');
        // var_dump($query);
        // die;
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_bm) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodetampil = "TR-BM" . $batas;
        // echo $kodetampil;
        return $kodetampil;
    }
    public function addBm()
    {
        $notr = $this->input->post('id_transaksi');
        $brg = $this->input->post('barang');
        $tgl_msk = $this->input->post('tgl_masuk'); 
        $suplier = $this->input->post('suplier');
        $harga = $this->input->post('harga');
        $jumlah = $this->input->post('jumlah');
    
        // Mengambil periode berjalan dari tabel setting
        $query = $this->db->get('tb_setting');  
        $setting = $query->row();
        $periode_closing = $setting->periode_berjalan;
    
        // Mengambil periode berjalan dari tanggal masuk
        $periode_berjalan = date('Ym', strtotime($tgl_msk));
        $notif = ($periode_berjalan >= $periode_closing) ? 'TRUE' : 'BEDA PERIODE';
    
        if ($notif == "BEDA PERIODE") {
            // Tampilkan pesan kesalahan jika tanggal masuk di luar periode berjalan
            $this->session->set_flashdata('error', 'Tanggal masuk berada di luar periode berjalan.');
            redirect('admin/BarangMasuk');
        } else {
            $data = [
                'id_brg' => $brg,
                'notr' => $notr,
                'harga' => $harga * $jumlah,
                'jumlah' => $jumlah,
                'supplier' => $suplier,
                'tgl_masuk' => $tgl_msk,
            ]; 
            $this->db->insert('brg_masuk', $data);
        }
    }
    public function deleteBm($id)
    {
		$this->db->where('ids',$id);
		$this->db->delete('brg_masuk');
	}
    public function lessStok($id, $jml)
    {
        // Mengurangi stok barang berdasarkan ID dan jumlah yang diberikan
        $this->db->where('id_brg', $id);
        $stok = $this->db->get('stok')->row_array();
        if ($stok) {
            $tot = $stok['stok'] - $jml;
            $data = ['stok' => $tot];
            $this->db->where('id_brg', $id);
            $this->db->update('stok', $data);
        }
    }
    
    public function addStok()
    {
        $notr = $this->input->post('id_transaksi');
        $brg = $this->input->post('barang');
        $tgl_msk = $this->input->post('tgl_masuk');
        $harga = $this->input->post('harga');
        $jumlah = $this->input->post('jumlah');
    
        // Fetch product information
        $barang = $this->db->where('id_brg', $brg)->get('barang')->row_array();
    
        // Fetch existing stock for the product
        $existing_stock = $this->db->where('kode_brg', $brg)->get('stok')->row_array();
        $current_stock = $existing_stock ? $existing_stock['stok'] : 0;
    
        // Calculate new stock
        $new_stock = $current_stock + $jumlah;
    
        // Update stock table
        $data = [
            'tanggal' => $tgl_msk,
            'id_brg' => $brg,
            'kode_brg' => $barang['kode_brg'], // Assuming 'kode_brg' is a column in the 'barang' table
            'jenis_tr' => 'IN',
            'notr' => $notr,
            'nama_brg' => $barang['nama_brg'],
            'masuk' => $jumlah,
        ];
    
        // Insert new stock record
        $this->db->insert('stok', $data);
        if ($existing_stock) {
            $this->db->where('kode_brg', $brg)->update('stok', ['stok' => $new_stock]);
        }
    
        return true; 
    }

    public function editBm()
    {
        $brg = $this->input->post('barang');
        $tgl_msk = $this->input->post('tgl_masuk'); 
        $suplier = $this->input->post('suplier');
        $harga = $this->input->post('harga');
        $jumlah = $this->input->post('jumlah');
        $ids = $this->input->post('ids');
        
        $data = [
            'id_brg' => $brg,
            'harga' => $harga * $jumlah,
            'jumlah' => $jumlah,
            'supplier' => $suplier,
            'tgl_masuk' => $tgl_msk,
        ]; 
        
        $this->db->where('ids', $ids);
        $this->db->update('brg_masuk', $data);
    }
    public function getBmId($id)
    {
        $this->db->where('ids', $id); 
        return $this->db->get('brg_masuk')->row_array();
    }
    public function release($id)
    {
        
        $this->db->where('ids', $id);
        $this->db->update('brg_masuk', ['status_bm' => 'Closed']);
        
        
    }
    
}

/* End of file M_BarangMasuk.php */
