<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller {

    public function index()
	{
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $limit = 1000;
        $absen = $this->absen_model->all($limit);

        $view_data = compact('absen');

        $this->load->view('pages/absen/index', $view_data);
	}

    public function masuk()
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $where = array('posisi' => 'Tetap');
        $pegawai = $this->pegawai_model->where($where);

        $view_data = compact('pegawai');

        $this->load->view('pages/absen/masuk', $view_data);
    }

    public function keluar()
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        // $today = date('Y-m-d');
        // $where = array(
        //     'date(absen.waktu_masuk)' => $today,
        //     'absen.waktu_keluar' => NULL
        // );
        // $absen = $this->absen_model->where($where);
        $where = array('posisi' => 'Tetap');
        $pegawai = $this->pegawai_model->where($where);

        $view_data = compact('pegawai');

        $this->load->view('pages/absen/keluar', $view_data);
    }

    public function absen_masuk()
    {
        $nip = $_POST['nip'] ?? array();

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|regex_match[/^\d{1,4}-\d{1,2}-\d{1,2}$/]');
        $this->form_validation->set_rules('waktu', 'Waktu', 'required|regex_match[/^\d{1,2}:\d{1,2}:\d{1,2}$/]');
        $this->form_validation->set_rules('nip[]', 'NIP', 'required|numeric|exact_length[5]');

        if ( ! $this->form_validation->run())
        {
            $this->session->set_flashdata('error_message', validation_errors());

            redirect('absen/masuk');
        }

        if (count($nip) < 1)
        {
            $this->session->set_flashdata('error_message', 'Absen gagal disimpan.');

            redirect('absen/masuk');
        }

        $message = null;

        $tanggal = $this->input->post('tanggal');
        $waktu = $this->input->post('waktu');
        $waktu_masuk = $tanggal . ' ' . $waktu;

        foreach ($nip as $row)
        {
            $where = array(
                'pegawai.nip' => $row,
                'date(waktu_masuk)' => $tanggal
            );
            $absen = $this->absen_model->where($where);

            if ( ! empty($absen))
            {
                $message = '<p>NIP yang sudah terdaftar absen tidak akan disimpan.</p>';

                continue;
            }

            $data = array(
                'nip' => $row,
                'waktu_masuk' => $waktu_masuk,
                'waktu_keluar' => NULL,
                'status' => NULL
            );

            $this->absen_model->insert($data);
        }

        if ( ! is_null($message))
        {
            $this->session->set_flashdata('warning_message', $message);
        }

        redirect('absen');
    }

    public function absen_keluar()
    {
        $nip = $_POST['nip'] ?? array();

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|regex_match[/^\d{1,4}-\d{1,2}-\d{1,2}$/]');
        $this->form_validation->set_rules('waktu', 'Waktu Keluar', 'required|regex_match[/^\d{1,2}:\d{1,2}:\d{1,2}$/]');
        $this->form_validation->set_rules('jadwal', 'Jadwal Keluar', 'required|regex_match[/^\d{1,2}:\d{1,2}:\d{1,2}$/]');

        if ( ! $this->form_validation->run())
        {
            $this->session->set_flashdata('error_message', validation_errors());

            redirect('absen/keluar');
        }

        if (count($nip) < 1)
        {
            $this->session->set_flashdata('error_message', 'Absen gagal disimpan.');

            redirect('absen/keluar');
        }

        $warning_absen = null;
        $warning_keluar = null;
        $warning_jadwal = null;

        $tanggal = $this->input->post('tanggal');
        $jadwal = $this->input->post('jadwal');
        $waktu = $this->input->post('waktu');
        $waktu_keluar = $tanggal . ' ' . $waktu;
        $waktu_jadwal = $tanggal . ' ' . $jadwal;
        $status = strtotime($waktu) >= strtotime($jadwal) ? 'Sehari' : 'Setengah';

        foreach ($nip as $row)
        {
            $where = array(
                'pegawai.nip' => $row,
                'date(absen.waktu_masuk)' => $tanggal
            );
            $absen = $this->absen_model->where($where);

            
            if (empty($absen))
            {
                $warning_absen = '<p>Absen dengan NIP yang belum terdaftar tidak akan disimpan.</p>';

                continue;
            }
            
            $absen = $absen[0];
            
            if (strtotime($waktu_keluar) < strtotime($absen->waktu_masuk))
            {
                $warning_keluar = '<p>Absen dengan waktu masuk yang melebihi waktu keluar tidak akan disimpan.</p>';

                continue;
            }

            if (strtotime($waktu_jadwal) < strtotime($absen->waktu_masuk))
            {
                $warning_jadwal = '<p>Absen dengan waktu masuk yang melebihi jadwal keluar tidak akan disimpan.</p>';

                continue;
            }

            $data = array(
                'nip' => $absen->nip,
                'waktu_masuk' => $absen->waktu_masuk,
                'waktu_keluar' => $waktu_keluar,
                'status' => $status
            );

            $this->absen_model->update($absen->id_absen, $data);
        }

        $message = null;

        if ( ! is_null($warning_absen))
        {
            $message .= $warning_absen;
        }

        if ( ! is_null($warning_keluar))
        {
            $message .= $warning_keluar;
        }

        if ( ! is_null($warning_jadwal))
        {
            $message .= $warning_jadwal;
        }

        if ( ! is_null($message))
        {
            $this->session->set_flashdata('warning_message', $message);
        }

        redirect('absen');
    }

    public function delete($id = NULL)
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $this->absen_model->delete($id);

        $this->session->set_flashdata('success_message', 'Absen berhasil dihapus.');

        redirect('absen');
    }
}
