<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {
    
	public function index()
	{
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $limit = 1000;
        $pesanan = $this->pesanan_model->all($limit);

        $view_data = compact('pesanan');

        $this->load->view('pages/pesanan/index', $view_data);
	}

    public function create()
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $where = array('posisi' => 'Borongan');
        $pegawai = $this->pegawai_model->where($where);

        $view_data = compact('pegawai');

        $this->load->view('pages/pesanan/create', $view_data);
    }

    public function edit($id = NULL)
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $pesanan = $this->pesanan_model->find($id);
        $pegawai = $this->pegawai_model->all();

        if (empty($pesanan))
        {
            redirect('pesanan');
        }

        $view_data = compact('pesanan', 'pegawai');

        $this->load->view('pages/pesanan/edit', $view_data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nip', 'NIP', 'required|exact_length[5]|numeric');
        $this->form_validation->set_rules('banyak', 'Banyak', 'required|integer|greater_than_equal_to[-2147483648]|less_than_equal_to[2147483647]');
        $this->form_validation->set_rules('tanggal_pesanan', 'Tanggal Pesanan', 'required|regex_match[/^\d{1,4}-\d{1,2}-\d{1,2}$/]');

        if ( ! $this->form_validation->run())
        {
            $this->session->set_flashdata('error_message', validation_errors());

            redirect('pesanan/create');
        }

        $data = array(
            'nip' => $this->input->post('nip'),
            'banyak' => $this->input->post('banyak'),
            'tanggal_pesanan' => $this->input->post('tanggal_pesanan'),
        );

        $this->pesanan_model->insert($data);

        $this->session->set_flashdata('success_message', 'Pesanan berhasil disimpan.');

        redirect('pesanan');
    }

    public function update()
    {
        $id_pesanan = $this->input->post('id_pesanan');
        
        $this->form_validation->set_rules('nip', 'NIP', 'required|exact_length[5]|numeric');
        $this->form_validation->set_rules('banyak', 'Banyak', 'required|integer|greater_than_equal_to[-2147483648]|less_than_equal_to[2147483647]');
        $this->form_validation->set_rules('tanggal_pesanan', 'Tanggal Pesanan', 'required|regex_match[/^\d{1,4}-\d{1,2}-\d{1,2}$/]');

        if ( ! $this->form_validation->run())
        {
            $this->session->set_flashdata('error_message', validation_errors());

            redirect('pesanan/edit/' . $id_pesanan);
        }

        $data = array(
            'nip' => $this->input->post('nip'),
            'banyak' => $this->input->post('banyak'),
            'tanggal_pesanan' => $this->input->post('tanggal_pesanan'),
        );

        $this->pesanan_model->update($id_pesanan, $data);

        $this->session->set_flashdata('success_message', 'Pesanan berhasil disimpan.');

        redirect('pesanan');
    }

    public function delete($id_pesanan = NULL)
    {
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $this->pesanan_model->delete($id_pesanan);

        $this->session->set_flashdata('success_message', 'Pesanan berhasil dihapus.');

        redirect('pesanan');
    }
}
