<?php

/**
* 
*/
class Angkatan extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/angkatan_model');  
	}

	public function index()
	{
		// pagination
		$filter = $this->session->userdata('filter_item'); 
        $start = $this->uri->segment(5, 0);  
		$config['base_url'] = base_url() . 'admin/master/angkatan/index/';
 
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
  
		$data = $this->angkatan_model  
            ->limit($config['per_page'],$offset=$start)
			->get_all();    
   	 	$config['total_rows'] = $this->angkatan_model 
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
		$this->render('admin/master/angkatan/index', $data);
	}
    public function search()
    { 
    	$search_data = $this->input->get();

        $data = $this->angkatan_model->search($search_data);
 
        $this->generateCsrf();  
		$this->render('admin/master/angkatan/index', $data);
    } 

	public function add()
	{  
		$this->generateCsrf(); 
		$this->render('admin/master/angkatan/add');
	}
	public function save()
	{
		// form validation 
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[4]|is_unique[angkatan.nama]',
        array(
                'required'      => 'Harus di isi',
                'is_unique'     => 'Nama Angkatan '.$this->input->post('nama').' sudah ada'
        ));   
		 
		if ($this->form_validation->run() == FALSE) { 

			$this->generateCsrf();
			$this->render('admin/master/angkatan/add');		
		} else {
			$data 	= $this->input->post(); 
			$insert = $this->angkatan_model->insert($data);
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else { 
	 			$this->message('Data berhasi di Simpan!', 'success');
				$this->go('admin/master/angkatan'); //redirect ke angkatan
			}	
		}
	}

	public function edit($id)
	{
		$data['data'] = $this->angkatan_model->get($id);
 
		$this->generateCsrf();
		$this->render('admin/master/angkatan/edit', $data);
	}
	public function update()
	{
		// form validation
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[70]');
 
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = $this->input->post();

			$this->generateCsrf();
			$this->render('admin/master/angkatan/edit', $data);		
		} else {
			$data 				= $this->input->post(); 

			$insert = $this->angkatan_model->update($data, $this->input->post('id'));
			if ($insert == FALSE) {
				echo "ada kesalahan";
			} else {
	 			$this->message('Data berhasi di Ubah!', 'success');
				$this->go('admin/master/angkatan'); //redirect ke angkatan
			}	
		} 
	}

	public function view($id)
	{
		$data['data'] = $this->angkatan_model->get($id); 
 
        $data['page'] = $this->uri->segment(2);
		$this->render('admin/angkatan/view', $data);
	}
 
	public function delete($id='')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->angkatan_model->delete($id);
		$this->go('admin/master/angkatan');
	}
}