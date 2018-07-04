<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Dosen_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'dosen';
        $this->primary_key = 'id';
        $this->protected = array('id');

        $this->has_one['prodi'] = array('Prodi_model', 'id', 'id_prodi');

        parent::__construct();
    }

    public function search($search_data)
    {
        $start = $this->uri->segment(5, 0);
        $config['base_url'] = base_url() . 'admin/dosen/search/';
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

        if ($search_data['filter'] == "") {
            $data = $this->dosen_model
                ->with_prodi()
                ->limit($config['per_page'], $offset = $start)
                ->order_by($sort_by, $sort_with)
                ->get_all();
            $config['total_rows'] = $this->dosen_model
                ->count_rows();
        } else {
            $data = $this->dosen_model
                ->with_prodi()
                ->limit($config['per_page'], $offset = $start)
                ->where($search_data['filter'], 'like', $search_data['keyword'])
                ->order_by($sort_by, $sort_with)
                ->get_all();
            $config['total_rows'] = $this->dosen_model
                ->where($search_data['filter'], 'like', $search_data['keyword'])
                ->count_rows(); 
        }
  
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
