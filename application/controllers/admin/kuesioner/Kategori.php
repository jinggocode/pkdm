<?php

/**
*
*/
class kategori extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/kuesioner_model');
		$this->load->model('admin/prodi_model');
		$this->load->model('admin/kategori_kuesioner_model');
	}

	public function index()
	{
		// pagination
		$filter = $this->session->userdata('filter_item');
		$start = $this->uri->segment(5, 0);
		$config['base_url'] = base_url() . 'admin/kuesioner/kategori/index';

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

		$data = $this->kategori_kuesioner_model
		->with_kategori()
		->limit($config['per_page'],$offset=$start)
		->get_all();
		$config['total_rows'] = $this->kategori_kuesioner_model
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
		$this->render('admin/kuesioner/kategori/index', $data);
	}
	public function search()
	{
		$search_data = $this->input->get();

		$data = $this->kuesioner_model->search($search_data);

		$this->generateCsrf();
		$this->render('admin/master/kuesioner/index', $data);
	}

	public function add()
	{
		$this->generateCsrf();
		$this->render('admin/kuesioner/kategori/add');
	}
	public function save()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Kategori Pertanyaan', 'trim|required|min_length[1]|max_length[200]');

		if ($this->form_validation->run() == FALSE) {
			$this->generateCsrf();
			$this->render('admin/kuesioner/kategori/add');
		} else {
			$data 	= $this->input->post();

			$insert = $this->kategori_kuesioner_model->insert($data);
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else {
				$this->message('Data berhasi di Simpan!', 'success');
				$this->go('admin/kuesioner/kategori'); //redirect ke kuesioner
			}
		}
	}

	public function edit($id)
	{
		$data['data'] = $this->kategori_kuesioner_model->get($id);

		$this->generateCsrf();
		$this->render('admin/kuesioner/kategori/edit', $data);
	}
	public function update()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Kategori Pertanyaan', 'trim|required|min_length[1]|max_length[200]');

		if ($this->form_validation->run() == FALSE) {
			$data['data'] = $this->input->post();

			$this->generateCsrf();
			$this->render('admin/kuesioner/kategori/edit', $data);
		} else {
			$data 				= $this->input->post();

			$update = $this->kategori_kuesioner_model->update($data, $this->input->post('id'));
			if ($update == FALSE) {
				echo "ada kesalahan";
			} else {
				$this->message('Data berhasi di Ubah!', 'success');
				$this->go('admin/kuesioner/kategori'); //redirect ke kuesioner
			}
		}
	}

	public function delete($id='')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->message('Data berhasi di Hapus!', 'success');
		$this->kategori_kuesioner_model->delete($id);
		$this->go('admin/kuesioner/kategori');
	}
}
