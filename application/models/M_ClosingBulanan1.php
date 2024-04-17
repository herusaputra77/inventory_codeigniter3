<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_ClosingBulanan extends CI_Model
{

public function addClosing($bulan, $tahun){
    $data = [
        'bulan' => $bulan,
        'tahun' => $tahun,
    ];
    
    $this->db->insert('closing', $data);
    
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

// public function aksi_closing($bulan, $tahun)
// {
//     // Initialize counter for AWL

// $tanggalclosing = $tahun.'-'.$bulan.'-01';
// $tanggal = date('Y-m-d', strtotime('+1 month', strtotime($tanggalclosing)));

//     // Get data from the database
//     $data_stok = $this->ambil_stok($bulan, $tahun);

//     // var_dump($data_stok);die();
//     if ($data_stok) {
//         // Truncate tmp_stok
//         $this->db->truncate('tmp_stok');

//         foreach ($data_stok as $key => $value) {
//             // Extract values
//             $id_brg     = $value['id_brg'];
//             $kode_brg   = $value['kode_brg'];
//             $jenis_tr   = 'AWL';
//             $jm         = $value['jm'];
//             $jk         = $value['jk'];
//             $sisa       = $value['sisa'];

//             // INSERT INTO tmp_stok
//             $barang = $this->db->get_where('barang', array('id_brg' => $id_brg))->row_array();
//             $kdawl = 1;
//             $data_tmp_stok = array(
//                 'tanggal'   => $tanggal,
//                 'kode_brg'  => $id_brg,
//                 'jenis_tr'  => 'AWAL',
//                 'notr'      => 'AWL'.$kdawl++,
//                 'nama_brg'  => $barang['nama_brg'],
//                 'masuk'     => 0,
//                 'keluar'    => 0,
//                 'sisa'      => $sisa

//             );
//             $periode_closing = $tahun . $bulan;
//             $tgl_cl = $tahun . '-' . $bulan . '-01';
//             $periode_closing = date('Ym', strtotime('+1 month', strtotime($tgl_cl)));
//             $periode_berjalan = date('Ym', strtotime('+1 month', strtotime($tgl_cl)));

            
//             $data = array(
//                 'periode_berjalan' => $periode_berjalan,
//                 'periode_closing' => $periode_closing
//             );
            
//             $this->db->update('tb_setting', $data);
            


//             $this->db->insert('tmp_stok', $data_tmp_stok);
//         }
//             $this->insert_stok_bytemp();
//             $this->db->truncate('tmp_stok');

//             $data_closing = array(
//                 'bulan' =>  $bulan,
//                 'tahun' =>  $tahun,
//                 'status' => 1,
//             );
//             $this->db->insert('closing', $data_closing);
        
//     } else {
//         // Handle the case where $data_stok is empty or NULL
//         return array('response' => 'GAGAL');
//     }

//     // Return success response
//     return array('response' => 'SUKSES');
// }
public function aksi_closing($bulan, $tahun)
{
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
            // $barang = $this->db->get_where('barang', array('id_brg' => $id_brg))->row_array();
            $barang = $this->db->get_where('barang', array('id_brg' => $id_brg))->row_array();

            $data_tmp_stok = array(
                'tanggal'   => $tanggal,
                'id_brg'    => $barang['id_brg'],
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
        $periode_closing = date('Ym', strtotime('+1 month', strtotime($tgl_cl)));
        $periode_berjalan = date('Ym', strtotime('+2 month', strtotime($tgl_cl)));

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


public function insert_stok_bytemp()
{
    return $this->db->query("INSERT INTO stok ( tanggal,id_brg, kode_brg, jenis_tr, notr, nama_brg, masuk, keluar, sisa) (select tanggal,id_brg, kode_brg, jenis_tr, notr, nama_brg, masuk, keluar,sisa from tmp_stok)");
}


	public function ambil_stok($bulan, $tahun)
    {
        $query = $this->db->query("SELECT * ,sum(masuk) as jm, sum(keluar) as jk, sum(sisa) + sum(s.masuk)-sum(keluar) as sisa from stok as s left join barang as b on b.id_brg = s.kode_brg where month(tanggal) = $bulan and year(tanggal) = $tahun group by s.kode_brg order by s.tanggal desc");
        return $query->result_array();
    }
    
	public function getStokTmp($bulan, $tahun)
    {
		$this->db->select('*');
        $this->db->from('tmp_stok');
       
        $query = $this->db->get();
        return $query->result_array();
    }
	// public function getClosing($bulan, $tahun){
	// 	$this->db->where('month(tanggal)',$bulan);
    //   	$this->db->where('year(tanggal)',$tahun);
	// 	$query = $this->db->get('tmp_stok')->row_array();
	// 	return $query;
	// }

    // public function cekClosing($bulan, $tahun)
    // {
    //     $this->db->where('bulan', $bulan);
    //     $this->db->where('tahun', $tahun);
    //     $query = $this->db->get('closing');
    //     return $query->num_rows() > 0; // Return true if there is a closing record for the specified month and year
    // }


	public function rowClosing($bulan, $tahun){
		$this->db->where('month(tanggal)',$bulan);
      	$this->db->where('year(tanggal)',$tahun);
        
            $bulan_sekarang = intval(date('n'));
            $tahun_sekarang = intval(date('Y'));         
            $query = $this->db->get('stok')->row_array();
            return $query;
        }
        
}

/* End of file M_Stok.php */