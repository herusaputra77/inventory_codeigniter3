<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Stok extends CI_Model
{
    public function getStok($bulan, $tahun)
    {
        $this->db->select('*, sum(s.masuk) as jm, sum(keluar) as jk, sum(sisa) as sisa');
        $this->db->from('stok as s');
        $this->db->join('barang as b', 'b.kode_brg = s.kode_brg');
        $this->db->group_by('s.kode_brg');
        $this->db->order_by('s.tanggal', 'asc');
        $this->db->where('month(s.tanggal)', $bulan);
        $this->db->where('year(s.tanggal)', $tahun);
    
        $data = $this->db->get();
        return $data->result_array();
    }
    
    public function addStok()
    {

        $id_brg = $this->input->post('barang');
        $jumlah = $this->input->post('jumlah');

        $stok = $this->db->get_where('stok', ['kode_brg', $id_brg])->row_array();
        if($stok == null){
            $data = ['kode_brg' => $id_brg, 'stok' => $jumlah];
            return $this->db->insert('stok', $data);
            
        }else{
            $data = ['stok' => $jumlah];
            return $this->db->update('stok', $data);
        }
    }
}




/* End of file M_Stok.php */
