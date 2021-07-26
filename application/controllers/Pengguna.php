<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {
    
	public function index()
	{
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $pengguna = $this->pengguna_model->all();

        $view_data = compact('pengguna');

        $this->load->view('pages/pengguna/index', $view_data);
	}

    public function edit($id = NULL)
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $pengguna = $this->pengguna_model->find($id);

        if (empty($pengguna))
        {
            redirect('pengguna');
        }

        $view_data = compact('pengguna');

        $this->load->view('pages/pengguna/edit', $view_data);
    }

    public function update()
    {
        $id_pengguna = $this->input->post('id_pengguna');
        $old_username = $this->input->post('old_username');
        $username = $this->input->post('username');
        
        $this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'required|max_length[50]|regex_match[/^[a-zA-Z ]+$/]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[128]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'matches[password]');

        if ($old_username != $username)
        {
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[15]|alpha_numeric|is_unique[pengguna.username]');
        }

        if ( ! $this->form_validation->run())
        {
            $this->session->set_flashdata('error_message', validation_errors());

            redirect('pengguna/edit/' . $id_pengguna);
        }

        $data = array(
            'nama_pengguna' => $this->input->post('nama_pengguna'),
            'username' => $this->input->post('username'),
            'password' => $this->auth_lib->hash($this->input->post('password')),
        );

        $this->pengguna_model->update($id_pengguna, $data);

        $this->session->set_flashdata('success_message', 'Pengguna berhasil disimpan.');

        redirect('pengguna');
    }
}
