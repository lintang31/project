<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_model');
		$this->load->helper('my_helper');
		if ($this->session->userdata('logged_in') != true) {
			redirect(base_url() . 'auth');
		}
	}

         // REGISTER
	  	  public function register()
	  {
		  $this->load->view('auth/register');
	  }
  
	  public function aksi_register()
	  {
		  $email = $this->input->post('email', true);
		  $username = $this->input->post('username', true);
		  $password = md5($this->input->post('password', true));
  
		  $data = [
			  'email' => $email,
			  'username' => $username,
			  'password' => $password,
			  'role' => 'admin',
		  ];
  
		  $table = 'admin';
  
		  $this->db->insert($table, $data);
  
		  if ($this->db->affected_rows() > 0) {
			  // Registrasi berhasil
			  $this->session->set_userdata([
				  'logged_in' => TRUE,
				  'email' => $email,
				  'username' => $username,
				  'role' => 'admin'
			  ]);
			  // SweetAlert untuk Registrasi Berhasil
			  $this->session->set_flashdata('success', 'Registrasi berhasil!');
			  redirect(base_url() . "admin");
		  } else {
			  // Registrasi gagal
			  redirect(base_url() . "auth/register");
		  }
	  }
  

	// admin
	public function index()
	{
		$data['mapel'] = $this->m_model->get_data('mapel')->num_rows();
		$data['siswa'] = $this->m_model->get_data('siswa')->num_rows();
		$data['guru'] = $this->m_model->get_data('guru')->num_rows();
		$data['kelas'] = $this->m_model->get_data('kelas')->num_rows();
		$this->load->view('admin/index', $data);
	}
	// siswa 
	public function siswa()
	{
		$data['siswa'] = $this->m_model->get_data('siswa')->result();
		$this->load->view('admin/siswa', $data);
	}
	// tambah siswa
	public function tambah_siswa()
	{
		$data['kelas'] = $this->m_model->get_data('kelas')->result();
		$this->load->view('admin/tambah_siswa', $data);
	}
	// ubah siswa
	public function ubah_siswa($id)
	{
		$data['siswa'] = $this->m_model->get_by_id('siswa', 'id_siswa', $id)->result();
		$data['kelas'] = $this->m_model->get_data('kelas')->result();
		$this->load->view('admin/ubah_siswa', $data);
	}
	// aksi ubah siswa
	public function aksi_ubah_siswa()
	{
		$data = array(
			'nama_siswa' => $this->input->post('nama'),
			'nisn' => $this->input->post('nisn'),
			'gender' => $this->input->post('gender'),
			'id_kelas' => $this->input->post('kelas'),
		);
		$eksekusi = $this->m_model->ubah_data
		('siswa', $data, array('id_siswa' => $this->input->post('id_siswa')));
		if ($eksekusi) {
			$this->session->set_flashdata('success', 'Berhasil mengubah siswa!');;
			redirect(base_url('admin/siswa'));
		} else {
			$this->session->set_flashdata('error', 'gagal..');
			redirect(base_url('admin/ubah_siswa/' . $this->input - post('id_siswa')));
		}
	}
	// aksi tambah siswa
	public function aksi_tambah_siswa()
	{
		$data = [
			'nama_siswa' => $this->input->post('nama'),
			'nisn' => $this->input->post('nisn'),
			'gender' => $this->input->post('gender'),
			'id_kelas' => $this->input->post('kelas'),
		];

		$this->m_model->tambah_data('siswa', $data);
		// SweetAlert untuk berhasil menambahkan siswa
		$this->session->set_flashdata('success', 'Berhasil menambahkan siswa!');
		redirect(base_url('admin/siswa'));
	}
	// hapus siswa
	public function hapus_siswa($id)
	{
		$this->m_model->delete('siswa', 'id_siswa', $id);
		// SweetAlert untuk berhasil mengahapus siswa
		$this->session->set_flashdata('success', 'Siswa berhasil dihapus!');
		redirect(base_url('admin/siswa'));
	}





	// guru
	public function guru()
	{
		$data['guru'] = $this->m_model->get_data('guru')->result();
		$this->load->view('admin/guru', $data);
	}
	// tambah guru
	public function tambah_guru()
	{
		$data['mapel'] = $this->m_model->get_data('mapel')->result();
		$this->load->view('admin/tambah_guru', $data);
	}
	// ubah guru
	public function ubah_guru($id)
	{
		$data['guru'] = $this->m_model->get_by_id('guru', 'id_guru', $id)->result();
		$data['mapel'] = $this->m_model->get_data('mapel')->result();
		$this->load->view('admin/ubah_guru', $data);
	}
	
	// aksi ubah guru
	public function aksi_ubah_guru()
	{
		$data = array(
			'nama_guru' => $this->input->post('nama'),
			'nik' => $this->input->post('nik'),
			'gender' => $this->input->post('gender'),
			'id_mapel' => $this->input->post('mapel'),
		);
		$eksekusi = $this->m_model->ubah_data
		('guru', $data, array('id_guru' => $this->input->post('id_guru')));
		if ($eksekusi) {
			$this->session->set_flashdata('success', 'Berhasil mengubah guru!');;
			redirect(base_url('admin/guru'));
		} else {
			$this->session->set_flashdata('error', 'gagal..');
			redirect(base_url('admin/ubah_guru/' . $this->input - post('id_guru')));
		}
	}

	// aksi tambah guru
	public function aksi_tambah_guru()
	{
		$data = [
			'nama_guru' => $this->input->post('nama'),
			'nik' => $this->input->post('nik'),
			'gender' => $this->input->post('gender'),
			'id_mapel' => $this->input->post('mapel'),
		];

		$this->m_model->tambah_data('guru', $data);
		// SweetAlert untuk berhasil menambahkan guru
		$this->session->set_flashdata('success', 'Berhasil menambahkan guru!');
		redirect(base_url('admin/guru'));
	}



	// hapus guru
	public function hapus_guru($id)
	{
		$this->m_model->delete('guru', 'id_guru', $id);
		// SweetAlert untuk berhasil mengahapus guru
		$this->session->set_flashdata('success', 'Guru berhasil dihapus!');
		redirect(base_url('admin/guru'));
	}
}
?>