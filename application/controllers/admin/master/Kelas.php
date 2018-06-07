<?php

/**
 * 
 */
class Kelas extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump', 'utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/kelas_model');
		$this->load->model('admin/prodi_model');
	}

	public function index()
	{
		// pagination
		$filter = $this->session->userdata('filter_item');
		$start = $this->uri->segment(5, 0);
		$config['base_url'] = base_url() . 'admin/master/kelas/index/';
 
		// Class bootstrap pagination yang digunakan
		$config['full_tag_open'] = "<ul class='pagination pagination-sm no-margin pull-right'>";
		$config['full_tag_close'] = "</ul>";
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

		$data = $this->kelas_model 
			->limit($config['per_page'], $offset = $start)
			->get_all();
		$config['total_rows'] = $this->kelas_model
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
		$this->render('admin/master/kelas/index', $data);
	}
	public function search()
	{
		$search_data = $this->input->get();

		$data = $this->kelas_model->search($search_data);

		$this->generateCsrf();
		$this->render('admin/master/kelas/index', $data);
	}

	public function add()
	{ 
		$this->generateCsrf();
		$this->render('admin/master/kelas/add');
	}
	public function save()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[1]|max_length[20]');
		$this->form_validation->set_rules('id_prodi', 'Program Studi', 'trim|required|min_length[1]|max_length[2]');

		if ($this->form_validation->run() == false) {
			$data['prodi'] = $this->prodi_model->get_all();

			$this->generateCsrf();
			$this->render('admin/master/kelas/add', $data);
		} else {
			$data = $this->input->post();

			$insert = $this->kelas_model->insert($data);
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->message('Data berhasi di Simpan!', 'success');
				$this->go('admin/master/kelas'); //redirect ke kelas
			}
		}
	}

	public function edit($id)
	{
		$data['data'] = $this->kelas_model->get($id);
		$data['prodi'] = $this->prodi_model->get_all();

		$this->generateCsrf();
		$this->render('admin/master/kelas/edit', $data);
	}
	public function update()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[1]|max_length[20]');
		$this->form_validation->set_rules('id_prodi', 'Program Studi', 'trim|required|min_length[1]|max_length[2]');

		if ($this->form_validation->run() == false) {
			$data['data'] = $this->input->post();
			$data['prodi'] = $this->prodi_model->get_all();

			$this->generateCsrf();
			$this->render('admin/master/kelas/edit', $data);
		} else {
			$data = $this->input->post();

			$insert = $this->kelas_model->update($data, $this->input->post('id'));
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->message('Data berhasi di Ubah!', 'success');
				$this->go('admin/master/kelas'); //redirect ke kelas
			}
		}
	}

	public function delete($id = '')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->kelas_model->delete($id);
		$this->go('admin/master/kelas');
	}
}