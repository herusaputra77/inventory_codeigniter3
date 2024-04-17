<?php



defined('BASEPATH') or exit('No direct script access allowed');

class M_BarangKeluar extends CI_Model
{
    public function getBk()
    {

        $this->db->join('barang', 'barang.id_brg = brg_keluar.id_brg');
        return  $this->db->get('brg_keluar')->result_array();
    }

    public function CreateCode()
    {
        $this->db->select('RIGHT(brg_keluar.notr,5) as kode_bk', FALSE);
        $this->db->order_by('kode_bk', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('brg_keluar');
        // var_dump($query);
        // die;
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_bk) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodetampil = "TR-BK" . $batas;
        // echo $kodetampil;
        return $kodetampil;
    }
    public function addBk()
    {
        $tgl_keluar = $this->input->post('tgl_keluar');
        $tanggal_closing = $this->db->query("SELECT periode_berjalan FROM tb_setting")->row();
        $periode_closing = $tanggal_closing->periode_berjalan;
        $bulan_cl = substr($periode_closing,  4, 2);
        $tahun_cl = substr($periode_closing, 0, 4);
        $bulan_keluar = date('m', strtotime($tgl_keluar));
        $tahun_keluar = date('Y', strtotime($tgl_keluar));

        if ($tahun_keluar > $tahun_cl || ($tahun_keluar == $tahun_cl && $bulan_keluar > $bulan_cl)) {
            echo "Gagal menambahkan data barang keluar. Tanggal keluar setelah periode penutupan.";
        } else {
            $periode_berjalan = $this->db->query("SELECT CASE WHEN DATE_FORMAT('$tgl_keluar','%Y%m') >= $periode_closing THEN 'BEDA PERIODE' ELSE 'TRUE' END AS NOTIF")->row();
            $per_berjalan = $periode_berjalan->NOTIF;

            if ($per_berjalan == "BEDA PERIODE") {
                $notr = $this->input->post('id_transaksi');
                $brg = $this->input->post('barang');
                // $suplier = $this->input->post('suplier');
                $harga = $this->input->post('harga');
                $jumlah = $this->input->post('jumlah');

                $this->db->where('id_brg', $brg);
                $barang = $this->db->get('barang')->row_array();

                $data = [
                    'id_brg' => $brg,
                    'notr' => $notr,
                    'harga' => $harga * $jumlah,
                    'jenis_tr' => 'OUT',
                    'jumlah' => $jumlah,
                    'tgl_keluar' => $tgl_keluar,
                ];

                $this->db->insert('brg_keluar', $data);
            }
        }
    }
    public function checkStock($kode_brg)
    {
        $setting_data = $this->db->query("SELECT periode_berjalan FROM tb_setting ORDER BY periode_berjalan DESC LIMIT 1")->row_array();
        $periode_closing = $setting_data['periode_berjalan'];
        $bulan_cl = substr($periode_closing,  4, 2);
        $tahun_cl = substr($periode_closing, 0, 4);

        $stok_brg = $this->db->query("SELECT COALESCE(SUM(sisa),0) + COALESCE(SUM(masuk),0) - COALESCE(SUM(keluar),0) AS jumlah_sisa 
                                FROM stok 
                                WHERE kode_brg = '$kode_brg' AND MONTH(tanggal) = '$bulan_cl' AND YEAR(tanggal) ='$tahun_cl'")->row_array();

        return $stok_brg;
    }

    public function lessStok($stok)
    {
        $id_brg = $this->input->post('barang');
        // $jumlah = $this->input->post('jumlah');
        $data = ['stok' => $stok];


        $this->db->where('kode_brg', $id_brg);
        return $this->db->update('stok', $data);
    }
    public function addStok()
    {

        $notr = $this->input->post('id_transaksi');
        $brg = $this->input->post('barang');
        $tgl_keluar = $this->input->post('tgl_keluar');
        // $suplier = $this->input->post('suplier');
        $harga = $this->input->post('harga');
        $jumlah = $this->input->post('jumlah');

        // cek barang
        $this->db->where('id_brg', $brg);
        $barang = $this->db->get('barang')->row_array();


        $this->db->where('kode_brg', $brg);
        $this->db->order_by('kode_brg', 'desc');
        $stok = $this->db->get('stok', 1)->row_array();
        // if ($stok == null) {
        //     $jml_s = 0;
        // } else {
        // $jml_s = $stok['sisa'];
        // // }
        // echo $jml_stok = $jml_s - $jumlah;


        $data = [
            'tanggal' => $tgl_keluar,
            'id_brg' => $brg,
            'kode_brg' => $barang['kode_brg'],
            'jenis_tr' => 'OUT',
            'notr' => $notr,
            'nama_brg' => $barang['nama_brg'],
            'Keluar' => $jumlah,
        ];
        // var_dump($jml_stok);

        // die;
        return $this->db->insert('stok', $data);
    }
    public function deleteBk($id)
    {
        // Delete barang keluar based on its ID
        $this->db->where('ids', $id);
        return $this->db->delete('brg_keluar');
    }
    public function getBkId($id)
    {
        $this->db->where('ids', $id);
        return $this->db->get('brg_keluar')->row_array();
    }
    public function editBk()
    {
        $brg = $this->input->post('barang');
        $ids = $this->input->post('ids');
        $harga = $this->input->post('harga');
        $jumlah = $this->input->post('jumlah');
        $tgl_keluar = $this->input->post('tgl_keluar');

        $data = [
            'id_brg' => $brg,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'tgl_keluar' => $tgl_keluar,
        ];

        $this->db->where('ids', $ids);
        $this->db->update('brg_keluar', $data);
    }
    public function release($id)
    {

        $this->db->where('ids', $id);
        $this->db->update('brg_keluar', ['status_bk' => 'Closed']);
    }
}

/* End of file M_Barangkeluar.php */
