<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Log extends CI_Model
{
    function user_log($userid, $kodeins, $userlevel, $tabelid, $tabel, $aksi)
    {
        $data = array(
            'tabel' => $tabel,
            'kode_instansi' => $kodeins,
            'tabel_id' => $tabelid,
            'aksi' => $aksi,
            'userid' => $userid,
            'userlevel' => $userlevel,
            'userip' => whosIP(),
            'useragent' => $_SERVER['HTTP_USER_AGENT']
        );
        $this->db->insert('user_log', $data);
    }

    function Kapasitas($kodeinstansi)
    {
        $get = $this->db->query("select sum(file_size) as size from arsip_file where kode_instansi='$kodeinstansi' and kategori=0 ")->row_array();
        return $get['size'];
    }
}
