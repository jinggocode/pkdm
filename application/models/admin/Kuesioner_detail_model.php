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
}
