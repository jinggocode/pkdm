<?php

/**
*
*/
class Kuesioner extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump', 'klasifikasi'));
		$this->load->model('admin/user_model');
		$this->load->model('admin/prodi_model');
		$this->load->model('admin/pengampu_model');
		$this->load->model('admin/makul_model');
		$this->load->model('admin/kelas_model');
		$this->load->model('admin/dosen_model');
		$this->load->model('admin/kuesioner_model');
		$this->load->model('admin/kategori_kuesioner_model');
		$this->load->model('admin/kuesioner_isi_model');
		$this->load->model('admin/kuesioner_detail_model');
		$this->load->model('admin/periode_model');
		$this->load->model('admin/mahasiswa_model');
	}

	public function isi($id)
	{
		$data['user'] = (object)$this->ion_auth->user()->row();

		$data['data'] = $this->pengampu_model
				->with_dosen()
				->with_makul()
				->get($id);
				// dump($data['data']);

		$data['kategori'] = $this->kuesioner_model
				->where('jenis', $data['data']->makul->jenis)
				->fields('id_kategori, jenis')
				->with_kategori('order_by:nama,asc')
				->group_by('id_kategori')
				->order_by('id_kategori', 'ASC')
				->get_all();

		// dump($data['kategori']);

		$this->generateCsrf();
		$this->render('mahasiswa/kuesioner/isi', $data);
	}

	public function save()
	{
		$user = (object)$this->ion_auth->user()->row();
		$mahasiswa = $this->mahasiswa_model
				->where('id_user', $user->id)
				->get(); 

		$periode = $this->periode_model->where('status','1')->get();
		$data = $this->input->post();

		$data_kuesioner_isi = array(
			'id_dosen' => $this->input->post('id_dosen'),
			'id_periode' => $periode->id,
			'id_mahasiswa' => $mahasiswa->id,
			'id_pengampu' => $this->input->post('id_pengampu'),
		);
		$insert_kusesioner_isi = $this->kuesioner_isi_model->insert($data_kuesioner_isi);
		unset($data['id_dosen'], $data['id_pengampu']);

		while ($fruit_name = current($data)) {
				$id_kuesioner = key($data);
				$data_kuesioner_detail = array(
					'id_periode' => $periode->id,
					'id_pengampu' => $data_kuesioner_isi['id_pengampu'],
					'id_kuesioner' => $id_kuesioner,
					'nilai' => $data[$id_kuesioner],
					'id_kuesioner_isi' => $insert_kusesioner_isi,
				);
		    // echo $id_kuesioner.'='.$data[$id_kuesioner].'<br />';
				$insert_kusesioner_detail = $this->kuesioner_detail_model->insert($data_kuesioner_detail);

		    next($data);
		}

		$pengampu = $this->pengampu_model->get($this->input->post('id_pengampu'));
		$makul = $this->makul_model->get($pengampu->id_makul);
		
		$kuesioner_isi = $this->kuesioner_detail_model->getJumlahNilai($insert_kusesioner_isi);

		$nilai = (int)$kuesioner_isi->nilai; 
		if ($makul->jenis == '0') { 
			$data_nilai['klasifikasi'] = cekNilai($nilai, 0);
		} else {
			$data_nilai['klasifikasi'] = cekNilai($nilai, 1); 
		}
		
		$data_nilai['total_nilai'] = $kuesioner_isi->nilai;
		$this->kuesioner_isi_model->update($data_nilai, $insert_kusesioner_isi);
		  
		$this->message('Kuesioner berhasil di Simpan', 'success');
		$this->go('mahasiswa/homepage');
	}

	public function cek_semester($value='')
	{
		$semester = 20181;
		$angkatan = 2015;

		if ($semester %2 != 0){
			$a = (($semester + 10)-1)/10;
			$b = $a - $angkatan;
			$c = ($b*2)-2;
			return $c;
			// echo "Semester : $c";
		}else{
			$a = (($semester + 10)-2)/10;
			$b = $a - $angkatan;
			$c = ($b * 2)-1;

			return $c;
			// echo "Semester : $c";
		}
	}

}
