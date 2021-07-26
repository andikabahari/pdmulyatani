<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model {
    
    public function all($limit = NULL, $offset = NULL)
    {
        $this->db->order_by('id_pengguna', 'desc');
        $this->db->limit($limit, $offset);
    
        $query = $this->db->get('pengguna');
    
        return $query->result();
    }

    public function find($id)
    {
        $this->db->where('id_pengguna', $id);
        $this->db->order_by('id_pengguna', 'desc');
    
        $query = $this->db->get('pengguna');
    
        return $query->row();
    }

    public function where($where = array(), $limit = NULL, $offset = NULL)
    {
        $this->db->where($where);
        $this->db->order_by('id_pengguna', 'desc');
        $this->db->limit($limit, $offset);
    
        $query = $this->db->get('pengguna');
    
        return $query->result();
    }

    public function insert($data)
    {
        $attributes = array(
            'nama_pengguna' => empty_to_null($data['nama_pengguna']),
            'username' => empty_to_null($data['username']),
            'password' => empty_to_null($data['password']),
        );
    
        $this->db->insert('pengguna', $attributes);
    
        return $this->db->affected_rows();
    }

    public function update($id, $data)
    {
        $attributes = array(
            'nama_pengguna' => empty_to_null($data['nama_pengguna']),
            'username' => empty_to_null($data['username']),
            'password' => empty_to_null($data['password']),
        );
    
        $this->db->where('id_pengguna', $id);
        $this->db->update('pengguna', $attributes);
    
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id_pengguna', $id);
        $this->db->delete('pengguna');
    
        return $this->db->affected_rows();
    }
}
