<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_model extends CI_Model {
    
    public function all($limit = NULL, $offset = NULL)
    {
        $this->db->join('pegawai', 'pegawai.nip = pesanan.nip', 'left');
        $this->db->order_by('pesanan.id_pesanan', 'desc');
        $this->db->limit($limit, $offset);
    
        $query = $this->db->get('pesanan');
    
        return $query->result();
    }

    public function find($id)
    {
        $this->db->join('pegawai', 'pegawai.nip = pesanan.nip', 'left');
        $this->db->where('pesanan.id_pesanan', $id);
        $this->db->order_by('pesanan.id_pesanan', 'desc');
    
        $query = $this->db->get('pesanan');
    
        return $query->row();
    }

    public function where($where = array(), $limit = NULL, $offset = NULL)
    {
        $this->db->join('pegawai', 'pegawai.nip = pesanan.nip', 'left');
        $this->db->where($where);
        $this->db->order_by('pesanan.id_pesanan', 'desc');
        $this->db->limit($limit, $offset);
    
        $query = $this->db->get('pesanan');
    
        return $query->result();
    }

    public function insert($data)
    {
        $attributes = array(
            'nip' => empty_to_null($data['nip']),
            'banyak' => empty_to_null($data['banyak']),
            'tanggal_pesanan' => empty_to_null($data['tanggal_pesanan']),
        );
    
        $this->db->insert('pesanan', $attributes);
    
        return $this->db->affected_rows();
    }

    public function update($id, $data)
    {
        $attributes = array(
            'nip' => empty_to_null($data['nip']),
            'banyak' => empty_to_null($data['banyak']),
            'tanggal_pesanan' => empty_to_null($data['tanggal_pesanan']),
        );
    
        $this->db->where('id_pesanan', $id);
        $this->db->update('pesanan', $attributes);
    
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id_pesanan', $id);
        $this->db->delete('pesanan');
    
        return $this->db->affected_rows();
    }
}
