<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends CI_Controller {
    
	public function index()
	{
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $gaji = $this->gaji_model->all();

        $view_data = compact('gaji');

        $this->load->view('pages/gaji/index', $view_data);
	}

    public function create()
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $this->load->view('pages/gaji/create');
    }

    public function edit($kode_gaji = NULL)
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $gaji = $this->gaji_model->find($kode_gaji);

        if (empty($gaji))
        {
            redirect('gaji');
        }

        $view_data = compact('gaji');

        $this->load->view('pages/gaji/edit', $view_data);
    }

    public function store()
    {
        $this->form_validation->set_rules('kode_gaji', 'Kode Gaji', 'required|exact_length[3]|alpha_numeric|is_unique[gaji.kode_gaji]');
        $this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required|numeric|greater_than_equal_to[-2147483648]|less_than_equal_to[2147483647]');

        if ( ! $this->form_validation->run())
        {
            $this->session->set_flashdata('error_message', validation_errors());

            redirect('gaji/create');
        }

        $data = array(
            'kode_gaji' => $this->input->post('kode_gaji'),
            'gaji_pokok' => $this->input->post('gaji_pokok'),
        );

        $this->gaji_model->insert($data);

        $this->session->set_flashdata('success_message', 'Gaji berhasil disimpan.');

        redirect('gaji');
    }

    public function update()
    {
        $old_kode_gaji = $this->input->post('old_kode_gaji');
        $kode_gaji = $this->input->post('kode_gaji');
        
        $this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required|numeric|greater_than_equal_to[-2147483648]|less_than_equal_to[2147483647]');

        if ($old_kode_gaji != $kode_gaji)
        {
            $this->form_validation->set_rules('kode_gaji', 'Kode Gaji', 'required|exact_length[3]|alpha_numeric|is_unique[gaji.kode_gaji]');
        }

        if ( ! $this->form_validation->run())
        {
            $this->session->set_flashdata('error_message', validation_errors());

            redirect('gaji/edit/' . $old_kode_gaji);
        }

        $data = array(
            'kode_gaji' => $this->input->post('kode_gaji'),
            'gaji_pokok' => $this->input->post('gaji_pokok'),
        );

        $this->gaji_model->update($old_kode_gaji, $data);

        $this->session->set_flashdata('success_message', 'Gaji berhasil disimpan.');

        redirect('gaji');
    }

    public function delete($kode_gaji = NULL)
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $this->gaji_model->delete($kode_gaji);

        $this->session->set_flashdata('success_message', 'Gaji berhasil dihapus.');

        redirect('gaji');
    }
}
