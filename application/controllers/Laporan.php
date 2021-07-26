<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function index()
	{
        $this->auth_lib->redirect_if_not_authenticated('auth');

        $year_month = explode('-', $this->input->get('year_month'));
        $year = $year_month[0] ?? NULL;
        $month = $year_month[1] ?? NULL;

        $jumlah_absen = $this->laporan_model->jumlah_absen($year, $month);
        $jumlah_pesanan = $this->laporan_model->jumlah_pesanan($year, $month);
        $jumlah_pegawai = $this->laporan_model->jumlah_pegawai();
        $gaji_pegawai_tetap = $this->laporan_model->gaji_pegawai_tetap($year, $month);
        $gaji_pegawai_borongan = $this->laporan_model->gaji_pegawai_borongan($year, $month);

        $view_data = compact(
            'jumlah_absen',
            'jumlah_pesanan',
            'jumlah_pegawai',
            'gaji_pegawai_tetap',
            'gaji_pegawai_borongan',
            'year',
            'month'
        );

        $this->load->view('pages/laporan/index', $view_data);
	}
}
