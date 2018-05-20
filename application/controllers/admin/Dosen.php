<?php

/**
* 
*/
class Dosen extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/dosen_model'); 
		$this->load->model('admin/prodi_model');  
	}

	public function index()
	{
		// pagination
		$filter = $this->session->userdata('filter_item'); 
        $start = $this->uri->segment(4, 0);  
		$config['base_url'] = base_url() . 'admin/dosen/index/';
 
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
  
		$data = $this->dosen_model
			->with_prodi()
            ->limit($config['per_page'],$offset=$start)
			->get_all();   
    	$total_cari =  $this->dosen_model
            ->where($filter, 'like', '%')
			->count_rows(); 
   	 	$config['total_rows'] = $this->dosen_model 
		    ->count_rows();  
          
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array( 
        	'data' => $data,  
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'total_cari' => $total_cari,
            'start' => $start, 
            'filter' => $this->session->userdata('filter_cattle'),         );    

        $this->generateCsrf();       
		$this->render('admin/dosen/index', $data);
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
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|min_length[3]|max_length[20]'); 

		if ($this->form_validation->run() == FALSE) { 
			$data['prodi'] = $this->prodi_model->get_all();

			$this->generateCsrf();
        	$data['page'] = $this->uri->segment(2);
			$this->render('admin/dosen/add', $data);		
		} else {
			$data = $this->input->post(); 

			$insert = $this->dosen_model->insert($data);
			if ($insert == FALSE) {
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
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|min_length[3]|max_length[20]'); 

		if ($this->form_validation->run() == FALSE) {
			$data['data']  = $this->input->post();
			$data['prodi'] = $this->prodi_model->get_all(); 

			$this->generateCsrf(); 
			$this->render('admin/dosen/edit', $data);		
		} else {
			$data 		  = $this->input->post(); 

			$update = $this->dosen_model->update($data, $this->input->post('id'));
			if ($update == FALSE) {
				echo "ada kesalahan";
			} else {
	 			$this->message('Data berhasi di Ubah!', 'success');
				$this->go('admin/dosen'); //redirect ke dosen
			}	
		} 
	}

	public function delete($id='')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->dosen_model->delete($id);
		$this->go('admin/dosen');
	}
}