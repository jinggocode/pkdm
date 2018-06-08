<?php

/**
 *
 */
class Statistik extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump', 'cek_semester'));
		$this->load->model('admin/prodi_model');
		$this->load->model('admin/user_model');
		$this->load->model('admin/pengampu_model');
		$this->load->model('admin/makul_model');
		$this->load->model('admin/dosen_model');
		$this->load->model('admin/kelas_model');
		$this->load->model('admin/mahasiswa_model');
		$this->load->model('admin/periode_model');
		$this->load->model('admin/angkatan_model');
		$this->load->model('admin/kuesioner_isi_model');
	}

	public function makul($id_periode)
	{
		$data['user'] = $this->ion_auth->user()->row();
		$dosen = $this->dosen_model->where('id_user', $data['user']->id)->get();

		$data['makul'] = $this->kuesioner_isi_model
			->with_periode()
			->with_mahasiswa(array('with' => array(
				array('relation'=>'kelas'), 
				array('relation'=>'angkatan')
				))) 
			->with_pengampu(array('with' => array('relation' => 'makul')))
			->where('id_periode', $id_periode)
			->where('id_dosen', $dosen->id)
			->group_by('id_pengampu')
			->get_all(); 

		$data['periode'] = $this->kuesioner_isi_model
			->fields('id')
			->with_periode()
			->where('id_periode', $id_periode)
			->get();
 
		if ($this->uri->segment(5) == 'get_list') {
			foreach ($data['makul'] as $value) {
				$list = $this->kuesioner_isi_model->getListPenilaian($value->id_pengampu, $value->id_periode);
				$dt[] = array(
					'judul' => 'ANGKATAN '.$value->mahasiswa->angkatan->nama.' - KELAS '.$value->mahasiswa->kelas->nama.' || '.($value->pengampu->makul->jenis == '0'?'TEORI ':'PRAKIKUM ').$value->pengampu->makul->nama, 
					'kurang' => $list->kurang, 
					'cukup' => $list->cukup, 
					'baik' => $list->baik, 
					'sangat_baik' => $list->sangat_baik, 
				); 
			} 
			print_r(json_encode($dt, true));
		} else { 
			$this->render('dosen/statistik/makul', $data); 
		}
 
	}

	public function grafik($id_pengampu)
	{
		$id_periode = $this->uri->segment(5);

		$data['user'] = $this->ion_auth->user()->row();

		$data['makul'] = $this->kuesioner_isi_model
			->with_pengampu(array('with' => array('relation' => 'makul')))
			->where('id_pengampu', $id_pengampu)
			->where('id_periode', $id_periode) 
			->group_by('id_periode')
			->get(); 

		$data['jumlah_kurang'] = $this->kuesioner_isi_model
			->where('id_pengampu', $id_pengampu)
			->where('id_periode', $id_periode)
			->where('klasifikasi', '0')
			->count_rows();
		$data['jumlah_cukup'] = $this->kuesioner_isi_model
			->where('id_pengampu', $id_pengampu)
			->where('id_periode', $id_periode)
			->where('klasifikasi', '1')
			->count_rows();
		$data['jumlah_baik'] = $this->kuesioner_isi_model
			->where('id_pengampu', $id_pengampu)
			->where('id_periode', $id_periode)
			->where('klasifikasi', '2')
			->count_rows();
		$data['jumlah_sangat_baik'] = $this->kuesioner_isi_model
			->where('id_pengampu', $id_pengampu)
			->where('id_periode', $id_periode)
			->where('klasifikasi', '3')
			->count_rows(); 

		$data['kategori_pertanyaan'] = $this->db->query('select id_kuesioner, kuesioner_kategori.id, kuesioner_kategori.nama, kuesioner.isi, avg(nilai) from kuesioner_isi_detail
		join kuesioner ON kuesioner.id = kuesioner_isi_detail.id_kuesioner 
		join kuesioner_kategori ON kuesioner.id_kategori = kuesioner_kategori.id
		where (id_pengampu = '.$id_pengampu.' and id_periode = '.$id_periode.')
		group by kuesioner_kategori.nama')->result();
		
		$this->render('dosen/statistik/grafik', $data);
	}

}
