<?php

/**
 *
 */
class Statistik extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump', 'cek_semester'));
		$this->load->model('admin/prodi_model');
		$this->load->model('admin/user_model');
		$this->load->model('admin/pengampu_model');
		$this->load->model('admin/makul_model');
		$this->load->model('admin/dosen_model');
		$this->load->model('admin/kelas_model');
		$this->load->model('admin/mahasiswa_model');
		$this->load->model('admin/periode_model');
		$this->load->model('admin/angkatan_model'); 
		$this->load->model('admin/kuesioner_isi_model');
	} 

	public function makul($id_periode)
	{
		$data['user'] = $this->ion_auth->user()->row();
		$dosen = $this->dosen_model->where('id_user', $data['user']->id)->get();
		$data['makul'] = $this->kuesioner_isi_model
			->fields('id')
			->with_periode()
			->with_pengampu(array('with'=>array('relation'=>'makul')))
			->where('id_periode', $id_periode) 
			->get_all(); 

		$data['periode'] = $this->kuesioner_isi_model
			->fields('id')
			->with_periode()
			->where('id_periode', $id_periode)  
			->get(); 
			
		$this->render('dosen/statistik/makul', $data);
	}

	public function grafik()
	{
		$data['user'] = $this->ion_auth->user()->row();

		$this->render('dosen/statistik/grafik', $data);
	}

}
