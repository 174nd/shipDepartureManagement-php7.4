<?php
$backurl = '../../';
require_once($backurl . 'admin/config/settings.php');
require_once($backurl . 'plugins/PhpSpreadSheet/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();

$inputFileType = 'Xlsx';
$inputFileName = './laporan.xlsx';
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
$spreadsheet = $reader->load($inputFileName);

$bulan = date('m', strtotime($_POST['bt_laporan']));
$tahun = date('Y', strtotime($_POST['bt_laporan']));
$title = 'Laporan ILL ' . strtoupper(bulan_indo($bulan)) . ' ' . $tahun;
$spreadsheet->getActiveSheet()->setCellValue('A6', 'BULAN : ' . strtoupper(bulan_indo($bulan)) . ' ' . $tahun);


$sql = mysqli_query($conn, "SELECT * FROM ((ci JOIN kapal) JOIN pelabuhan) WHERE ci.kd_kapal=kapal.kd_kapal AND ci.kd_pelabuhan=pelabuhan.kd_pelabuhan AND MONTH(tgl_ci)='$bulan' AND YEAR(tgl_ci)='$tahun' ORDER BY tgl_ci ASC");
$no = 1;
$numrow = 8;
$totaltonkedatangan = 0;
$totaltonkeberangkatan = 0;
$settotaltonkeberangkatan = false;
while ($data = mysqli_fetch_assoc($sql)) {
  $stttrayek = 'T';
  $spreadsheet->getActiveSheet()->setCellValue('A' . $numrow, $no);
  $spreadsheet->getActiveSheet()->setCellValue('B' . $numrow, $data['nm_kapal']);
  $spreadsheet->getActiveSheet()->setCellValue('C' . $numrow, $data['gt_kapal']);
  $spreadsheet->getActiveSheet()->setCellValue('D' . $numrow, tanggal_indo($data['tgl_ci']));
  $spreadsheet->getActiveSheet()->setCellValue('E' . $numrow, $data['nm_pelabuhan']);
  $spreadsheet->getActiveSheet()->setCellValue('F' . $numrow, $data['jns_muatan']);
  $spreadsheet->getActiveSheet()->setCellValue('G' . $numrow, $data['muatan']);
  if ($data['tipe_muatan'] == 'T') $totaltonkedatangan += $data['jns_muatan'];
  if ($data['stt_pelabuhan'] != 'T') $stttrayek = 'L';

  $sql1 = mysqli_query($conn, "SELECT * FROM co JOIN pelabuhan WHERE co.kd_pelabuhan=pelabuhan.kd_pelabuhan AND co.id_ci='$data[id_ci]'");
  if (mysqli_num_rows($sql1) > 0) {
    $data1 = mysqli_fetch_assoc($sql1);
    $spreadsheet->getActiveSheet()->setCellValue('H' . $numrow, tanggal_indo($data1['tgl_co']));
    $spreadsheet->getActiveSheet()->setCellValue('I' . $numrow, $data1['nm_pelabuhan']);
    $spreadsheet->getActiveSheet()->setCellValue('J' . $numrow, $data1['jns_muatan']);
    $spreadsheet->getActiveSheet()->setCellValue('K' . $numrow, $data1['muatan']);
    if ($data1['tipe_muatan'] == 'T') {
      $totaltonkeberangkatan += $data1['jns_muatan'];
      $settotaltonkeberangkatan = true;
    }
    if ($data1['stt_pelabuhan'] != 'T') $stttrayek = 'L';
  }


  $spreadsheet->getActiveSheet()->setCellValue('L' . $numrow, $stttrayek);
  $spreadsheet->getActiveSheet()->setCellValue('M' . $numrow, $data['stt_kapal']);
  $spreadsheet->getActiveSheet()->insertNewRowBefore($numrow + 1, 1);
  $spreadsheet->getActiveSheet()->getRowDimension($numrow)->setRowHeight(-1);
  $no++;
  $numrow++;
}
$spreadsheet->getActiveSheet()->setCellValue('J' . ($numrow + 3), 'SELATPANJANG, ' . strtoupper(tanggal_indo(date('Y-m-d'))));
if (mysqli_num_rows($sql) > 0) {
  $spreadsheet->getActiveSheet()->removeRow($numrow, 1);
  $spreadsheet->getActiveSheet()->setCellValue('F' . $numrow, $totaltonkedatangan . ' TON');
  if ($settotaltonkeberangkatan) {
    $spreadsheet->getActiveSheet()->setCellValue('J' . $numrow, $totaltonkeberangkatan . ' TON');
  }
} else {
}




$spreadsheet->getProperties()->setCreator('AndL')->setLastModifiedBy('AndL')->setTitle($title)->setSubject("Karyawan")->setDescription("Export Data $title")->setKeywords("$title");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $title . '.xlsx"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
