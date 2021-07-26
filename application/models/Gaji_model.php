<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji_model extends CI_Model {
    
    public function all($limit = NULL, $offset = NULL)
    {
        $this->db->order_by('kode_gaji', 'desc');
        $this->db->limit($limit, $offset);
    
        $query = $this->db->get('gaji');
    
        return $query->result();
    }

    public function find($kode_gaji)
    {
        $this->db->where('kode_gaji', $kode_gaji);
        $this->db->order_by('kode_gaji', 'desc');
    
        $query = $this->db->get('gaji');
    
        return $query->row();
    }

    public function where($where = array(), $limit = NULL, $offset = NULL)
    {
        $this->db->where($where);
        $this->db->order_by('kode_gaji', 'desc');
        $this->db->limit($limit, $offset);
    
        $query = $this->db->get('gaji');
    
        return $query->result();
    }

    public function insert($data)
    {
        $attributes = array(
            'kode_gaji' => empty_to_null($data['kode_gaji']),
            'gaji_pokok' => empty_to_null($data['gaji_pokok']),
        );
    
        $this->db->insert('gaji', $attributes);
    
        return $this->db->affected_rows();
    }

    public function update($kode_gaji, $data)
    {
        $attributes = array(
            'kode_gaji' => empty_to_null($data['kode_gaji']),
            'gaji_pokok' => empty_to_null($data['gaji_pokok']),
        );
    
        $this->db->where('kode_gaji', $kode_gaji);
        $this->db->update('gaji', $attributes);
    
        return $this->db->affected_rows();
    }

    public function delete($kode_gaji)
    {
        $this->db->where('kode_gaji', $kode_gaji);
        $this->db->delete('gaji');
    
        return $this->db->affected_rows();
    }
}
