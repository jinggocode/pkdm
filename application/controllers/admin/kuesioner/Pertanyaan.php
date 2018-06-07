<?php

/**
*
*/
class Pertanyaan extends MY_Controller
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
		$config['base_url'] = base_url() . 'admin/kuesioner/pertanyaan/index';

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

		$data = $this->kuesioner_model
		->with_kategori()
		->limit($config['per_page'],$offset=$start)
		->get_all();
		$config['total_rows'] = $this->kuesioner_model
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
		$this->render('admin/kuesioner/pertanyaan/index', $data);
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
		$data['kategori'] = $this->kategori_kuesioner_model->get_all();

		$this->generateCsrf();
		$this->render('admin/kuesioner/pertanyaan/add', $data);
	}
	public function save()
	{
		// form validation
		$this->form_validation->set_rules('isi', 'Isi Pertanyaan', 'trim|required|min_length[1]|max_length[200]');

		if ($this->form_validation->run() == FALSE) {
			$data['prodi'] = $this->prodi_model->get_all();

			$this->generateCsrf();
			$this->render('admin/kuesioner/pertanyaan/add', $data);
		} else {
			$data 	= $this->input->post();

			$insert = $this->kuesioner_model->insert($data);
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else {
				$this->message('Data berhasi di Simpan!', 'success');
				$this->go('admin/kuesioner/pertanyaan'); //redirect ke kuesioner
			}
		}
	}

	public function edit($id)
	{
		$data['data'] = $this->kuesioner_model->get($id);
		$data['kategori'] = $this->kategori_kuesioner_model->get_all();

		$this->generateCsrf();
		$this->render('admin/kuesioner/pertanyaan/edit', $data);
	}
	public function update()
	{
		// form validation
		$this->form_validation->set_rules('isi', 'Isi Pertanyaan', 'trim|required|min_length[1]|max_length[200]');

		if ($this->form_validation->run() == FALSE) {
			$data['data'] = $this->input->post();
			$data['kategori'] = $this->kategori_kuesioner_model->get_all();

			$this->generateCsrf();
			$this->render('admin/kuesioner/pertanyaan/edit', $data);
		} else {
			$data 				= $this->input->post();

			$update = $this->kuesioner_model->update($data, $this->input->post('id'));
			if ($update == FALSE) {
				echo "ada kesalahan";
			} else {
				$this->message('Data berhasi di Ubah!', 'success');
				$this->go('admin/kuesioner/pertanyaan'); //redirect ke kuesioner
			}
		}
	}

	public function delete($id='')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->message('Data berhasi di Hapus!', 'success');
		$this->kuesioner_model->delete($id);
		$this->go('admin/kuesioner/pertanyaan');
	}
}
