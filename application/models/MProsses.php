<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MProsses extends CI_Model
{
	var $max_size = 0;

	function __construct()
	{
		parent::__construct();
		$this->load->model('Log');
		$this->max_size = $this->config->item('Max_size');
		if (empty($this->session->userdata('Username'))) {
			redirect('logout');
		}
	}

	//PROFILE//

	function cekuser($user)
	{
		$this->db->select('id, username');
		$this->db->where('username', $user);
		$ChekData = $this->db->get('user');
		return $ChekData->row_array();
	}

	function editprofile()
	{
		$ChekUser = $this->cekuser($this->input->post('username', TRUE));
		if (empty($ChekUser) || $ChekUser['id'] == $this->input->post('userid', TRUE)) {
			if ($this->input->post('password') != '') {
				$data = array(
					'nama' => $this->input->post('nama', TRUE),
					'username' => $this->input->post('username', TRUE),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
				);
			} else {
				$data = array(
					'nama' => $this->input->post('nama', TRUE),
					'username' => $this->input->post('username', TRUE)
				);
			}
			$this->db->where("id", $this->input->post('userid', TRUE));
			$Edit = $this->db->update('user', $data);
			if ($Edit) {
				$this->Log->user_log($this->input->post('userid', TRUE), $this->input->post('userlevel', TRUE), $this->input->post('userid', TRUE), 'user', 'Edit');
				$Result = array('Status' => 'Sukses', 'Notif' => 'Edit berhasil, silahkan login kembali.');
			} else {
				$Result = array('Status' => 'Gagal', 'Notif' => 'Edit gagal.');
			}
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Username sudah digunakan.');
		}
		return $Result;
	}

	//-------//


	//Folder//

	function folder($kode)
	{
		if ($kode == null) {
			$this->db->where('parent', 0);
		} else {
			$this->db->where('parent', decrypt_this($kode));
		}
		$this->db->where('kode_instansi', $this->session->userdata('KodeInstansi'));
		$this->db->where('kategori', 0);
		$this->db->where('status !=', 1);
		$ChekData = $this->db->get('arsip_folder');
		return $ChekData->result();
	}

	function folderdetail($kode)
	{
		$this->db->where('kode_instansi', $this->session->userdata('KodeInstansi'));
		$this->db->where('kategori', 0);
		$this->db->where('status !=', 1);
		$this->db->where('id', decrypt_this($kode));
		$ChekData = $this->db->get('arsip_folder');
		return $ChekData->row_array();
	}

	function tambahfolder()
	{
		$data = array(
			'kode_instansi' => decrypt_this($this->input->post('kodeinstansi', TRUE)),
			'nama' => $this->input->post('nama', TRUE),
			'parent' => decrypt_this($this->input->post('parent', TRUE)),
			'userid' => decrypt_this($this->input->post('userid', TRUE)),
			'level' => decrypt_this($this->input->post('level', TRUE))
		);
		$insert = $this->db->insert('arsip_folder', $data);
		$insert_id = $this->db->insert_id();
		if ($insert) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				$insert_id,
				'arsip_folder',
				'Insert'
			);
			$Result = array('Status' => 'Sukses', 'Id' => encrypt_this($insert_id), 'Notif' => 'Tambah folder berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Tambah folder gagal');
		}
		return $Result;
	}

	function renamefolder()
	{
		$data = array(
			'nama' => $this->input->post('nama', TRUE)
		);
		$insert = $this->db->where('id', decrypt_this($this->input->post('id', TRUE)))->update('arsip_folder', $data);
		if ($insert) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('id', TRUE)),
				'arsip_folder',
				'Rename'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'Rename folder berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Rename folder gagal');
		}
		return $Result;
	}

	function deletesubfolder($kode)
	{
		$getsub = $this->db->where('parent', $kode)->get('arsip_folder')->result();
		if (!empty($getsub)) {
			foreach ($getsub as $sub) {
				$this->db->where('id', $sub->id)->delete('arsip_folder');
				$this->deletefileonsubfolder($sub->id);
				$this->deletesubfolder($sub->id);
			}
		}
	}

	function deletefileonsubfolder($kode)
	{
		$getdata = $this->db->where('id_folder', $kode)->get('arsip_file')->result();
		if (!empty($getdata)) {
			foreach ($getdata as $data) {
				$dir = './upload/' . $data->nama_file;
				unlink("$dir");
			}
			$this->db->where('id_folder', $kode)->delete('arsip_file');
		}
	}

	function deletefolder()
	{
		$Delete = $this->db->where('id', decrypt_this($this->input->post('iddeletefolder')))->delete('arsip_folder');
		if ($Delete) {
			$this->deletesubfolder(decrypt_this($this->input->post('iddeletefolder', TRUE)));
			$this->deletefileonsubfolder(decrypt_this($this->input->post('iddeletefolder', TRUE)));
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('iddeletefolder')),
				'arsip_folder',
				'Hapus'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'Hapus folder berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Hapus folder gagal');
		}
		return $Result;
	}

	function trashfolder()
	{
		$Trash = $this->db->where('id', decrypt_this($this->input->post('idtrashfolder')))->update('arsip_folder', array('status' => 1));
		if ($Trash) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('idtrashfolder')),
				'arsip_folder',
				'Trash'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'Trash folder berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Trash folder gagal');
		}
		return $Result;
	}

	function restorefolder()
	{
		$Trash = $this->db->where('id', decrypt_this($this->input->post('idrestoref')))->update('arsip_folder', array('status' => 0));
		if ($Trash) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('idrestoref')),
				'arsip_folder',
				'Trash'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'Restore folder berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Restore folder gagal');
		}
		return $Result;
	}

	function sharesubfolder($kode, $status)
	{
		$getsub = $this->db->where('parent', $kode)->get('arsip_folder')->result();
		if (!empty($getsub)) {
			foreach ($getsub as $sub) {
				$this->db->where('id', $sub->id)->update('arsip_folder', array('id_share' => $status));
				$this->db->where('id_folder', $sub->id)->update('arsip_file', array('id_share' => $status));
				$this->sharesubfolder($sub->id, 1);
			}
		}
	}

	function sharefileonsubfolder($kode, $status)
	{
		$this->db->where('id_folder', $kode)->update('arsip_file', array('id_share' => $status));
	}

	function sharefolder()
	{
		$Share = $this->db->where('id', decrypt_this($this->input->post('idsharefolder')))->update('arsip_folder', array('id_share' => 1));
		if ($Share) {
			$this->sharesubfolder(decrypt_this($this->input->post('idsharefolder')), 1);
			$this->sharefileonsubfolder(decrypt_this($this->input->post('idsharefolder')), 1);
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('idsharefolder')),
				'arsip_folder',
				'Share'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'Share folder berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Share folder gagal');
		}
		return $Result;
	}

	function unsharefolder()
	{
		$Share = $this->db->where('id', decrypt_this($this->input->post('idunsharefolder')))->update('arsip_folder', array('id_share' => 0));
		if ($Share) {
			$this->sharesubfolder(decrypt_this($this->input->post('idunsharefolder')), 0);
			$this->sharefileonsubfolder(decrypt_this($this->input->post('idunsharefolder')), 0);
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('idunsharefolder')),
				'arsip_folder',
				'UnShare'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'UnShare folder berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'UnShare folder gagal');
		}
		return $Result;
	}

	function addfavoritfolder()
	{
		$Share = $this->db->where('id', decrypt_this($this->input->post('id')))->update('arsip_folder', array('status' => 2));
		if ($Share) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('id')),
				'arsip_folder',
				'AddFavorit'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'Add Favorit berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Add Favorit gagal');
		}
		return $Result;
	}

	function removefavoritfolder()
	{
		$Share = $this->db->where('id', decrypt_this($this->input->post('id')))->update('arsip_folder', array('status' => 0));
		if ($Share) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('id')),
				'arsip_folder',
				'RemFavorit'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'Remove Favorit berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Remove Favorit gagal');
		}
		return $Result;
	}

	function viewtrashfolder($inst)
	{
		$this->db->where('kode_instansi', $inst);
		$this->db->where('status', 1);
		$ChekData = $this->db->get('arsip_folder');
		return $ChekData->result();
	}

	function favoritfolder($kode)
	{
		if ($kode == null) {
			$this->db->where('parent', 0);
		} else {
			$this->db->where('parent', decrypt_this($kode));
		}
		$this->db->where('kode_instansi', $this->session->userdata('KodeInstansi'));
		$this->db->where('kategori', 0);
		$this->db->where('status', 2);
		$ChekData = $this->db->get('arsip_folder');
		return $ChekData->result();
	}

	function favoritfolderdetail($kode)
	{
		$this->db->where('kode_instansi', $this->session->userdata('KodeInstansi'));
		$this->db->where('kategori', 0);
		$this->db->where('status', 2);
		$this->db->where('id', decrypt_this($kode));
		$ChekData = $this->db->get('arsip_folder');
		return $ChekData->row_array();
	}

	//-----//

	// file //

	function kode()
	{
		$date = date('Y-m-d');
		$get = $this->db->query("select kode from arsip_file where date(datecreated)='$date' order by id desc limit 1")->row_array();
		if (empty($get)) {
			$kode = 'A' . date('ymd') . '-0001';
		} else {
			$nomor = substr($get['kode'], strpos($get['kode'], "-") + 1) + 1;
			$kode = 'A' . date('ymd') . "-" . sprintf("%04d", $nomor);
		}
		return $kode;
	}

	function cekkapasitas($kodeinstansi, $sizenow)
	{
		$get = $this->db->query("select sum(file_size) as size from arsip_file where kode_instansi='$kodeinstansi' and kategori=0 ")->row_array();
		if (($get['size'] + $sizenow) >= $this->max_size) {
			$data = 'FULL';
		} else {
			$data = 'NOT';
		}
		return $data;
	}

	function tambahfile()
	{
		$cekkapasitas = $this->cekkapasitas(decrypt_this($this->input->post('kodeinstansi', TRUE)), $_FILES['file']['size']);
		if (decrypt_this($this->input->post('kategori', TRUE)) == 0 and $cekkapasitas == 'FULL') {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Penyimpanan Penuh.');
		} else {
			$config['upload_path']	= './upload/';
			$config['allowed_types'] = 'doc|DOC|docx|DOCX|ppt|PPT|pptx|PPTX|xls|XLS|xlsx|XLSX|pdf|PDF|jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF|mp3|MP3|mp4|MP4';
			$config['max_size']		= '10024';
			$config['overwrite']	= false;
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$Upload = $this->upload->do_upload('file');
			$error = $this->upload->display_errors();
			if ($Upload) {
				$data = array(
					'id_folder' => decrypt_this($this->input->post('kode', TRUE)),
					'kode_instansi' => decrypt_this($this->input->post('kodeinstansi', TRUE)),
					'kode' => $this->kode(),
					'nama' => $this->input->post('nama', TRUE),
					'nomor' => $this->input->post('nomor', TRUE),
					'tanggal' => $this->input->post('tanggal', TRUE),
					'nama_file' => $this->upload->data('file_name'),
					'nama_file_upload' => $_FILES['file']['name'],
					'tipe_file' => $this->upload->data('file_ext'),
					'file_size' => $_FILES['file']['size'],
					'kategori' => decrypt_this($this->input->post('kategori', TRUE)),
					'userid' => decrypt_this($this->input->post('userid', TRUE)),
					'level' => decrypt_this($this->input->post('level', TRUE))
				);
				$insert = $this->db->insert('arsip_file', $data);
				$insert_id = $this->db->insert_id();
				if ($insert) {
					$this->Log->user_log(
						decrypt_this($this->input->post('userid', TRUE)),
						decrypt_this($this->input->post('kodeinstansi', TRUE)),
						decrypt_this($this->input->post('level', TRUE)),
						$insert_id,
						'arsip_file',
						'Insert'
					);
					$Result = array('Status' => 'Sukses', 'Id' => $this->input->post('kode', TRUE), 'Notif' => 'Tambah File berhasil');
				} else {
					$Result = array('Status' => 'Gagal', 'Notif' => 'Tambah file gagal');
				}
			} else {
				$Result = array('Status' => 'Gagal', 'Notif' => $error);
			}
		}
		return $Result;
	}

	function editfile()
	{
		$getfile = $this->viewfile($this->input->post('idhapus'), decrypt_this($this->input->post('kodeinstansi', TRUE)));
		if ($_FILES['file']['name'] != '') {
			$config['upload_path']	= './upload/';
			$config['allowed_types'] = 'doc|DOC|docx|DOCX|ppt|PPT|pptx|PPTX|xls|XLS|xlsx|XLSX|pdf|PDF|jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF|mp3|MP3|mp4|MP4';
			$config['max_size']		= '10024';
			$config['overwrite']	= false;
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$Upload = $this->upload->do_upload('file');
			$error = $this->upload->display_errors();
			if ($Upload) {
				$data = array(
					'id_folder' => decrypt_this($this->input->post('kode', TRUE)),
					'kode_instansi' => decrypt_this($this->input->post('kodeinstansi', TRUE)),
					'nama' => $this->input->post('nama', TRUE),
					'nomor' => $this->input->post('nomor', TRUE),
					'tanggal' => $this->input->post('tanggal', TRUE),
					'nama_file' => $this->upload->data('file_name'),
					'nama_file_upload' => $_FILES['file']['name'],
					'tipe_file' => $this->upload->data('file_ext'),
					'file_size' => $_FILES['file']['size'],
					'kategori' => decrypt_this($this->input->post('kategori', TRUE)),
					'userid' => decrypt_this($this->input->post('userid', TRUE)),
					'level' => decrypt_this($this->input->post('level', TRUE))
				);
				$insert = $this->db->where('id', decrypt_this($this->input->post('id', TRUE)))->update('arsip_file', $data);
				if ($insert) {
					$this->Log->user_log(
						decrypt_this($this->input->post('userid', TRUE)),
						decrypt_this($this->input->post('kodeinstansi', TRUE)),
						decrypt_this($this->input->post('level', TRUE)),
						decrypt_this($this->input->post('id', TRUE)),
						'arsip_file',
						'Edit'
					);
					if (!empty($getfile['nama_file'])) {
						$Filedir = './upload/' . $getfile['nama_file'];
						unlink("$Filedir");
					}
					$Result = array('Status' => 'Sukses', 'Id' => $this->input->post('kode', TRUE), 'Notif' => 'Edit File upload berhasil');
				} else {
					$Result = array('Status' => 'Gagal', 'Notif' => 'Edit file gagal');
				}
			} else {
				$Result = array('Status' => 'Gagal', 'Notif' => $error);
			}
		} else {
			$data = array(
				'id_folder' => decrypt_this($this->input->post('kode', TRUE)),
				'kode_instansi' => decrypt_this($this->input->post('kodeinstansi', TRUE)),
				'nama' => $this->input->post('nama', TRUE),
				'nomor' => $this->input->post('nomor', TRUE),
				'tanggal' => $this->input->post('tanggal', TRUE),
				'kategori' => decrypt_this($this->input->post('kategori', TRUE)),
				'userid' => decrypt_this($this->input->post('userid', TRUE)),
				'level' => decrypt_this($this->input->post('level', TRUE))
			);
			$insert = $this->db->where('id', decrypt_this($this->input->post('id', TRUE)))->update('arsip_file', $data);
			if ($insert) {
				$this->Log->user_log(
					decrypt_this($this->input->post('userid', TRUE)),
					decrypt_this($this->input->post('kodeinstansi', TRUE)),
					decrypt_this($this->input->post('level', TRUE)),
					decrypt_this($this->input->post('id', TRUE)),
					'arsip_file',
					'Edit'
				);
				$Result = array('Status' => 'Sukses', 'Id' => $this->input->post('kode', TRUE), 'Notif' => 'Edit File berhasil');
			} else {
				$Result = array('Status' => 'Gagal', 'Notif' => 'Edit file gagal');
			}
		}
		return $Result;
	}

	function files($kode)
	{
		if ($kode == null) {
			$this->db->where('id_folder', 0);
		} else {
			$this->db->where('id_folder', decrypt_this($kode));
		}
		$this->db->where('kode_instansi', $this->session->userdata('KodeInstansi'));
		$this->db->where('kategori', 0);
		$this->db->where('status !=', 1);
		$ChekData = $this->db->get('arsip_file');
		return $ChekData->result();
	}

	function viewfile($id, $inst)
	{
		$this->db->where('kode_instansi', $inst);
		$this->db->where('id', decrypt_this($id));
		$ChekData = $this->db->get('arsip_file');
		return $ChekData->row_array();
	}

	function deletefile()
	{
		$getfile = $this->viewfile($this->input->post('idhapus'), decrypt_this($this->input->post('kodeinstansi', TRUE)));
		$Delete = $this->db->where('id', decrypt_this($this->input->post('idhapus')))->delete('arsip_file');
		if ($Delete) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('idhapus')),
				'arsip_file',
				'Hapus'
			);
			if (!empty($getfile['nama_file'])) {
				$file = $getfile['nama_file'];
				$Filedir = './upload/' . $file;
				unlink("$Filedir");
			}

			$Result = array('Status' => 'Sukses', 'Notif' => 'Hapus file berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Hapus file gagal');
		}

		return $Result;
	}

	function trashfile()
	{
		$Trash = $this->db->where('id', decrypt_this($this->input->post('idtrash')))->update('arsip_file', array('status' => 1));
		if ($Trash) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('idtrash')),
				'arsip_file',
				'Trash'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'Trash file berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Trash file gagal');
		}
		return $Result;
	}

	function restorefile()
	{
		$Trash = $this->db->where('id', decrypt_this($this->input->post('idrestorefile')))->update('arsip_file', array('status' => 0));
		if ($Trash) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('idrestorefile')),
				'arsip_file',
				'Restore'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'Restore file berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Restore file gagal');
		}
		return $Result;
	}

	function viewtrashfile($inst)
	{
		$this->db->where('kode_instansi', $inst);
		$this->db->where('status', 1);
		$ChekData = $this->db->get('arsip_file');
		return $ChekData->result();
	}

	function sharefile()
	{
		$Share = $this->db->where('id', decrypt_this($this->input->post('idsharefile')))->update('arsip_file', array('id_share' => 1));
		if ($Share) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('idsharefile')),
				'arsip_file',
				'Share'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'Share file berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Share file gagal');
		}
		return $Result;
	}

	function unsharefile()
	{
		$Share = $this->db->where('id', decrypt_this($this->input->post('idunsharefile')))->update('arsip_file', array('id_share' => 0));
		if ($Share) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('idunsharefile')),
				'arsip_file',
				'UnShare'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'UnShare file berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'UnShare file gagal');
		}
		return $Result;
	}

	function addfavoritfile()
	{
		$Share = $this->db->where('id', decrypt_this($this->input->post('id')))->update('arsip_file', array('status' => 2));
		if ($Share) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('id')),
				'arsip_file',
				'AddFavorit'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'Add Favorit berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Add Favorit gagal');
		}
		return $Result;
	}

	function removefavoritfile()
	{
		$Share = $this->db->where('id', decrypt_this($this->input->post('id')))->update('arsip_file', array('status' => 0));
		if ($Share) {
			$this->Log->user_log(
				decrypt_this($this->input->post('userid', TRUE)),
				decrypt_this($this->input->post('kodeinstansi', TRUE)),
				decrypt_this($this->input->post('userlevel', TRUE)),
				decrypt_this($this->input->post('id')),
				'arsip_file',
				'RemFavorit'
			);
			$Result = array('Status' => 'Sukses', 'Notif' => 'Remove Favorit berhasil');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Remove Favorit gagal');
		}
		return $Result;
	}

	//----//

	//Desa Kelurahan//

	function desa($instansi)
	{
		$this->db->select('kode_desa, nama_desa');
		$this->db->where('kode_kecamatan', $instansi);
		$ChekData = $this->db->get('data_desa');
		return $ChekData->result();
	}

	function arsipdesa($desa, $kode)
	{
		if ($kode == null) {
			$this->db->where('parent', 0);
		} else {
			$this->db->where('parent', decrypt_this($kode));
		}
		$this->db->where('kode_instansi', 0);
		$this->db->where('kategori', 1);
		$this->db->where('status', 0);
		$ChekData = $this->db->get('arsip_folder');
		return $ChekData->result();
	}

	function namadesa($desa)
	{
		$this->db->where('kode_desa', $desa);
		$ChekData = $this->db->get('data_desa');
		return $ChekData->row_array();
	}

	function folderdetaildesa($desa, $kode)
	{
		$this->db->where('kode_instansi', 0);
		$this->db->where('kategori', 1);
		$this->db->where('id', decrypt_this($kode));
		$ChekData = $this->db->get('arsip_folder');
		return $ChekData->row_array();
	}

	function filesdesa($desa, $kode)
	{
		$this->db->where('id_folder', decrypt_this($kode));
		$this->db->where('kode_instansi', $desa);
		$this->db->where('kategori', 1);
		$this->db->where('status', 0);
		$ChekData = $this->db->get('arsip_file');
		return $ChekData->result();
	}

	function filesdesabyid($des, $kode)
	{
		$this->db->where('id', decrypt_this($kode));
		$this->db->where('kode_instansi', $des);
		$this->db->where('kategori', 1);
		$this->db->where('status', 0);
		$ChekData = $this->db->get('arsip_file');
		return $ChekData->row_array();
	}

	///kecamatan

	function datakecamatan($kode)
	{
		if ($kode == null) {
			$this->db->where('parent', 0);
		} else {
			$this->db->where('parent', decrypt_this($kode));
		}
		$this->db->where('kode_instansi', 0);
		$this->db->where('kategori', 3);
		$ChekData = $this->db->get('arsip_folder');
		return $ChekData->result();
	}

	function folderdetailkecamatan($kode)
	{
		$this->db->where('kode_instansi', 0);
		$this->db->where('kategori', 3);
		$this->db->where('id', decrypt_this($kode));
		$ChekData = $this->db->get('arsip_folder');
		return $ChekData->row_array();
	}

	function folderdetailkecamatanbyidparentfile($kode)
	{
		$this->db->select("a.id, a.id_folder, b.nama");
		$this->db->join('arsip_folder b', 'b.id=a.id_folder');
		$this->db->where('a.kategori', 3);
		$this->db->where('a.id', decrypt_this($kode));
		$ChekData = $this->db->get('arsip_file a');
		return $ChekData->row_array();
	}

	function fileskecamatan($kec, $kode)
	{
		$this->db->where('id_folder', decrypt_this($kode));
		$this->db->where('kode_instansi', $kec);
		$this->db->where('kategori', 3);
		$this->db->where('status', 0);
		$ChekData = $this->db->get('arsip_file');
		return $ChekData->result();
	}

	function fileskecamatanbyid($kec, $kode)
	{
		$this->db->where('id', decrypt_this($kode));
		$this->db->where('kode_instansi', $kec);
		$this->db->where('kategori', 3);
		$this->db->where('status', 0);
		$ChekData = $this->db->get('arsip_file');
		return $ChekData->row_array();
	}

	//-USER-//

	function leveluser()
	{
		$ChekData = $this->db->get('userlevel');
		return $ChekData->result();
	}

	function datausers()
	{
		$this->db->select("a.id, a.nama, a.username, a.aktif, a.level, b.nama as levelname");
		$this->db->join('userlevel b', 'b.id=a.level');
		$this->db->where('level !=', 0);
		$ChekData = $this->db->get('users a');
		return $ChekData->result();
	}

	function datausersbyid($id)
	{
		$this->db->select("a.id, a.nama, a.username, a.aktif, a.level, b.nama as levelname");
		$this->db->join('userlevel b', 'b.id=a.level');
		$this->db->where('a.id', $id);
		$ChekData = $this->db->get('users a');
		return $ChekData->row_array();
	}

	function inputuser()
	{
		$ChekUser = $this->cekuser($this->input->post('username', TRUE));
		if (empty($ChekUser)) {
			$data = array(
				'nama' => $this->input->post('nama', TRUE),
				'username' => $this->input->post('username', TRUE),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'level' => $this->input->post('level', TRUE)
			);
			$Input = $this->db->insert('user', $data);
			if ($Input) {
				$this->Log->user_log($this->input->post('userid', TRUE), 'Input', 'user');
				$Result = array('Status' => 'Sukses', 'Notif' => 'Input berhasil.');
			} else {
				$Result = array('Status' => 'Gagal', 'Notif' => 'Input gagal.');
			}
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Username sudah digunakan.');
		}
		return $Result;
	}

	function edituser()
	{
		$ChekUser = $this->cekuser($this->input->post('username'));
		if (empty($ChekUser) || $ChekUser['id'] == $this->input->post('id', TRUE)) {
			if ($this->input->post('password') != '') {
				$data = array(
					'nama' => $this->input->post('nama', TRUE),
					'username' => $this->input->post('username', TRUE),
					'level' => $this->input->post('level', TRUE),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
				);
			} else {
				$data = array(
					'nama' => $this->input->post('nama', TRUE),
					'level' => $this->input->post('level', TRUE),
					'username' => $this->input->post('username', TRUE)
				);
			}
			$this->db->where("id", $this->input->post('id', TRUE));
			$Edit = $this->db->update('user', $data);

			if ($Edit) {
				$this->Log->user_log($this->input->post('userid', TRUE), 'Edit', 'user');
				$Result = array('Status' => 'Sukses', 'Notif' => 'Edit berhasil.');
			} else {
				$Result = array('Status' => 'Gagal', 'Notif' => 'Edit gagal.');
			}
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Username sudah digunakan.');
		}
		return $Result;
	}

	function deleteuser()
	{
		$this->db->where("id", $this->input->post('id', TRUE));
		$Delete = $this->db->delete('user');
		if ($Delete) {
			$this->Log->user_log($this->input->post('userid'), 'Delete', 'user');
			$Result = array('Status' => 'Sukses', 'Notif' => 'Delete berhasil.');
		} else {
			$Result = array('Status' => 'Gagal', 'Notif' => 'Delete gagal.');
		}
		return $Result;
	}
}
