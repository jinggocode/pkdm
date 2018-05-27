<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner_detail_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'kuesioner_isi_detail';
        $this->primary_key = 'id';
        $this->protected = array('id');

		parent::__construct();
	}

	public function getJumlahNilai($id_kuesioner_is)
	{
		$this->db->select_sum('nilai');
		$this->db->where('id_kuesioner_isi', $id_kuesioner_is); 
		$query = $this->db->get('kuesioner_isi_detail');

		return $query->row();
	}
}
