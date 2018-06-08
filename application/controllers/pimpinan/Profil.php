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
		$this->load->model('admin/user_model'); 
	}

	public function ubah_password()
	{
		$data['user'] = $this->ion_auth->user()->row();

		$this->generateCsrf();
		$this->render('pimpinan/profil/ubah_password', $data);
	} 
	public function update()
	{
		// form validation
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[8]');
		$this->form_validation->set_rules('reenter_password', 'Ulangi Password', 'trim|required|max_length[8]|matches[password]'); 
		// end form validation

		if ($this->form_validation->run() == false) {
			$data['user'] = $this->ion_auth->user()->row();

			$this->generateCsrf();
			$this->render('pimpinan/profil/ubah_password', $data);
		} else {
			$data = $this->input->post();
			$data['password'] 	= password_hash($data['password'], PASSWORD_BCRYPT);
			$data['status_password'] 	= '1';

			$update = $this->user_model->update($data, $this->input->post('id'));
 
			if ($update == false) {
				echo "ada kesalahan";
			} else {
				$this->message('Password Berhasil di Ubah!', 'success');
				$this->go('pimpinan/homepage'); //redirect ke user
			}
		}

	}  
}