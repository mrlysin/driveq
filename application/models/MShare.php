<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MShare extends CI_Model
{

    function folder($kode)
    {
        if ($kode == null) {
            $this->db->where('parent', 0);
        } else {
            $this->db->where('parent', decrypt_this($kode));
        }
        $this->db->where('id_share', 1);
        $this->db->where('kategori', 0);
        $this->db->where('status !=', 1);
        $ChekData = $this->db->get('arsip_folder');
        return $ChekData->result();
    }

    function folderdetail($kode)
    {
        $this->db->where('id_share', 1);
        $this->db->where('kategori', 0);
        $this->db->where('status !=', 1);
        $this->db->where('id', decrypt_this($kode));
        $ChekData = $this->db->get('arsip_folder');
        return $ChekData->row_array();
    }

    function files($kode)
    {
        $this->db->where('id_folder', decrypt_this($kode));
        $this->db->where('id_share', 1);
        $this->db->where('kategori', 0);
        $this->db->where('status !=', 1);
        $ChekData = $this->db->get('arsip_file');
        return $ChekData->result();
    }

    function viewfile($id)
    {
        $this->db->where('id_share', 1);
        $this->db->where('kategori', 0);
        $this->db->where('status !=', 1);
        $this->db->where('id', decrypt_this($id));
        $ChekData = $this->db->get('arsip_file');
        return $ChekData->row_array();
    }
}
