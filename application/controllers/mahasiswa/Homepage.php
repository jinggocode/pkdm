<?php

/**
*
*/
class Homepage extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','cek_semester'));
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
		$data['user'] = (object)$this->ion_auth->user()->row();
		$mahasiswa = $this->mahasiswa_model
				->where('id_user', $data['user']->id)
				->with_angkatan()
				->get();
		$data['id_mahasiswa'] = $mahasiswa->id;
		$periode = $this->periode_model->where('status','1')->get();

		$tahun_semester = $periode->tahun.$periode->semester;
		$semester = cek_semester($tahun_semester, $mahasiswa->angkatan->nama);

		// cek sudah di isi semua apa belum kuesionernya
		$data['cek_isi'] = $this->pengampu_model->cek_isi($mahasiswa->id, $semester, $mahasiswa->id_kelas, $periode->id);

		$data['makul'] = $this->pengampu_model->getData($mahasiswa->id_kelas, $semester);
		// dump(	$data['cek_isi']);

		$this->render('mahasiswa/home', $data);
	}

	public function tambah()
	{
		dump('ini tambah');
	}

}
