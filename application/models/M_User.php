<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{

    public function register()
    {
        $nama = $this->input->post('nama', true);
        // $no_hp = $this->input->post('no_hp', true);
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        $data = array(
            'nama' => ucwords($nama),
            'email' => $email,
            'password' => md5($password),
            'role_id' => '2',
            'tanggal_buat' => date('Y-m-d'),
            // 'gambar' => 'user.png'
        );
        $this->db->insert('users', $data);
    }
    public function cek_login()
    {
        $email = set_value('email');
        $password = set_value('password');
        $result = $this->db->where('email', $email)
            ->where('password', md5($password))
            ->limit(1)
            ->get('users');
        if ($result->num_rows() > 0) {
            return $result->row_array();
        } else {
            return array();
        }
    }
    public function get_user()
    {

        return $this->db->get('users')->result_array();
    }
    public function addUser()
    {
        $nama = $this->input->post('nama', true);
        // $no_hp = $this->input->post('no_hp', true);
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $role = $this->input->post('role', true);

        $data = array(
            'nama' => ucwords($nama),
            'email' => $email,
            'password' => md5($password),
            'role_id' => $role,
            'tanggal_buat' => date('Y-m-d'),
            'status' => 1
            // 'gambar' => 'user.png'
        );
        $this->db->insert('users', $data);
    }
    public function addUser_user()
    {
        $nama = $this->input->post('nama', true);
        // $no_hp = $this->input->post('no_hp', true);
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $role = $this->input->post('role', true);

        $data = array(
            'nama' => ucwords($nama),
            'email' => $email,
            'password' => md5($password),
            'role_id' => 2,
            'tanggal_buat' => date('Y-m-d'),
            'status' => 1

            // 'gambar' => 'user.png'
        );
        $this->db->insert('users', $data);
    }
    public function editUser()
    {
        $nama = $this->input->post('nama', true);
        $id_user = $this->input->post('id_user', true);
        // $no_hp = $this->input->post('no_hp', true);
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $role = $this->input->post('role', true);
        $status = $this->input->post('status', true);

        $data = array(
            'nama' => ucwords($nama),
            'email' => $email,
            'password' => md5($password),
            'role_id' => $role,
            'status' => $status,
            // 'gambar' => 'user.png'
        );
        $this->db->where('users.id_user', $id_user);
        $this->db->update('users', $data);
    }
    public function editUser_user()
    {
        $nama = $this->input->post('nama', true);
        $id_user = $this->input->post('id_user', true);
        // $no_hp = $this->input->post('no_hp', true);
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $role = $this->input->post('role', true);
        $status = $this->input->post('status', true);


        $data = array(
            'nama' => ucwords($nama),
            'email' => $email,
            'password' => md5($password),
            'status' => $status,
            // 'role_id' => $role,
            // 'gambar' => 'user.png'
        );
        $this->db->where('users.id_user', $id_user);
        $this->db->update('users', $data);
    }
    public function deleteUser($id)
    {
        $this->db->where('users.id_user', $id);
        $this->db->delete('users');
    }
    public function getUserId($id){
        
        $this->db->where('users.id_user', $id);
       return $this->db->get('users')->row_array();
        
        
    }
    public function gantiPass(){
        $password = $this->input->post('password', true);
        $id_user = $this->input->post('id_user', true);
        $data = [
            'password' => md5($password)
        ];
        $this->db->where('users.id_user', $id_user);
        $this->db->update('users', $data);


    }
}

/* End of file ModelName.php */
