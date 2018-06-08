<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kuesioner_isi_model extends MY_Model
{
	public function __construct()
	{
		$this->table = 'kuesioner_isi';
		$this->primary_key = 'id';
		$this->protected = array('id');

		$this->has_one['mahasiswa'] = array('Mahasiswa_model', 'id', 'id_mahasiswa');
		$this->has_one['periode'] = array('Periode_model', 'id', 'id_periode');
		$this->has_one['pengampu'] = array('Pengampu_model', 'id', 'id_pengampu');
		parent::__construct();
	} 
	
	public function getListPenilaian($id_pengampu, $id_periode)
	{
		$query = $this->db->query('select 
		jumlah_klasifikasi('.$id_pengampu.', '.$id_periode.', 0) as kurang, 
		jumlah_klasifikasi('.$id_pengampu.', '.$id_periode.', 1) as cukup, 
		jumlah_klasifikasi('.$id_pengampu.', '.$id_periode.', 2) as baik, 
		jumlah_klasifikasi('.$id_pengampu.', '.$id_periode.', 3) as sangat_baik
		from kuesioner_isi where id_pengampu = '.$id_pengampu.' and id_periode = '.$id_periode.'')->row();
		
		return $query;
	}
	public function getListNilaiTotalDosen($id_prodi, $id_periode)
	{
		$query = $this->db->query('select id_dosen, dosen.nama, AVG(total_nilai) as nilai, id_prodi from kuesioner_isi
		join dosen on kuesioner_isi.id_dosen = dosen.id
		where dosen.id_prodi = '.$id_prodi.' and id_periode = '.$id_periode.'
		group by id_dosen order by nilai DESC')->result();
		
		return $query;
	}
}
