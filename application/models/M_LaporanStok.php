<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_LaporanStok extends CI_Model
{

        public function get_stok_akhir($bulan, $tahun)
        {       
        $this->db->select("
        *,
        CASE 
            WHEN jenis_tr = 'AWL' THEN COALESCE(sisa,0)
            ELSE 0
        END AS stokawl,
        SUM(masuk) AS jm,
        SUM(keluar) AS jk,
        CASE 
            WHEN (SELECT COUNT(*) FROM stok WHERE jenis_tr = 'AWL' AND MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun) >= 0
            THEN COALESCE(SUM(sisa), 0) + SUM(masuk) - COALESCE(SUM(keluar), 0)
            ELSE 0
        END AS stok_akhir"
                );
                $this->db->from('stok as s');
                $this->db->join('barang as b', 'b.id_brg = s.id_brg');
                $this->db->where('MONTH(tanggal)', $bulan);
                $this->db->where('YEAR(tanggal)', $tahun);
                $this->db->group_by('s.id_brg');
                
                $query = $this->db->get();
                return $query->result_array();
        }    
        // public function get_stok_akhir($bulan, $tahun)
        // {
        //     $this->db->select('*,sum(masuk) as jm, sum(keluar) as jk, sum(sisa) + sum(A.masuk)-sum(keluar) as sisa');
        //     $this->db->from('stok as A');
        //     $this->db->join('barang as B', 'B.id_brg = A.id_brg');
        //     $this->db->group_by('A.id_brg');
        //     $this->db->order_by('A.id_brg', 'asc');
        //     $this->db->where('month(tanggal)',$bulan); 
        //       $this->db->where('year(tanggal)',$tahun);
            
        
        //     $data = $this->db->get();
        //     return $data->result_array();
        //     //  var_dump()die();       
        // }


}