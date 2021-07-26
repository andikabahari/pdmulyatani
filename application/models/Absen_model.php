<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Absen_model extends CI_Model {
    
    public function all($limit = NULL, $offset = NULL)
    {
        $this->db->join('pegawai', 'pegawai.nip = absen.nip', 'left');
        $this->db->order_by('absen.id_absen', 'desc');
        $this->db->limit($limit, $offset);
    
        $query = $this->db->get('absen');
    
        return $query->result();
    }

    public function find($id)
    {
        $this->db->where('id_absen', $id);
        $this->db->order_by('id_absen', 'desc');
    
        $query = $this->db->get('absen');
    
        return $query->row();
    }

    public function where($where = array(), $limit = NULL, $offset = NULL)
    {
        $this->db->join('pegawai', 'pegawai.nip = absen.nip', 'left');
        $this->db->where($where);
        $this->db->order_by('absen.id_absen', 'desc');
        $this->db->limit($limit, $offset);
    
        $query = $this->db->get('absen');
    
        return $query->result();
    }

    public function insert($data)
    {
        $attributes = array(
            'nip' => empty_to_null($data['nip']),
            'waktu_masuk' => empty_to_null($data['waktu_masuk']),
            'waktu_keluar' => empty_to_null($data['waktu_keluar']),
            'status' => empty_to_null($data['status']),
        );
    
        $this->db->insert('absen', $attributes);
    
        return $this->db->affected_rows();
    }

    public function update($id, $data)
    {
        $attributes = array(
            'nip' => empty_to_null($data['nip']),
            'waktu_masuk' => empty_to_null($data['waktu_masuk']),
            'waktu_keluar' => empty_to_null($data['waktu_keluar']),
            'status' => empty_to_null($data['status']),
        );
    
        $this->db->where('id_absen', $id);
        $this->db->update('absen', $attributes);
    
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id_absen', $id);
        $this->db->delete('absen');
    
        return $this->db->affected_rows();
    }
}
