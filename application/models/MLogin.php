<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MLogin extends CI_Model
{

	function VerifyUsername($nama)
	{
		$this->db->select("a.id, a.nama, a.kelamin, a.instansi, a.kode_instansi, a.alamat, a.hp, a.pos, a.email, a.username, a.password, a.status, a.level, b.nama as namalevel");
		$this->db->where('a.username', $nama);
		$this->db->join('user_level b', 'a.level=b.id', 'LEFT');
		$ChekData = $this->db->get('user a');
		return $ChekData->row_array();
	}

	function VerifyLogin()
	{
		$ChekData = $this->VerifyUsername($this->input->post('username'));
		if (empty($ChekData)) {
			$Result = array(
				'Status' => 'Gagal',
				'Notif' => 'Username tidak ditemukan.'
			);
		} else if ($ChekData['status'] == 2) {
			$Result = array(
				'Status' => 'Gagal',
				'Notif' => 'Akun anda dinonaktifkan'
			);
		} else if (password_verify($this->input->post('password'), $ChekData['password'])) {
			$sess['IdUser']		= $ChekData['id'];
			$sess['NamaUser']	= $ChekData['nama'];
			$sess['Kelamin']	= $ChekData['kelamin'];
			$sess['Instansi']	= $ChekData['instansi'];
			$sess['KodeInstansi'] = $ChekData['kode_instansi'];
			$sess['Username'] 	= $ChekData['username'];
			$sess['Level']	  	= $ChekData['level'];
			$sess['LevelName']	= $ChekData['namalevel'];
			$Result = array(
				'Status' => 'Sukses',
				'Notif' => 'Login berhasil',
				'Data' 	=> $sess
			);
		} else {
			$Result = array(
				'Status' => 'Gagal',
				'Notif' => 'Password salah'
			);
		}
		return $Result;
	}

	function FromDokar()
	{
		$post = [
			'uid' 	=> $this->input->post('uid'),
			'key' 	=> $this->input->post('key')
		];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://demo.desa.com/webservice/api/Login_earsip/Verify');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		$GetData = json_decode(curl_exec($ch));
		return $GetData;
	}
}
