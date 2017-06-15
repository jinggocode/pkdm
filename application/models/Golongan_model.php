<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Golongan_model extends MY_Model
{  
	public function __construct()
	{
        $this->table = 'uang_gedung';
        $this->primary_key = 'id'; 
        // $this->soft_deletes = TRUE;
        $this->protected = array('id');

        // $this->has_one['golongan'] = array('foreign_model'=>'Golongan_model','foreign_table'=>'uang_gedung','foreign_key'=>'id','local_key'=>'gedung_id');

		parent::__construct();
	}  
    // public $rules = array(
    //     'insert' => array(
                
    //             'nim' => array(
    //                     'field'=>'nim',
    //                     'label'=>'NIM Mahasiswa',
    //                     'rules'=>'trim|required'),
    //             'nama' => array(
    //                     'field'=>'nama',
    //                     'label'=>'Nama Mahasiswa',
    //                     'rules'=>'trim|required'),
    //             'username' => array(
    //                     'field'=>'username',
    //                     'label'=>'Username Mahasiswa',
    //                     'rules'=>'trim|required'),
    //             'gender' => array(
    //                     'field'=>'gender',
    //                     'label'=>'Gender Mahasiswa',
    //                     'rules'=>'trim|required'),
    //             'address' => array(
    //                     'field'=>'address',
    //                     'label'=>'address Mahasiswa',
    //                     'rules'=>'trim|required'),
    //     ), 
    // ); 
}
