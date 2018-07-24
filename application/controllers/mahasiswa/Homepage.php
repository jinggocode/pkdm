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
		// MELIHAT DATA MAHASISWA
		$data['user'] = (object)$this->ion_auth->user()->row();
		$mahasiswa = $this->mahasiswa_model
			->where('id_user', $data['user']->id)
			->with_angkatan()
			->get();
		$data['id_mahasiswa'] = $mahasiswa->id;

		// MELIHAT PERIODE SEKARANG
		$periode = $this->periode_model->where('status', '1')->get();
		$data['id_periode'] = $periode->id;

		$cek_status_pengisian = $this->kuesioner_isi_model
			->where('id_periode', $periode->id)
			->where('id_mahasiswa', $mahasiswa->id)
			->where('status_selesai', '1')
			->count_rows(); 
		if ($cek_status_pengisian != 0) {
			$this->message('Kamu sudah melakukan pengisian kuesioner!','');
			$this->go('auth/logout');
		}

		$tahun_semester = $periode->tahun . $periode->semester;
		$semester = cek_semester($tahun_semester, $mahasiswa->angkatan->nama);

		// cek sudah di isi semua apa belum kuesionernya
		$data['cek_isi'] = $this->pengampu_model->cek_isi($mahasiswa->id, $semester, $mahasiswa->id_kelas, $periode->id);

		$data['makul'] = $this->pengampu_model->getData($mahasiswa->id_kelas, $semester, $mahasiswa->id_prodi);
		// dump(	$data['cek_isi']);

		$this->generateCsrf();
		$this->render('mahasiswa/home', $data);
	}

	public function submit_kuesioner()
	{
		$data['status_selesai'] = '1';
		$this->kuesioner_isi_model
			->where('id_periode', $this->input->post('id_periode'))
			->where('id_mahasiswa', $this->input->post('id_mahasiswa'))
			->update($data);

		$this->message('Terima Kasih telah melakukan pengisian kuesioner', 'success');
		$this->go('auth/logout');
	}

}
