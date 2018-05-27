<?php

/**
 * 
 */
class Profil extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump'));
		$this->root_view = "admin/";
		$this->load->model('admin/User_model');
		$this->load->model(array('user_model'));
	}

	public function ubah_password()
	{
		$this->render('mahasiswa/profil/ubah_password');
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

		if ($this->form_validation->run() == false) {

			$this->generateCsrf();
			$this->render('admin/user/add');
		} else {
			$data = $this->input->post();
			$insert = $this->user_model->insert($data);
			if ($insert == false) {
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

		if ($this->form_validation->run() == false) {
			$data['data'] = $this->input->post();

			$this->generateCsrf();
			$this->render('admin/user/add', $data);
		} else {
			$data = $this->input->post();
			$insert = $this->user_model->update($data, $this->input->post('id'));
			if ($insert == false) {
				echo "ada kesalahan";
			} else {
				$this->go('admin/user'); //redirect ke user
			}
		}

	}

	public function delete($id = '')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->user_model->delete($id);
		$this->go('admin/user');
	}
}