<?php

/**
 * 
 */
class Penilaian extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump', 'utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/dosen_model');
		$this->load->model('admin/prodi_model');
		$this->load->model('admin/kuesioner_isi_model');
		$this->load->model('admin/mahasiswa_model');
		$this->load->model('admin/periode_model');
		$this->load->model('admin/pengampu_model');
		$this->load->model('admin/kelas_model');
		$this->load->model('admin/angkatan_model');
		$this->load->model('admin/makul_model');
	}

	public function ajaran()
	{
		$data['tahun_ajaran'] = $this->kuesioner_isi_model
			->where('id')
			->fields('id')
			->with_periode() 
			->group_by('id_periode')
			->get_all();  

		$this->render('admin/laporan/penilaian/ajaran', $data);
	}

	public function prodi($id_periode)
	{ 
		$data['periode'] = $this->periode_model->get($id_periode);
		
		$data['prodi'] = $this->prodi_model->get_all();
 
		$this->render('admin/laporan/penilaian/prodi', $data);
	}

	public function statistik($id_periode)
	{ 
		$id_prodi = $this->uri->segment(6); 
		$data['prodi'] = $this->prodi_model->get($id_prodi);
		$data['periode'] = $this->periode_model->get($id_periode);
		
		$data['data'] = $this->kuesioner_isi_model->getListNilaiTotalDosen($id_prodi, $id_periode);
 
		$this->render('admin/laporan/penilaian/statistik', $data);
	}

	public function detail($id_periode)
	{
		$id_dosen = $this->uri->segment(6);  
		$data['dosen'] = $this->dosen_model->get($id_dosen);

		$data['makul'] = $this->kuesioner_isi_model
			->with_periode()
			->with_mahasiswa(array('with' => array(
				array('relation'=>'kelas'), 
				array('relation'=>'angkatan')
				))) 
			->with_pengampu(array('with' => array('relation' => 'makul')))
			->where('id_periode', $id_periode)
			->where('id_dosen', $id_dosen)
			->group_by('id_pengampu')
			->get_all(); 
			
		$data['periode'] = $this->kuesioner_isi_model
			->fields('id')
			->with_periode()
			->where('id_periode', $id_periode)
			->get(); 
  
		if ($this->uri->segment(7) == 'get_list') {
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
			echo json_encode($dt, true);
		} else { 
			$this->render('admin/laporan/penilaian/detail', $data);
		}
 
	} 

	public function delete($id = '')
	{
		if (!isset($id)) {
			show_404();
		}

		$this->dosen_model->delete($id);
		$this->go('admin/dosen');
	}

	public function cetak($id_periode)
	{ 
		$this->load->library('html2pdf');

		$id_prodi = $this->uri->segment(6); 
		$data['prodi'] = $this->prodi_model->get($id_prodi);
		$data['periode'] = $this->periode_model->get($id_periode);
		
		$data['data'] = $this->kuesioner_isi_model->getListNilaiTotalDosen($id_prodi, $id_periode); 
 
		// generate nama laporan
		$filename = 'Laporan Penilaian Prodi '.$data['prodi']->nama.' Tahun Ajaran '.$data['periode']->tahun.' Semester '.$data['periode']->semester.'_'. date("Y_m_d-His"); 
		
		// configurasi html2pdf
		$this->html2pdf->folder('./laporan/');
		//Set the filename to save/download as
		$this->html2pdf->filename($filename);
		//Set the paper defaults
		$this->html2pdf->paper('a4', 'portrait');
		
		//Load html view
		$this->html2pdf->html($this->load->view('admin/laporan/penilaian/cetak_pdf', $data, true));
		// dump('asd');
		if ($path = $this->html2pdf->create('save')) {
			//PDF was successfully saved or downloaded
			// echo 'PDF saved to: ' . $path; 
			// $this->load->view('admin/laporan/penilaian/cetak_pdf', $data);
			$this->go($path); 
		} else {
			dump('asd');
		}
	}
}