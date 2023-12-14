<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('Username'))) {
            redirect('logout');
        }
        $this->load->model('MProsses');
    }

    public function coba()
    {
        $siswa = $this->MProsses->datausers();
        print_r($siswa);
    }

    public function exportexcel()
    {
        print_r($this->input->post());
        return;
        $this->load->model('MProsses');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Kelas');
        $sheet->setCellValue('D1', 'Jenis Kelamin');
        $sheet->setCellValue('E1', 'Alamat');

        $siswa = $this->MProsses->datausers();
        $no = 1;
        $x = 2;
        foreach ($siswa as $row) {
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row->id);
            $sheet->setCellValue('C' . $x, $row->nama);
            $sheet->setCellValue('D' . $x, $row->username);
            $sheet->setCellValue('E' . $x, $row->levelname);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan-user';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function import()
    {
        $this->load->model('MProsses');
        $input = $this->MProsses->importsperpart();
        redirect('Admin/sperpart');
    }

    function cobaarray()
    {
        $getMesin = $this->db->get('vmesin')->result();
        $getAssembly = $this->db->query('select * from mesin where parent in(select mesin_id from vmesin)')->result();
        $getSubAssembly = $this->db->query('select * from mesin where level="3"')->result();
        $data = [];
        $datacoba = [];
        $dataassembly = [];
        $datasubassembly = [];
        $assembly = [];
        // mesin
        foreach ($getMesin as $key => $val) {
            $mesin = array(
                "id_config" => $val->id,
                "id_mesin" => $val->mesin_id,
                "mesin" => $val->nama,
                "versi" => $val->versi,
            );
            // assembly
            foreach ($getAssembly as $key => $val) {
                $assembly = array(
                    "id_asembly" => $val->id,
                    "nama_asembly" => $val->nama,
                    "parent" => $val->parent,
                    "level" => $val->level,
                );



                $kolom = array_column($mesin, 'id_mesin');
                $cari = array_search($val->parent, $kolom);
                while ($cari != NULL) {
                    array_push($mesin[$cari]['assembly'], $assembly);
                    unset($kolom[$cari]);
                }
                array_push($dataassembly, $assembly);

                // sub assembly
                foreach ($getSubAssembly as $key3 => $val3) {
                    $subassembly = array(
                        "id_asembly" => $val3->id,
                        "nama_asembly" => $val3->nama,
                        "parent" => $val3->parent,
                        "level" => $val3->level,
                    );
                    $kolom3 = array_column($dataassembly, 'id_asembly');
                    $cari3 = array_search($val3->parent, $kolom3);
                    array_push($datasubassembly, $subassembly);
                }
            }


            array_push($mesin, $datasubassembly);
            $mesin['assembly'] = $mesin['0'];
            unset($mesin['0']);
        }
        array_push($data, $mesin);
        // return $data;
echo json_encode($data);
        // print_r($data);
    }
}
