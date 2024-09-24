<?php

require 'vendor/autoload.php';
require 'config/app.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

$activeWorksheet->setCellValue('A2', value: 'No');
$activeWorksheet->getColumnDimension('A')->setAutoSize(true);
$activeWorksheet->setCellValue('B2', 'Title');
$activeWorksheet->getColumnDimension('B')->setAutoSize(true);
$activeWorksheet->setCellValue('C2', 'Slug');
$activeWorksheet->getColumnDimension('C')->setAutoSize(true);
$activeWorksheet->setCellValue('D2', value: 'Description');
$activeWorksheet->getColumnDimension('D')->setAutoSize(true);
$activeWorksheet->setCellValue('E2', value: 'Studio');
$activeWorksheet->getColumnDimension('E')->setAutoSize(true);
$activeWorksheet->setCellValue('F2', 'Created At');
$activeWorksheet->getColumnDimension('F')->setAutoSize(true);
$activeWorksheet->setCellValue('G2', value: 'Release Date');
$activeWorksheet->getColumnDimension('G')->setAutoSize(true);
$activeWorksheet->setCellValue('H2', value: 'Private');
$activeWorksheet->getColumnDimension('H')->setAutoSize(true);
$activeWorksheet->setCellValue('I2', value: 'Url');
$activeWorksheet->getColumnDimension('I')->setAutoSize(true);

$styleColumn = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            
        ],
    ],
];

$no = 1;
$loc = 3;

$films = query("SELECT * FROM films ORDER BY created_at DESC");

foreach ($films as $film) {
    $activeWorksheet->setCellValue('A' . $loc, $no++);
    $activeWorksheet->setCellValue('B' . $loc, $film['title']);
    $activeWorksheet->setCellValue('C' . $loc, $film['slug']);
    $activeWorksheet->setCellValue('D' . $loc, $film['description']);
    $activeWorksheet->setCellValue('E' . $loc, $film['studio']);
    $activeWorksheet->setCellValue('F' . $loc, $film['created_at']);
    $activeWorksheet->setCellValue('G' . $loc, $film['release_date']);
    $activeWorksheet->setCellValue('H' . $loc, $film['is_private'] === '0' ? 'Public' : 'Private');
    $activeWorksheet->setCellValue('I' . $loc, $film['url']);

    $loc++;
}

$activeWorksheet->getStyle('A2:I' . ($loc - 1))->applyFromArray($styleColumn);

$writer = new Xlsx($spreadsheet);
$file_name = 'films List.xlsx';
$writer->save($file_name);

//ganti proses download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length:' .filesize($file_name) );
header('Content-Disposition: attachment; filename="' .$file_name.'"');
readfile($file_name);
unlink($file_name);