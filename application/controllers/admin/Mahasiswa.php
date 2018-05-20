<?php

/**
*
*/
class Mahasiswa extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/mahasiswa_model');
		$this->load->model('admin/prodi_model');
		$this->load->model('admin/kelas_model');
		$this->load->model('admin/user_model');
		$this->load->model('admin/angkatan_model');
	}

	public function index()
	{
		// pagination
		$filter = $this->session->userdata('filter_item');
        $start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'admin/mahasiswa/index/';

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

		$data = $this->mahasiswa_model
			->with_kelas(array('with'=>array('relation'=>'prodi','fields'=>'nama')))
						->limit($config['per_page'],$offset=$start)
			->with_angkatan()
			->get_all();

    	$total_cari =  $this->mahasiswa_model
            ->where($filter, 'like', '%')
			->count_rows();
   	 	$config['total_rows'] = $this->mahasiswa_model
		    ->count_rows();

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
        	'data' => $data,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'total_cari' => $total_cari,
            'start' => $start,
        );

        $this->generateCsrf();
		$this->render('admin/mahasiswa/index', $data);
	}
    public function search()
    {
    	$search_data = $this->input->get();

        $data = $this->mahasiswa_model->search($search_data);

        $this->generateCsrf();
		$this->render('admin/mahasiswa/index', $data);
    }

	public function add()
	{
		$data['kelas'] 	  = $this->kelas_model->with_prodi()->get_all();
		$data['angkatan'] = $this->angkatan_model->get_all();

		$this->generateCsrf();
		$this->render('admin/mahasiswa/add', $data);
	}
	public function save()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[70]');
		$this->form_validation->set_rules('nim', 'NIM', 'trim|required|min_length[3]|max_length[20]');

		if ($this->form_validation->run() == FALSE) {
			$data['kelas'] = $this->kelas_model->with_prodi()->get_all();

			$this->generateCsrf();
			$this->render('admin/mahasiswa/add', $data);
		} else {
			$user_data['first_name'] = $this->input->post('nama');
			$user_data['username']   = $this->input->post('nim');
			$user_data['password'] 	= password_hash('default', PASSWORD_BCRYPT);
			$user_data['group_id'] 	= '3';
			$insert_user = $this->user_model->insert($user_data);

			$data = $this->input->post();
			$data['id_user'] = $insert_user;

			$insert = $this->mahasiswa_model->insert($data);
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else {
	 			$this->message('Data berhasi di Simpan!', 'success');
				$this->go('admin/mahasiswa'); //redirect ke mahasiswa
			}
		}
	}

	public function edit($id)
	{
		$data['data']  = $this->mahasiswa_model->get($id);
		$data['kelas'] = $this->kelas_model->with_prodi()->get_all();
		$data['angkatan'] = $this->angkatan_model->get_all();

		$this->generateCsrf();
		$this->render('admin/mahasiswa/edit', $data);
	}
	public function update()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[70]');
		$this->form_validation->set_rules('nim', 'NIM', 'trim|required|min_length[3]|max_length[20]');

		if ($this->form_validation->run() == FALSE) {
			$data['data']  = $this->input->post();
			$data['kelas'] = $this->kelas_model->with_prodi()->get_all();

			$this->generateCsrf();
			$this->render('admin/mahasiswa/edit', $data);
		} else {
			$user_data['first_name'] = $this->input->post('nama');
			$user_data['username']   = $this->input->post('nim');
			$insert_user = $this->user_model->update($user_data, $this->input->post('id_user'));

			$data 		  = $this->input->post();

			$update = $this->mahasiswa_model->update($data, $this->input->post('id'));
			if ($update == FALSE) {
				echo "ada kesalahan";
			} else {
	 			$this->message('Data berhasi di Ubah!', 'success');
				$this->go('admin/mahasiswa'); //redirect ke mahasiswa
			}
		}
	}

	public function delete($id='')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->mahasiswa_model->delete($id);
		$this->go('admin/mahasiswa');
	}
}
