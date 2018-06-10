<?php

/**
 * 
 */
class Penilaian extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump', 'utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/dosen_model');
		$this->load->model('admin/prodi_model');
		$this->load->model('admin/kuesioner_isi_model');
		$this->load->model('admin/mahasiswa_model');
		$this->load->model('admin/periode_model');
		$this->load->model('admin/pengampu_model');
		$this->load->model('admin/kelas_model');
		$this->load->model('admin/angkatan_model');
		$this->load->model('admin/makul_model');
	}

	public function ajaran()
	{
		$data['tahun_ajaran'] = $this->kuesioner_isi_model
			->where('id')
			->fields('id')
			->with_periode() 
			->group_by('id_periode')
			->get_all();  

		$this->render('admin/laporan/penilaian/ajaran', $data);
	}

	public function prodi($id_periode)
	{ 
		$data['periode'] = $this->periode_model->get($id_periode);
		
		$data['prodi'] = $this->prodi_model->get_all();
 
		$this->render('admin/laporan/penilaian/prodi', $data);
	}

	public function statistik($id_periode)
	{ 
		$id_prodi = $this->uri->segment(6); 
		$data['prodi'] = $this->prodi_model->get($id_prodi);
		$data['periode'] = $this->periode_model->get($id_periode);
		
		$data['data'] = $this->kuesioner_isi_model->getListNilaiTotalDosen($id_prodi, $id_periode);
 
		$this->render('admin/laporan/penilaian/statistik', $data);
	}

	public function detail($id_periode)
	{
		$id_dosen = $this->uri->segment(6);  
		$data['dosen'] = $this->dosen_model->get($id_dosen);

		$data['makul'] = $this->kuesioner_isi_model
			->with_periode()
			->with_mahasiswa(array('with' => array(
				array('relation'=>'kelas'), 
				array('relation'=>'angkatan')
				))) 
			->with_pengampu(array('with' => array('relation' => 'makul')))
			->where('id_periode', $id_periode)
			->where('id_dosen', $id_dosen)
			->group_by('id_pengampu')
			->get_all(); 
			
		$data['periode'] = $this->kuesioner_isi_model
			->fields('id')
			->with_periode()
			->where('id_periode', $id_periode)
			->get(); 
  
		if ($this->uri->segment(7) == 'get_list') {
			foreach ($data['makul'] as $value) {
				$list = $this->kuesioner_isi_model->getListPenilaian($value->id_pengampu, $value->id_periode);
				$dt[] = array(
					'judul' => 'ANGKATAN '.$value->mahasiswa->angkatan->nama.' - KELAS '.$value->mahasiswa->kelas->nama.' || '.($value->pengampu->makul->jenis == '0'?'TEORI ':'PRAKIKUM ').$value->pengampu->makul->nama, 
					'kurang' => $list->kurang, 
					'cukup' => $list->cukup, 
					'baik' => $list->baik, 
					'sangat_baik' => $list->sangat_baik, 
				); 
			} 
			print_r(json_encode($dt, true));
		} else { 
			$this->render('admin/laporan/penilaian/detail', $data);
		}
 
	}
	public function search()
	{
		$search_data = $this->input->get();

		$data = $this->dosen_model->search($search_data);

		$this->generateCsrf();
		$this->render('admin/dosen/index', $data);
	}

	public function add()
	{
		$data['prodi'] = $this->prodi_model->get_all();

		$this->generateCsrf();
		$this->render('admin/dosen/add', $data);
	}
	public function save()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[70]');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|min_length[3]|max_length[50]');

		if ($this->form_validation->run() == false) {
			$data['prodi'] = $this->prodi_model->get_all();

			$this->generateCsrf();
			$data['page'] = $this->uri->segment(2);
			$this->render('admin/dosen/add', $data);
		} else {
			$user_data['first_name'] = $this->input->post('nama');
			$user_data['username'] = $this->input->post('nik');
			$user_data['password'] = password_hash('default', PASSWORD_BCRYPT);
			$user_data['group_id'] = '2';
			$insert_user = $this->user_model->insert($user_data);

			$data = $this->input->post();
			$data['id_user'] = $insert_user;

			$insert = $this->dosen_model->insert($data);
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->message('Data berhasi di Simpan!', 'success');
				$this->go('admin/dosen'); //redirect ke dosen
			}
		}
	}

	public function edit($id)
	{
		$data['data'] = $this->dosen_model->get($id);
		$data['prodi'] = $this->prodi_model->get_all();

		$this->generateCsrf();
		$this->render('admin/dosen/edit', $data);
	}
	public function update()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[70]');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|min_length[3]|max_length[50]');

		if ($this->form_validation->run() == false) {
			$data['data'] = $this->input->post();
			$data['prodi'] = $this->prodi_model->get_all();

			$this->generateCsrf();
			$this->render('admin/dosen/edit', $data);
		} else {
			$user_data['first_name'] = $this->input->post('nama');
			$user_data['username'] = $this->input->post('nik');
			$insert_user = $this->user_model->update($user_data, $this->input->post('id_user'));

			$data = $this->input->post();

			$update = $this->dosen_model->update($data, $this->input->post('id'));
			if ($update == false) {
				echo "ada kesalahan";
			} else {
				$this->message('Data berhasi di Ubah!', 'success');
				$this->go('admin/dosen'); //redirect ke dosen
			}
		}
	}

	public function delete($id = '')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->dosen_model->delete($id);
		$this->go('admin/dosen');
	}
}