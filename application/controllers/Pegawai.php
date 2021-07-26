<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
    
	public function index()
	{
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $pegawai = $this->pegawai_model->all();

        $view_data = compact('pegawai');

        $this->load->view('pages/pegawai/index', $view_data);
	}

    public function create()
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $gaji = $this->gaji_model->all();

        $view_data = compact('gaji');

        $this->load->view('pages/pegawai/create', $view_data);
    }

    public function edit($nip = NULL)
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $pegawai = $this->pegawai_model->find($nip);
        $gaji = $this->gaji_model->all();

        if (empty($pegawai))
        {
            redirect('pegawai');
        }

        $view_data = compact('pegawai', 'gaji');

        $this->load->view('pages/pegawai/edit', $view_data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nip', 'NIP', 'required|exact_length[5]|numeric|is_unique[pegawai.nip]');
        $this->form_validation->set_rules('kode_gaji', 'Kode Gaji', 'required|exact_length[3]|alpha_numeric');
        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required|max_length[50]|regex_match[/^[a-zA-Z ]+$/]');
        $this->form_validation->set_rules('posisi', 'Posisi', 'required|in_list[Tetap,Borongan]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'max_length[100]');

        if ( ! $this->form_validation->run())
        {
            $this->session->set_flashdata('error_message', validation_errors());

            redirect('pegawai/create');
        }

        $data = array(
            'nip' => $this->input->post('nip'),
            'kode_gaji' => $this->input->post('kode_gaji'),
            'nama_pegawai' => $this->input->post('nama_pegawai'),
            'posisi' => $this->input->post('posisi'),
            'alamat' => $this->input->post('alamat'),
        );

        $this->pegawai_model->insert($data);

        $this->session->set_flashdata('success_message', 'Pegawai berhasil disimpan.');

        redirect('pegawai');
    }

    public function update()
    {
        $old_nip = $this->input->post('old_nip');
        $nip = $this->input->post('nip');
        
        $this->form_validation->set_rules('kode_gaji', 'Kode Gaji', 'required|exact_length[3]|alpha_numeric');
        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required|max_length[50]|regex_match[/^[a-zA-Z ]+$/]');
        $this->form_validation->set_rules('posisi', 'Posisi', 'required|in_list[Tetap,Borongan]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'max_length[100]');

        if ($old_nip != $nip)
        {
            $this->form_validation->set_rules('nip', 'NIP', 'required|exact_length[5]|numeric|is_unique[pegawai.nip]');
        }

        if ( ! $this->form_validation->run())
        {
            $this->session->set_flashdata('error_message', validation_errors());

            redirect('pegawai/edit/' . $old_nip);
        }

        $data = array(
            'nip' => $this->input->post('nip'),
            'kode_gaji' => $this->input->post('kode_gaji'),
            'nama_pegawai' => $this->input->post('nama_pegawai'),
            'posisi' => $this->input->post('posisi'),
            'alamat' => $this->input->post('alamat'),
        );

        $this->pegawai_model->update($old_nip, $data);

        $this->session->set_flashdata('success_message', 'Pegawai berhasil disimpan.');

        redirect('pegawai');
    }

    public function delete($nip = NULL)
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $this->pegawai_model->delete($nip);

        $this->session->set_flashdata('success_message', 'Pegawai berhasil dihapus.');

        redirect('pegawai');
    }
}
