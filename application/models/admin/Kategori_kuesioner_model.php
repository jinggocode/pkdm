<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_kuesioner_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'kuesioner_kategori';
        $this->primary_key = 'id';
        $this->protected = array('id');

		parent::__construct();
	}
}
