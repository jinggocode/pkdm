<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kuesioner_isi_model extends MY_Model
{
	public function __construct()
	{
		$this->table = 'kuesioner_isi';
		$this->primary_key = 'id';
		$this->protected = array('id');

		$this->has_one['periode'] = array('Periode_model', 'id', 'id_periode');
		$this->has_one['pengampu'] = array('Pengampu_model', 'id', 'id_pengampu');
		parent::__construct();
	}
}
