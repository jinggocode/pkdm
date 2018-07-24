<?php
 
// METHOD GET
// contoh pemanggilan 
// http://localhost/pkdm/cek?tahun=2018&semester=1&nim=361555401033

class Cek extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->_accessable = true;
        $this->load->helper(array('dump'));
        $this->load->model(array('admin/mahasiswa_model', 'admin/kuesioner_isi_model', 'admin/periode_model', 'admin/prodi_model', 'admin/kelas_model', 'admin/angkatan_model'));
    }

    public function index()
    { 
        $nim = $this->input->get('nim');
        $semester = $this->input->get('semester');
        $tahun = $this->input->get('tahun');

        // MELIHAT DATA MAHASISWA
        $mahasiswa = $this->mahasiswa_model
            ->where('nim', $nim)
            ->with_angkatan()
            ->get(); 

        if ($mahasiswa == false) { 
            $response['status'] = NULL;
            $response['pesan'] = 'Mahasiswa tidak ditemukan';
        } else { 
            // MELIHAT PERIODE SEKARANG
            $periode = $this->periode_model
                ->where('semester', $semester)
                ->where('tahun', $tahun) 
                ->get();   
            $cek_status_pengisian = $this->kuesioner_isi_model
                ->where('id_periode', $periode->id)
                ->where('id_mahasiswa', $mahasiswa->id)
                ->where('status_selesai', '1')
                ->count_rows(); 
 
            if ($cek_status_pengisian != 0) {  
                $response['status'] = 1;
                $response['pesan'] = 'Sudah mengisi Kuesioner';
            } else { 
                $response['status'] = 0;
                $response['pesan'] = 'Belum mengisi Kuesioner';
            }  
        }
        echo json_encode($response);
    } 
}