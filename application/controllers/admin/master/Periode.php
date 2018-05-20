<?php

/**
*
*/
class Periode extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/periode_model');
	}

	public function index()
	{
		// pagination
		$filter = $this->session->userdata('filter_item');
        $start = $this->uri->segment(5, 0);
		$config['base_url'] = base_url() . 'admin/master/periode/index/';

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

		$data = $this->periode_model
            ->limit($config['per_page'],$offset=$start)
			->get_all();
   	 	$config['total_rows'] = $this->periode_model
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
		$this->render('admin/master/periode/index', $data);
	}
    public function search()
    {
    	$search_data = $this->input->get();

        $data = $this->periode_model->search($search_data);

        $this->generateCsrf();
		$this->render('admin/master/periode/index', $data);
    }

	public function add()
	{
		$this->generateCsrf();
		$this->render('admin/master/periode/add');
	}
	public function save()
	{
		// form validation
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required|min_length[1]|max_length[2]');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|min_length[4]|max_length[4]');

		if ($this->form_validation->run() == FALSE) {

			$this->generateCsrf();
			$this->render('admin/master/periode/add');
		} else {
			$data 	= $this->input->post();
			$insert = $this->periode_model->insert($data);
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else {
	 			$this->message('Data berhasi di Simpan!', 'success');
				$this->go('admin/master/periode'); //redirect ke periode
			}
		}
	}

	public function edit($id)
	{
		$data['data'] = $this->periode_model->get($id);

		$this->generateCsrf();
		$this->render('admin/master/periode/edit', $data);
	}
	public function update()
	{
		// form validation
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required|min_length[1]|max_length[2]');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|min_length[4]|max_length[4]');

		if ($this->form_validation->run() == FALSE) {
			$data['data'] = $this->input->post();

			$this->generateCsrf();
			$this->render('admin/master/periode/edit', $data);
		} else {
			$data 				= $this->input->post();

			$update = $this->periode_model->update($data, $this->input->post('id'));
			if ($update == FALSE) {
				echo "ada kesalahan";
			} else {
	 			$this->message('Data berhasi di Ubah!', 'success');
				$this->go('admin/master/periode'); //redirect ke periode
			}
		}
	}

	public function view($id)
	{
		$data['data'] = $this->periode_model->get($id);

        $data['page'] = $this->uri->segment(2);
		$this->render('admin/periode/view', $data);
	}

	public function delete($id='')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->periode_model->delete($id);
		$this->go('admin/master/periode');
	}

	public function active($id='')
	{
		$periode = $this->periode_model->where('status','1')->count_rows();
		// dump($periode);
		if ($periode==1) {
			  $this->message('Gagal! Sudah ada yang diaktifkan', 'danger');
				$this->go('admin/master/periode');
		}

		$data['status'] = '1';
		$this->periode_model->update($data, $id);


	  $this->message('Berhasil diaktifkan', 'success');
		$this->go('admin/master/periode');
	}

	public function unactive($id='')
	{
		$data['status'] = '0';
		$this->periode_model->update($data, $id);
	  $this->message('Berhasil di non aktifkan', 'success');
		$this->go('admin/master/periode');
	}
}
