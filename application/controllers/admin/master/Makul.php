<?php

/**
 * 
 */
class Makul extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump', 'utility', 'excel'));
		$this->root_view = "admin/";
		$this->load->model('admin/prodi_model');
		$this->load->model('admin/makul_model');
	} 	

	public function index()
	{
		// pagination
		$filter = $this->session->userdata('filter_item');
		$start = $this->uri->segment(5, 0);
		$config['base_url'] = base_url() . 'admin/master/makul/index/';
 
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

		$data = $this->makul_model
			->with_prodi()
			->limit($config['per_page'], $offset = $start)
			->get_all();
		$config['total_rows'] = $this->makul_model
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
		$this->render('admin/master/makul/index', $data);
	}
	public function search()
	{
		$search_data = $this->input->get();

		$data = $this->makul_model->search($search_data);

		$this->generateCsrf();
		$this->render('admin/master/makul/index', $data);
	}

	public function add()
	{
		$data['prodi'] = $this->prodi_model->get_all();

		$this->generateCsrf();
		$this->render('admin/master/makul/add', $data);
	}
	public function save()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[1]|max_length[60]');
		$this->form_validation->set_rules('id_prodi', 'Program Studi', 'trim|required|min_length[1]|max_length[2]');

		if ($this->form_validation->run() == false) {
			$data['prodi'] = $this->prodi_model->get_all();

			$this->generateCsrf();
			$this->render('admin/master/makul/add', $data);
		} else {
			$data = $this->input->post();

			$insert = $this->makul_model->insert($data);
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->message('Data berhasi di Simpan!', 'success');
				$this->go('admin/master/makul'); //redirect ke makul
			}
		}
	}

	public function edit($id)
	{
		$data['data'] = $this->makul_model->get($id);
		$data['prodi'] = $this->prodi_model->get_all();

		$this->generateCsrf();
		$this->render('admin/master/makul/edit', $data);
	}
	public function update()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[1]|max_length[60]');
		$this->form_validation->set_rules('id_prodi', 'Program Studi', 'trim|required|min_length[1]|max_length[2]');

		if ($this->form_validation->run() == false) {
			$data['data'] = $this->input->post();
			$data['prodi'] = $this->prodi_model->get_all();

			$this->generateCsrf();
			$this->render('admin/master/makul/edit', $data);
		} else {
			$data = $this->input->post();

			$insert = $this->makul_model->update($data, $this->input->post('id'));
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->message('Data berhasi di Ubah!', 'success');
				$this->go('admin/master/makul'); //redirect ke makul
			}
		}
	}

	public function delete($id = '')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->makul_model->delete($id);
		$this->go('admin/master/makul');
	}

	public function import()
	{
		$this->generateCsrf();
		$this->render('admin/master/makul/import');
	}

	public function import_action()
	{
		if (!empty($_FILES['file']['name'])) {
			// melakukan proses upload
			$file_name    = $this->upload_file();
			$data['file'] = $file_name; 
		}
		// mengambil data didalam file excel, sehingga didapat data dalam bentuk Array
		$excel_data = getArrayDataFromExcel($file_name); 
		 
		foreach ($excel_data as $value) {   
			$data['id_prodi'] = $value[0];
			$data['jenis'] = (string)$value[1];
			$data['nama'] = $value[2];
			$data['semester'] = $value[3];
			$insert = $this->makul_model->insert($data);
		}

		$this->message('Data berhasi di Import', 'success');
		$this->go('admin/master/makul');  
	}

	function upload_file(){
		$set_name   = fileName(1, 'XLS','',8);
		$path       = $_FILES['file']['name'];
		$extension  = ".".pathinfo($path, PATHINFO_EXTENSION);

		$config['upload_path']          = './excel/file/';
		$config['allowed_types']        = 'xls|xlsx';
		$config['max_size']             = 9024;
		$config['file_name']            = $set_name.$extension;
		$this->load->library('upload', $config);
		// proses upload
		$upload = $this->upload->do_upload('file');

		if ($upload == FALSE) {
			$error = array('error' => $this->upload->display_errors());
			dump($error); 
		}

		$upload = $this->upload->data();

		return $upload['file_name'];
	} 
}