<?php

/**
*
*/
class Pengampu extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/pengampu_model');
		$this->load->model('admin/kelas_model');
		$this->load->model('admin/prodi_model');
		$this->load->model('admin/makul_model');
		$this->load->model('admin/dosen_model');
	} 

	public function index()
	{
		// pagination
		$filter = $this->session->userdata('filter_item');
		$start = $this->uri->segment(5, 0);
		$config['base_url'] = base_url() . 'admin/master/pengampu/index/';

		// Class bootstrap pagination yang digunakan
		$config['full_tag_open'] = "<ul class='pagination pagination-sm no-margin pull-right'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		$config['per_page'] = 10;

		$data = $this->pengampu_model
				->with_dosen()
				->with_makul()
				->with_prodi()
				->with_kelas()
				->limit($config['per_page'],$offset=$start)
				->get_all();
		$config['total_rows'] = $this->pengampu_model
		->count_rows();

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$data = array(
			'data' => $data,
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
			'filter' => $this->session->userdata('filter_cattle'),
			'page' => $this->uri->segment(2),
		);

		$this->generateCsrf();
		$this->render('admin/master/pengampu/index', $data);
	}
	public function search()
	{
		$search_data = $this->input->get();

		$data = $this->pengampu_model->search($search_data);

		$this->generateCsrf();
		$this->render('admin/master/pengampu/index', $data);
	}

	public function add()
	{
		$data['makul'] = $this->makul_model->get_all();
		$data['kelas'] = $this->kelas_model->get_all();
		$data['dosen'] = $this->dosen_model->get_all();
		$data['prodi'] = $this->prodi_model->get_all();

		$this->generateCsrf();
		$this->render('admin/master/pengampu/add', $data);
	}
	public function save()
	{ 
		// form validation
		$this->form_validation->set_rules('id_prodi', 'Program Studi', 'trim|min_length[1]|max_length[2]');
		$this->form_validation->set_rules('id_makul', 'Mata Kuliah', 'trim|min_length[1]|max_length[3]');
		$this->form_validation->set_rules('id_dosen', 'Dosen', 'trim|min_length[1]|max_length[4]');
		$this->form_validation->set_rules('id_kelas', 'Kelas', 'trim|min_length[1]|max_length[2]');

		if ($this->form_validation->run() == FALSE) {
			$data['makul'] = $this->makul_model->get_all();
			$data['kelas'] = $this->kelas_model->get_all();
			$data['dosen'] = $this->dosen_model->get_all();

			$this->generateCsrf();
			$this->render('admin/master/pengampu/add', $data);
		} else {
			$data 	= $this->input->post();

			$insert = $this->pengampu_model->insert($data);
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else {
				$this->message('Data berhasi di Simpan!', 'success');
				$this->go('admin/master/pengampu'); //redirect ke pengampu
			}
		}
	}

	public function edit($id)
	{
		$data['data'] = $this->pengampu_model->get($id);
		$data['makul'] = $this->makul_model->get($data['data']->id_makul);
		$data['kelas'] = $this->kelas_model->get($data['data']->id_kelas);
		$data['dosen'] = $this->dosen_model->get($data['data']->id_dosen);
		$data['prodi'] = $this->prodi_model->get_all();

		// dump($data['makul']);
		$this->generateCsrf();
		$this->render('admin/master/pengampu/edit', $data);
	}
	public function update()
	{
		// form validation
		$this->form_validation->set_rules('id_prodi', 'Program Studi', 'trim|min_length[1]|max_length[2]');
		$this->form_validation->set_rules('id_makul', 'Mata Kuliah', 'trim|min_length[1]|max_length[3]');
		$this->form_validation->set_rules('id_dosen', 'Dosen', 'trim|min_length[1]|max_length[2]');
		$this->form_validation->set_rules('id_kelas', 'Kelas', 'trim|min_length[1]|max_length[2]');

		if ($this->form_validation->run() == FALSE) {
			$data['data'] = $this->input->post();
			$data['makul'] = $this->makul_model->get_all();
			$data['kelas'] = $this->kelas_model->get_all();
			$data['dosen'] = $this->dosen_model->get_all();

			$this->generateCsrf();
			$this->render('admin/master/pengampu/edit', $data);
		} else {
			$data 				= $this->input->post();

			$updates = $this->pengampu_model->update($data, $this->input->post('id'));
			if ($updates == FALSE) {
				echo "ada kesalahan";
			} else {
				$this->message('Data berhasi di Ubah!', 'success');
				$this->go('admin/master/pengampu'); //redirect ke pengampu
			}
		}
	}

	public function delete($id='')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->pengampu_model->delete($id);
		$this->go('admin/master/pengampu');
	}

	 
	public function get($parameter = null)
	{ 
		if ($parameter == 'getKelas') {
			$id_prodi = $_GET['id_prodi']; 
			$data = $this->kelas_model->get_all();

			echo '<option value="">== Pilih Kelas ==</option>';
			foreach ($data as $value) { 
					echo '<option value="' . $value->id . '">' . $value->nama . '</option>'; 
			}
			die();
		} else if ($parameter == 'getMakul') {
			$id_prodi = $_GET['id_prodi']; 
			$semester = $_GET['semester']; 
			$data = $this->makul_model->where('id_prodi', $id_prodi)->where('semester', $semester)->get_all();

			echo '<option value="">== Pilih Matakuliah ==</option>';
			foreach ($data as $value) { 
					echo '<option value="' . $value->id . '">SEMESTER ' . $value->semester . ' -  ' . ($value->jenis == 0?'TEORI':'PRAKTIKUM') . ' - ' . $value->nama . '</option>'; 
			}
			die();
		} else if ($parameter == 'getDosen') {
			$id_prodi = $_GET['id_prodi']; 
			$data = $this->dosen_model->where('id_prodi', $id_prodi)->get_all();

			echo '<option value="">== Pilih Dosen ==</option>';

			foreach ($data as $value) { 
					echo '<option value="' . $value->id . '">' . $value->nama . '</option>'; 
			}
			die();
		}
	}

	 
	public function get_row($parameter = null)
	{ 
		if ($parameter == 'getProdi') {
			$id_kelas = $_GET['id_kelas']; 
			$id_prodi = $_GET['id_prodi']; 
			$data = $this->kelas_model->where('id_prodi', $id_prodi)->get_all();

			echo '<option value="">== Pilih Kelas ==</option>';
			foreach ($data as $value) { 
				if ($id_kelas == $value->id) {
					echo '<option selected value="' . $value->id . '">' . $value->nama . '</option>';  
				} else {
					echo '<option value="' . $value->id . '">' . $value->nama . '</option>';   
				}
			}
			die();
		} else if ($parameter == 'getMakul') {
			$id_prodi = $_GET['id_prodi']; 
			$id_makul = $_GET['id_makul']; 
			$data = $this->makul_model->where('id_prodi', $id_prodi)->get_all();

			echo '<option value="">== Pilih Matakuliah ==</option>';
			foreach ($data as $value) { 
				if ($id_makul == $value->id) {
					echo '<option selected value="' . $value->id . '">SEMESTER ' . $value->semester . ' - ' . $value->nama . '</option>'; 
				} else { 
					echo '<option value="' . $value->id . '">SEMESTER ' . $value->semester . ' - ' . $value->nama . '</option>'; 
				}
			}
			die();
		} else if ($parameter == 'getDosen') {
			$id_prodi = $_GET['id_prodi']; 
			$id_dosen = $_GET['id_dosen']; 
			$data = $this->dosen_model->where('id_prodi', $id_prodi)->get_all();

			echo '<option value="">== Pilih Dosen ==</option>';

			foreach ($data as $value) { 
				if ($id_dosen == $value->id) {
					echo '<option selected value="' . $value->id . '">' . $value->nama . '</option>';  
				} else {
					echo '<option value="' . $value->id . '">' . $value->nama . '</option>';   
				}
			}
			die();
		}
	}

}
