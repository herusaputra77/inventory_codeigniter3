<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ClosingBulanan extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function ambil_stok($bulan, $tahun) {
        // Buat query untuk mengambil data stok
        $this->db->select('*, sum(masuk) as jm, sum(keluar) as jk, sum(sisa) + sum(A.masuk) - sum(keluar) as sisa');
        $this->db->from('stok as A');
        $this->db->join('barang as B', 'B.id_brg = A.id_brg');
        $this->db->group_by('A.id_brg');
        $this->db->order_by('A.id_brg', 'asc');
        $this->db->where('month(A.tanggal)', $bulan);
        $this->db->where('year(A.tanggal)', $tahun);
        
        // Jalankan query
        $query = $this->db->get();
        
        // Mengembalikan hasil query
        return $query->result_array();
    }

    public function aksi_closing($bulan, $tahun) {
        // Initialize counter for AWL
        $tanggalclosing = $tahun.'-'.$bulan.'-01';
        $tanggal = date('Y-m-d', strtotime('+1 month', strtotime($tanggalclosing)));

        // Get data from the database
        $data_stok = $this->ambil_stok($bulan, $tahun);

        if ($data_stok) {
            // Truncate tmp_stok
            $this->db->truncate('tmp_stok');

            $kdawl = 1; // Move this outside of the loop to ensure it increments correctly

            foreach ($data_stok as $key => $value) {
                // Extract values
                $id_brg     = $value['id_brg'];
                $kode_brg   = $value['kode_brg'];
                $nama_brg   = $value['nama_brg'];
                $jenis_tr   = 'AWL';
                $jm         = $value['jm'];
                $jk         = $value['jk'];
                $sisa       = $value['sisa'];

                // INSERT INTO tmp_stok
                $barang = $this->db->get_where('barang', array('id_brg' => $id_brg))->row_array();

                $data_tmp_stok = array(
                    'tanggal'   => $tanggal,
                    'id_brg'    => $id_brg,
                    'kode_brg'  => $kode_brg,
                    'jenis_tr'  => 'AWL',
                    'notr'      => 'AWL'.$kdawl++,
                    'nama_brg'  => $nama_brg,
                    'masuk'     => 0,
                    'keluar'    => 0,
                    'sisa'      => $sisa
                );

                $this->db->insert('tmp_stok', $data_tmp_stok);
            }

            $tgl_cl = $tahun . '-' . $bulan . '-01';
            $periode_closing = $tahun . $bulan;
            $periode_berjalan = date('Ym', strtotime('+1 month', strtotime($tgl_cl))); // Menambah satu bulan dari tanggal
            
            $data = array(
                'periode_berjalan' => $periode_berjalan,
                'periode_closing' => $periode_closing
            );
            
            $this->db->update('tb_setting', $data);

            $this->insert_stok_bytemp();
            $this->db->truncate('tmp_stok');

            $data_closing = array(
                'bulan' =>  $bulan,
                'tahun' =>  $tahun,
                'status' => 1,
            );
            $this->db->insert('closing', $data_closing);
            
            return array('response' => 'SUKSES');
        } else {
            // Handle the case where $data_stok is empty or NULL
            return array('response' => 'GAGAL');
        }
    
    }
    public function getBelumClosing($bulan, $tahun)
    {
        // Query database untuk mendapatkan bulan yang belum di-closing
        $this->db->select('tanggal');
        $this->db->from('stok');
        $this->db->where('jenis_tr', 'AWL');
        $this->db->where('MONTH(tanggal)', $bulan); 
        $this->db->where('YEAR(tanggal)', $tahun);
         
    
        $query = $this->db->get();
    
        // Kembalikan hasil query
        return $query->result_array();
    }
     public function insert_stok_bytemp()
    {
        return $this->db->query("INSERT INTO stok ( tanggal,id_brg, kode_brg, jenis_tr, notr, nama_brg, masuk, keluar, sisa) (select tanggal,id_brg, kode_brg, jenis_tr, notr, nama_brg, masuk, keluar,sisa from tmp_stok)");
    }
}
