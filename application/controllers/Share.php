<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Share extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('MShare');
    }

    function Folder($kode = null)
    {
        $data["detail"] = $this->MShare->folderdetail($kode);
        $data["folder"] = $this->MShare->folder($kode);
        $data["file"] = $this->MShare->files($kode);
        $data['kode'] = $kode;
        $data["title"] = "E - Arsip share folder - " . $data["detail"]['nama'];
        $data["content"] = "publik/contents/share-folder";
        $this->load->view("publik/layout/wrapper", $data);
    }

    function File($id = null)
    {
        $data['file'] = $this->MShare->viewfile($id);
        $data["title"] = "E - Arsip share file - " . $data['file']['nama_file_upload'];
        $data["content"] = "publik/contents/share-file";
        $this->load->view("publik/layout/wrapper", $data);
    }

    function Download($kode = null)
    {
        $detail = $this->MShare->folderdetail($kode);
        $folders = $this->MShare->folder($kode);
        $files = $this->MShare->files($kode);
        foreach ($folders as $folder) {
            $this->zip->add_dir($folder->nama);
        }
        foreach ($files as $file) {
            $this->zip->read_file('./upload/' . $file->nama_file, $file->nama_file_upload);
        }
        $this->zip->download($detail['nama']);
    }
}
