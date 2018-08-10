<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengampu_model extends MY_Model
{
	public function __construct()
	{
		$this->table = 'pengampu_makul';
		$this->primary_key = 'id';
		$this->protected = array('id');

		$this->has_one['prodi'] = array('Prodi_model', 'id', 'id_prodi');
		$this->has_one['makul'] = array('Makul_model', 'id', 'id_makul');
		$this->has_one['kelas'] = array('Kelas_model', 'id', 'id_kelas');
		$this->has_one['dosen'] = array('Dosen_model', 'id', 'id_dosen');

		parent::__construct();
	}

	public function getData($id_kelas, $semester, $id_prodi)
	{
		// dump($semester);
		$this->db->select('pengampu_makul.id as id_pengampu, matakuliah.nama, dosen.nama as nama_dosen, dosen.id as id_dosen, matakuliah.nama as nama_makul, matakuliah.jenis as jenis_makul');
		$this->db->from('pengampu_makul');
		$this->db->join('matakuliah', 'matakuliah.id = pengampu_makul.id_makul');
		$this->db->join('dosen', 'dosen.id = pengampu_makul.id_dosen');
		$this->db->where('matakuliah.id_prodi', $id_prodi);
		$this->db->where('id_kelas', $id_kelas);
		$this->db->where('matakuliah.semester', $semester);
		$query = $this->db->get();

		return $query->result();
	}

	public function getJumlahData($id_kelas, $semester)
	{
		$this->db->select('pengampu_makul.id as id_pengampu, matakuliah.nama, dosen.nama as nama_dosen, dosen.id as id_dosen, matakuliah.nama as nama_makul, matakuliah.jenis as jenis_makul');
		$this->db->from('pengampu_makul');
		$this->db->join('matakuliah', 'matakuliah.id = pengampu_makul.id_makul');
		$this->db->join('dosen', 'dosen.id = pengampu_makul.id_dosen');
		$this->db->where('id_kelas', $id_kelas);
		$this->db->where('matakuliah.semester', $semester);
		$query = $this->db->get();

		return $query->num_rows();;
	}

	public function cek_isi($id_mhs, $semester, $id_kelas, $id_periode)
	{
		$jumlah_data = $this->getJumlahData($id_kelas, $semester);

		$query = $this->db->query('select kuesioner_isi_detail.id_pengampu from kuesioner_isi_detail JOIN kuesioner_isi ON kuesioner_isi.id = kuesioner_isi_detail.id_kuesioner_isi where kuesioner_isi_detail.id_periode = ' . $id_periode . ' and kuesioner_isi.id_mahasiswa = ' . $id_mhs . ' and id_mahasiswa and exists
		(select pengampu_makul.id from pengampu_makul
		JOIN matakuliah ON matakuliah.id = pengampu_makul.id_makul
		JOIN mahasiswa ON mahasiswa.id_kelas = pengampu_makul.id_kelas
		where matakuliah.semester = ' . $semester . ' AND mahasiswa.id = ' . $id_mhs . ') group by id_pengampu');
		// $query = $this->db->get();
		$terisi = $query->num_rows();

		// dump($terisi);

		if ($jumlah_data > $terisi) {
			// belum selesai
			return 0;
		} else {
			return 1;
		}
	}

	public function search($search_data)
	{
		$start = $this->uri->segment(5, 0);
		$config['base_url'] = base_url() . 'admin/master/pengampu/search/';
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);

		// Class bootstrap pagination yang digunakan
		$config['full_tag_open'] = "<ul class='pagination pagination-sm no-margin pull-right'>";
		$config['full_tag_close'] = "</ul>";
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

		if ($search_data['sort'] == 1) {
			$sort_by = 'created_at';
			$sort_with = 'DESC';
		} else if ($search_data['sort'] == 2) {
			$sort_by = 'created_at';
			$sort_with = 'ASC';
		} else {
			$sort_by = '';
			$sort_with = '';
		}

		$data = $this->pengampu_model
			->limit($config['per_page'], $offset = $start)
			->where('nama', 'like', $search_data['keyword'])
			->order_by($sort_by, $sort_with)
			->get_all();
		$config['total_rows'] = $this->pengampu_model
			->where('nama', 'like', $search_data['keyword'])
			->count_rows();

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$data = array(
			'data' => $data,
			'search_data' => $search_data,
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
			'page' => $this->uri->segment(2),
		);
		return $data;
	}
}
