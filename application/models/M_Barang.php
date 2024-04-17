<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_Barang extends CI_Model
{
	public function getBarang()
	{
		return $this->db->get('barang')->result_array();
	}
	public function addBrg()
	{
		 $barang = $this->input->post('barang', true);
		 $kode_brg = $this->input->post('kode_brg', true);
        // $no_hp = $this->input->post('no_hp', true);	
        $harga_beli = $this->input->post('harga_beli', true);
        $harga_jual = $harga_beli + ($harga_beli * 25/100);
        $data = array(
            'kode_brg' => $kode_brg,
            'nama_brg' => strtoupper($barang),
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'tgl_input' => date('Y-m-d'),
            'status' => 'Aktif',
            // 'gambar' => 'user.png'
        );

        $this->db->insert('barang', $data);
	}
	public function getWhere($id_brg)
	{
		$this->db->where('id_brg', $id_brg);
        return $barang = $this->get('barang')->row_array();
	}
	public function deleteBrg($id){
		$this->db->where('id_brg',$id);
		$this->db->delete('barang');
	}
	public function editBrg()
	{
		 $barang = $this->input->post('barang', true);
		 $kode_brg = $this->input->post('kode_brg', true);
		 $id_brg = $this->input->post('id_brg', true);
        // $no_hp = $this->input->post('no_hp', true);
        $harga_beli = $this->input->post('harga_beli', true);
        $harga_jual = $harga_beli + ($harga_beli * 25/100);
        $status = $this->input->post('status', true);
        $data = array(
            'kode_brg' => $kode_brg,
            'nama_brg' => strtoupper($barang),
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'tgl_input' => date('Y-m-d'),
            'status' => $status,
            // 'gambar' => 'user.png'
        );
        $this->db->where('id_brg',$id_brg);
        $this->db->update('barang', $data);
	}
	public function CreateCode(){
	    $this->db->select('RIGHT(barang.kode_brg,4) as kode_brg', FALSE);
	    $this->db->order_by('kode_brg','DESC');    
	    $this->db->limit(1);    
	    $query = $this->db->get('barang');
	        if($query->num_rows() <> 0){      
	             $data = $query->row();
	             $kode = intval($data->kode_brg) + 1; 
	        }
	        else{      
	             $kode = 1;  
	        }
	    $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);    
	    $kodetampil = "BR2024".$batas;
	    echo $kodetampil;
	    return $kodetampil;  		
	}
	public function stokId($id)
	{
		$this->db->select('stok');
		$this->db->where('kode_brg', $id);	
		$this->db->order_by('id_stok', 'desc');
		
		return  $this->db->get('stok')->row_array();
	}
}