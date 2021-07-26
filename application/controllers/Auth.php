<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
	public function index()
	{
        $this->auth_lib->redirect_if_authenticated('laporan');

        $this->load->view('pages/auth/index');
	}

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ( ! $this->auth_lib->login($username, $password))
        {
            $this->session->set_flashdata('error_message', 'Username atau password yang anda masukkan salah.');

            redirect('auth');
        }

        $this->session->set_flashdata('success_message', 'Login telah berhasil.');

        redirect('laporan');
    }

    public function logout()
    {
        $this->auth_lib->logout();

        redirect('auth');
    }
}
