<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model {
    
    public function all($limit = NULL, $offset = NULL)
    {
        $this->db->join('gaji', 'gaji.kode_gaji = pegawai.kode_gaji', 'left');
        $this->db->order_by('pegawai.nip', 'desc');
        $this->db->limit($limit, $offset);
    
        $query = $this->db->get('pegawai');
    
        return $query->result();
    }

    public function find($nip)
    {
        $this->db->join('gaji', 'gaji.kode_gaji = pegawai.kode_gaji', 'left');
        $this->db->where('pegawai.nip', $nip);
        $this->db->order_by('pegawai.nip', 'desc');
    
        $query = $this->db->get('pegawai');
    
        return $query->row();
    }

    public function where($where = array(), $limit = NULL, $offset = NULL)
    {
        $this->db->join('gaji', 'gaji.kode_gaji = pegawai.kode_gaji', 'left');
        $this->db->where($where);
        $this->db->order_by('pegawai.nip', 'desc');
        $this->db->limit($limit, $offset);
    
        $query = $this->db->get('pegawai');
    
        return $query->result();
    }

    public function insert($data)
    {
        $attributes = array(
            'nip' => empty_to_null($data['nip']),
            'kode_gaji' => empty_to_null($data['kode_gaji']),
            'nama_pegawai' => empty_to_null($data['nama_pegawai']),
            'posisi' => empty_to_null($data['posisi']),
            'alamat' => empty_to_null($data['alamat']),
        );
    
        $this->db->insert('pegawai', $attributes);
    
        return $this->db->affected_rows();
    }

    public function update($nip, $data)
    {
        $attributes = array(
            'nip' => empty_to_null($data['nip']),
            'kode_gaji' => empty_to_null($data['kode_gaji']),
            'nama_pegawai' => empty_to_null($data['nama_pegawai']),
            'posisi' => empty_to_null($data['posisi']),
            'alamat' => empty_to_null($data['alamat']),
        );
    
        $this->db->where('nip', $nip);
        $this->db->update('pegawai', $attributes);
    
        return $this->db->affected_rows();
    }

    public function delete($nip)
    {
        $this->db->where('nip', $nip);
        $this->db->delete('pegawai');
    
        return $this->db->affected_rows();
    }
}
