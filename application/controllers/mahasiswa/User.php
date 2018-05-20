<?php

/**
* 
*/
class User extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->root_view = "admin/";
		$this->load->model('admin/User_model');
		$this->load->model(array('user_model'));
	}

	public function index()
	{
		// pagination
		$filter = $this->session->userdata('filter_item');
		$q = urldecode($this->input->get('q', TRUE));
		$start = intval($this->input->get('per_page'));
		// dump($start);
		if ($q <> '') {
			$config['base_url'] = base_url() . 'admin/user/?q=' . urlencode($q);
			$config['first_url'] = base_url() . 'admin/user/?q=' . urlencode($q);
		} else {
			$config['base_url'] = base_url() . 'admin/user/';
			$config['first_url'] = base_url() . 'admin/user/';
		}

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

        $config['per_page'] = 2;
        $config['page_query_string'] = TRUE;
  
		$data = $this->user_model
            ->where($filter, 'like', '%')
            ->limit($config['per_page'],$offset=$start)
			->get_all();   

    	$total_cari =  $this->user_model
            ->where($filter, 'like', '%')
			->count_rows(); 
   	 	$config['total_rows'] = $this->user_model 
		    ->count_rows();  
          
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array( 
        	'tampildata' => $data,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'total_cari' => $total_cari,
            'start' => $start, 
            'filter' => $this->session->userdata('filter_cattle'),
            'page' => $this->uri->segment(2), 
        );    

        $this->generateCsrf();     

		$this->render('admin/user/index', $data);
	}

	public function add()
	{
		$this->generateCsrf();
		$this->render('admin/user/add');
	}
		public function save()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('no_telp', 'Nomor Telp', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|min_length[3]|max_length[25]');
		// end form validation

		if ($this->form_validation->run() == FALSE) {

			$this->generateCsrf();
			$this->render('admin/user/add');		
		} else {
			$data = $this->input->post();
			$insert = $this->user_model->insert($data);
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else {
				$this->go('admin/user'); //redirect ke user
			}	
		}

	}

		public function edit($id)
	{
		$data['data'] = $this->user_model->get($id);

		$this->generateCsrf();
		$this->render('admin/user/edit', $data);
	}
	public function update()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('no_telp', 'Nomor Telp', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|min_length[3]|max_length[25]');
		// end form validation

		if ($this->form_validation->run() == FALSE) {
			$data['data'] = $this->input->post();

			$this->generateCsrf();
			$this->render('admin/user/add', $data);		
		} else {
			$data = $this->input->post();
			$insert = $this->user_model->update($data, $this->input->post('id'));
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else {
				$this->go('admin/user'); //redirect ke user
			}	
		}

	}

	public function delete($id='')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->user_model->delete($id);
		$this->go('admin/user');
	}
}