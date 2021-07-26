<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    public function jumlah_absen($year = NULL, $month = NULL)
    {
        $year = ! empty($year) ? $year : date('Y');
        $month = ! empty($month) ? $month : date('m');
        $where = array(
            'year(waktu_masuk)' => $year,
            'month(waktu_masuk)' => $month
        );
        
        $this->db->select('count(id_absen) as jumlah_absen');
        $this->db->where($where);

        $query = $this->db->get('absen');

        if ($query->num_rows() > 0)
        {
            return $query->row()->jumlah_absen;
        }
        
        return 0;
    }

    public function jumlah_pesanan($year = NULL, $month = NULL)
    {
        $year = ! empty($year) ? $year : date('Y');
        $month = ! empty($month) ? $month : date('m');
        $where = array(
            'year(tanggal_pesanan)' => $year,
            'month(tanggal_pesanan)' => $month
        );
        
        $this->db->select('count(id_pesanan) as jumlah_pesanan');
        $this->db->where($where);

        $query = $this->db->get('pesanan');

        if ($query->num_rows() > 0)
        {
            return $query->row()->jumlah_pesanan;
        }
        
        return 0;
    }

    public function jumlah_pegawai()
    {
        $query = $this->db->get('pegawai');

        return $query->num_rows();
    }

    public function gaji_pegawai_tetap($year = NULL, $month = NULL)
    {
        $year = ! empty($year) ? $year : date('Y');
        $month = ! empty($month) ? $month : date('m');
        $sql = "
            select *,
                banyak_absen * gaji_pokok as jumlah_gaji,
                banyak_absen * gaji_pokok - jumlah_potongan as total
            from (
                select pegawai.nip,
                    pegawai.nama_pegawai,
                    count(absen.id_absen) as banyak_absen,
                    gaji.gaji_pokok,
                    gaji.gaji_pokok / 2 as gaji_setengah
                from pegawai
                left join gaji on gaji.kode_gaji = pegawai.kode_gaji
                left join absen on absen.nip = pegawai.nip
                    and year(absen.waktu_masuk) = '" . $year . "'
                    and month(absen.waktu_masuk) = '" . $month . "'
                    and year(absen.waktu_keluar) = '" . $year . "'
                    and month(absen.waktu_keluar) = '" . $month . "'
                where pegawai.posisi = 'Tetap'
                group by pegawai.nip
            ) as t1
            join (
                select pegawai.nip,
                    count(absen.id_absen) as banyak_absen_setengah,
                    count(absen.id_absen) * gaji.gaji_pokok / 2 as jumlah_potongan
                from pegawai
                left join gaji on gaji.kode_gaji = pegawai.kode_gaji
                left join absen on absen.nip = pegawai.nip
                    and absen.status = 'Setengah'
                    and year(absen.waktu_masuk) = '" . $year . "'
                    and month(absen.waktu_masuk) = '" . $month . "'
                    and year(absen.waktu_keluar) = '" . $year . "'
                    and month(absen.waktu_keluar) = '" . $month . "'
                where pegawai.posisi = 'Tetap'
                group by pegawai.nip
            ) as t2
            using(nip)
        ";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function gaji_pegawai_borongan($year = NULL, $month = NULL)
    {
        $year = ! empty($year) ? $year : date('Y');
        $month = ! empty($month) ? $month : date('m');
        $sql = "
            select pegawai.nip,
                pegawai.nama_pegawai,
                ifnull(sum(pesanan.banyak), 0) as banyak_pesanan,
                gaji.gaji_pokok,
                sum(pesanan.banyak) * gaji_pokok as jumlah
            from pegawai
            left join gaji on gaji.kode_gaji = pegawai.kode_gaji
            left join pesanan on pesanan.nip = pegawai.nip
                and year(pesanan.tanggal_pesanan) = '" . $year . "'
                and month(pesanan.tanggal_pesanan) = '" . $month . "'
            where pegawai.nip is not null
                and pegawai.posisi = 'Borongan'
            group by pegawai.nip
        ";

        $query = $this->db->query($sql);

        return $query->result();
    }
}
