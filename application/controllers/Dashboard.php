<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('penjualan_model');
		$this->load->model('pelanggan_model');
		$this->load->model('pengguna_model');
		$this->load->model('detail_model');
		$this->load->model('barang_model');
	}

	public function index()
	{	

		$data['laba_all'] = $this->detail_model->labaAll();
		$data['total_penjualan'] = $this->penjualan_model->count();
		$data['total_pelanggan'] = $this->pelanggan_model->count();
		$data['total_barang'] = $this->barang_model->count();
		$this->load->view('components/header');
		$this->load->view('pages/dashboard/index', $data);
		$this->load->view('components/footer');
	}
}
