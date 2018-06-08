<?php

/**
 *
 */
class Homepage extends MY_Controller
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
 
	public function index()
	{
		$data['user'] = $this->ion_auth->user()->row();
		$dosen = $this->dosen_model->where('id_user', $data['user']->id)->get();
		$data['tahun_ajaran'] = $this->kuesioner_isi_model
			->fields('id')
			->with_periode() 
			->group_by('id_periode')
			->get_all(); 
		$data['prodi'] = $this->prodi_model->get_all();

		$this->render('pimpinan/home', $data);
	}
 
	public function ajaran($id_prodi)
	{
		$data['user'] = $this->ion_auth->user()->row();
		$dosen = $this->dosen_model->where('id_user', $data['user']->id)->get();
		$data['tahun_ajaran'] = $this->kuesioner_isi_model
			->where('id')
			->fields('id')
			->with_periode() 
			->group_by('id_periode')
			->get_all(); 
		$data['id_prodi'] = $id_prodi;

		$this->render('pimpinan/ajaran', $data);
	} 

}
