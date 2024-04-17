<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function index()
    {
    	 $data = [
            'judul' => 'Barang',
            'isi' => 'user/barang',
            'barang' => $this->M_Barang->getBarang(),
            'kode_brg' =>  $this->M_Barang->CreateCode()

        ];

        $this->load->view('layout/v_isi', $data);
    }
    
	public function add()
	{
		$this->M_Barang->addBrg();
		redirect('user/barang');

	}
	public function edit()
	{
		$this->M_Barang->editBrg();
		redirect('user/barang');
	}
	public function delete($id)
	{
		$this->M_Barang->deleteBrg($id);
		redirect('user/barang');
	}
}
