<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('Username'))) {
			redirect('logout');
		}
		$this->load->model('MProsses');
	}

	function Index()
	{
		$data["folder"] = $this->MProsses->folder($kode = null);
		$data["file"] = $this->MProsses->files($kode = null);
		$data["title"] = "E - Arsip - Dashbaord";
		$data["page"] = "index";
		$data["content"] = "admin/contents/index";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function Index2()
	{
		$data["title"] = "E - Arsip - Dashbaord";
		$data["page"] = "index";
		$data["content"] = "admin/contents/index2";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function Profile()
	{
		$data["title"] = "E - Arsip - Profile";
		$data["page"] = "profile";
		$data["content"] = "admin/contents/profile";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function EditProfile()
	{
		$data["title"] = "E - Arsip - Edit Profile";
		$data["page"] = "profile";
		$data["content"] = "admin/contents/profile-edit";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function Users()
	{
		$data["data"] = $this->MProsses->datausers();
		$data["page"] = "user";
		$data["title"] = "E - Arsip - Users";
		$data["content"] = "admin/contents/user";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function TambahUser()
	{
		$data["level"] = $this->MProsses->leveluser();
		$data["page"] = "user";
		$data["title"] = "E - Arsip - Tambah User";
		$data["content"] = "admin/contents/user-input";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function EditUser($id = null)
	{
		$data["level"] = $this->MProsses->leveluser();
		$data["data"] = $this->MProsses->datausersbyid($id);
		$data["page"] = "user";
		$data["title"] = "E - Arsip - Edit User";
		$data["content"] = "admin/contents/user-edit";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function TambahFolder($kode = null)
	{
		$data['kode'] = $kode;
		$data["page"] = "index";
		$data["title"] = "E - Arsip - Tambah Folder";
		$data["content"] = "admin/contents/folder-input";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function Folder($kode = null)
	{
		$data["detail"] = $this->MProsses->folderdetail($kode);
		$data["folder"] = $this->MProsses->folder($kode);
		$data["file"] = $this->MProsses->files($kode);
		$data['kode'] = $kode;
		$data["page"] = "index";
		$data["title"] = "E - Arsip - Folder";
		$data["content"] = "admin/contents/folder";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function TambahFile($kode = null)
	{
		$data['kode'] = $kode;
		$data["page"] = "index";
		$data["title"] = "E - Arsip - Tambah File";
		$data["content"] = "admin/contents/files-input";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function Viewfile($id = null)
	{
		$inst = $this->session->userdata('KodeInstansi');
		$data['file'] = $this->MProsses->viewfile($id, $inst);
		$data["page"] = "index";
		$data["title"] = "E - Arsip - " . $data['file']['nama_file_upload'];
		$data["content"] = "admin/contents/file";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function Share()
	{
		$data["page"] = "share";
		$data["title"] = "E - Arsip - Share";
		$data["content"] = "admin/contents/share";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function Favorit($kode = null)
	{
		$data['folder'] = $this->MProsses->favoritfolder($kode);
		$data['detail'] = $this->MProsses->favoritfolderdetail($kode);
		$data["page"] = "favorit";
		$data["title"] = "E - Arsip - Favorit";
		$data["content"] = "admin/contents/favorit";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function Sampah()
	{
		$instansi = $this->session->userdata('KodeInstansi');
		$data['trashfolder'] = $this->MProsses->viewtrashfolder($instansi);
		$data['trashfile'] = $this->MProsses->viewtrashfile($instansi);
		$data["page"] = "sampah";
		$data["title"] = "E - Arsip - Sampah";
		$data["content"] = "admin/contents/sampah";
		$this->load->view("admin/layout/wrapper", $data);
	}

	//desa //

	function Desa()
	{
		$instansi = $this->session->userdata('KodeInstansi');
		$data['folder'] = $this->MProsses->desa($instansi);
		$data["page"] = "desa";
		$data["title"] = "E - Arsip - Desa";
		$data["content"] = "admin/contents/desa";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function ArsipDesa($desa = null, $kode = null)
	{
		$data['folder'] = $this->MProsses->arsipdesa($desa, $kode);
		$data['detail'] = $this->MProsses->folderdetaildesa($desa, $kode);
		$data['file'] = $this->MProsses->filesdesa($desa, $kode);
		$data['desa'] = $this->MProsses->namadesa($desa);
		$data["des"] = $desa;
		$data["page"] = "desa";
		$data["title"] = "E - Arsip - Desa Kelurahan";
		$data["content"] = "admin/contents/arsipdesa";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function TambahArsipDesa($kode = null)
	{
		$data['detail'] = $this->MProsses->folderdetaildesa($desa = null, $kode);
		$data["page"] = "desa";
		$data["title"] = "E - Arsip - Tambah Arsip Desa";
		$data["content"] = "admin/contents/arsipdesa-input";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function EditArsipDesa($jenis = null, $desa = null, $kode = null)
	{
		$data['file'] = $this->MProsses->filesdesabyid($desa, $kode);
		$data["page"] = "desa";
		$data["title"] = "E - Arsip - Tambah Arsip Desa";
		$data["content"] = "admin/contents/arsipdesa-edit";
		$this->load->view("admin/layout/wrapper", $data);
	}

	///end desa///

	/// kecamatan///

	function Kecamatan()
	{
		$data['folder'] = $this->MProsses->datakecamatan($kode = null);
		$data["page"] = "kecamatan";
		$data["title"] = "E - Arsip - Kecamatan";
		$data["content"] = "admin/contents/kecamatan";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function BagianKecamatan($instansi = null,  $kode = null)
	{
		$data['folder'] = $this->MProsses->datakecamatan($kode);
		$data['detail'] = $this->MProsses->folderdetailkecamatan($kode);
		$data['file'] = $this->MProsses->fileskecamatan($instansi, $kode);
		$data["page"] = "kecamatan";
		$data["title"] = "E - Arsip - Kecamatan";
		$data["content"] = "admin/contents/bagiankecamatan";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function ArsipKecamatan($instansi = null, $bagian = null,  $kode = null)
	{
		$data['folder'] = $this->MProsses->datakecamatan($kode);
		$data['detail'] = $this->MProsses->folderdetailkecamatan($kode);
		$data['file'] = $this->MProsses->fileskecamatan($instansi, $kode);
		$data["bagian"] = $bagian;
		$data["page"] = "kecamatan";
		$data["title"] = "E - Arsip - Kecamatan";
		$data["content"] = "admin/contents/arsipkecamatan";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function TambahArsipkecamatan($bagian = null, $kode = null)
	{
		$data['detail'] = $this->MProsses->folderdetailkecamatan($kode);
		$data["bagian"] = $bagian;
		$data["page"] = "desa";
		$data["title"] = "E - Arsip - Tambah Arsip Kecamatan";
		$data["content"] = "admin/contents/arsipkecamatan-input";
		$this->load->view("admin/layout/wrapper", $data);
	}

	function EditArsipkecamatan($bagian = null, $id = null)
	{
		$instansi = $this->session->userdata('KodeInstansi');
		$data['detail'] = $this->MProsses->folderdetailkecamatanbyidparentfile($id);
		$data['file'] = $this->MProsses->fileskecamatanbyid($instansi, $id);
		$data["bagian"] = $bagian;
		$data["page"] = "desa";
		$data["title"] = "E - Arsip - Edit Arsip Kecamatan";
		$data["content"] = "admin/contents/arsipkecamatan-edit";
		$this->load->view("admin/layout/wrapper", $data);
	}

	//// end kecamatan ///
}
