<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

 function __construct()
 {
  parent::__construct();
  $this->load->model('m_model');
  $this->load->helper('my_helper');
        if ($this->session->userdata('logged_in')!=true) {
            redirect(base_url().'auth');
        }
 }

 public function index()
 {
  $data['guru'] = $this->m_model->get_data('guru')->num_rows();
  $data['siswa'] = $this->m_model->get_data('siswa')->num_rows();
  $this->load->view('admin/index');
 }

 public function siswa()
 {
  $data['siswa'] = $this->m_model->get_data('siswa')->result();
  $this->load->view('admin/siswa', $data);
 }

 public function guru()
 {
  $data['guru'] = $this->m_model->get_data('guru')->result();
  $this->load->view('admin/guru', $data);
 }
 
 public function tambah_siswa()
 {
  $data['kelas'] = $this->m_model->get_data('kelas')->result();
  $this->load->view('admin/tambah_siswa', $data);
 }

 public function tambah_guru()
 {
  $data['guru'] = $this->m_model->get_data('guru')->result();
  $this->load->view('admin/tambah_guru', $data);
 }

 public function aksi_tambah_siswa()
 {
        $data = [
            'nama_siswa' => $this->input->post('nama'),
            'nisn' => $this->input->post('nisn'),
            'gender' => $this->input->post('gender'),
            'id_kelas' => $this->input->post('kelas'),
        ];
        $this->m_model->tambah_data('siswa', $data);
        redirect(base_url('admin/siswa'));
 }

 public function aksi_tambah_guru()
 {
        $data = [
            'nama_siswa' => $this->input->post('nama'),
            'nisn' => $this->input->post('nisn'),
            'gender' => $this->input->post('gender'),
            'id_kelas' => $this->input->post('kelas'),
        ];
        $this->m_model->tambah_data('guru', $data);
        redirect(base_url('admin/guru'));
 }

 public function update_siswa()
 {
  $data['kelas'] = $this->m_model->get_data('kelas')->result();
  $this->load->view('admin/update_siswa', $data);
 }

 public function update_guru()
 {
  $data['guru'] = $this->m_model->get_data('guru')->result();
  $this->load->view('admin/update_guru', $data);
 }

 public function ubah_siswa($id)
 {
  $data['siswa']=$this->m_model->get_by_id('siswa', 'id_siswa', $id)->result();  
  $data['kelas']=$this->m_model->get_data('kelas')->result();
  $this->load->view('admin/ubah_siswa', $data);  

 }

 public function ubah_guru($id)
 {
  $data['guru']=$this->m_model->get_by_id('guru', 'id_guru', $id)->result();  
  $data['mapel']=$this->m_model->get_data('mapel')->result();
  $this->load->view('admin/ubah_guru', $data);  

 }

 public function aksi_ubah_siswa()
    {
        $data = array (
            'nama_siswa' => $this->input->post('nama'),
            'nisn' => $this->input->post('nisn'),
            'gender' => $this->input->post('gender'),
            'id_kelas' => $this->input->post('kelas'),
        );
        $eksekusi=$this->m_model->ubah_data
        ('siswa', $data, array('id_siswa'=>$this->input->post('id_siswa')));
        if($eksekusi)
        {
            redirect(base_url('admin/siswa'));
        }
        else
        {
            redirect(base_url('admin/ubah_siswa/'.$this->input->post('id_siswa')));
        }
    }

 
 public function aksi_ubah_guru()
    {
        $data = array (
            'nama_guru' => $this->input->post('nama'),
            'nik' => $this->input->post('nik'),
            'gender' => $this->input->post('gender'),
            'id_mapel' => $this->input->post('mapel'),
        );
        $eksekusi=$this->m_model->ubah_data
        ('siswa', $data, array('id_guru'=>$this->input->post('id_guru')));
        if($eksekusi)
        {
            redirect(base_url('admin/guru'));
        }
        else
        {
            redirect(base_url('admin/ubah_guru/'.$this->input->post('id_guru')));
        }
    }

	public function hapus_siswa($id)
    {
        $this->m_model->delete('siswa', 'id_siswa', $id);
        redirect(base_url('admin/siswa'));
    }

 public function hapus_guru($id)
    {
        $this->m_model->delete('guru', 'id_guru', $id);
        redirect(base_url('admin/guru'));
    }

}

?>