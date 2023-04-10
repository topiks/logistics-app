<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

use Illuminate\Contracts\View\View;
use App\Models\LPB;

class LPBexport implements FromView, WithStyles, WithColumnWidths
{
    public function view(): View
    {
        $this->data_lpb = LPB::all();
        $this->jumlah_data = count($this->data_lpb);

        return view('excel.t_LPB', [
            'LPB' => LPB::all()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $row_data_awal = 8;
        $row_data_akhir = $row_data_awal + $this->jumlah_data - 1;
        $row_data = 'A'.$row_data_awal . ':' . 'I'.$row_data_akhir;
        
        // ----------------------------

        $row_mengetahui_awal = $row_data_akhir + 1;
        $row_mengetahui_akhir = $row_mengetahui_awal + 5;
        $row_mengetahui = 'A'.$row_mengetahui_awal . ':' . 'I'.$row_mengetahui_akhir;

        return [
            // row data dinamis
            $row_data => [
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'font' => ['name' => 'Times New Roman', 'size' => 11],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
                ],

            // row mengetahui dinamis
            $row_mengetahui => [
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'font' => ['name' => 'Times New Roman', 'size' => 11],
                'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]
                ],

            // row 2 = no form
            'I2' => [
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'font' => ['bold' => true, 'name' => 'Times New Roman', 'size' => 11],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
                ],

            // row 3 = no dokumen
            'G3:I3' => [
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'font' => ['name' => 'Times New Roman', 'size' => 11]
                ],

            // row 4 = tanggal
            'G4:I4' => [
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'font' => ['name' => 'Times New Roman', 'size' => 11]
                ],

            // row 6 = header
            'A6:I6' => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER], 
                'font' => ['bold' => true, 'name' => 'Times New Roman', 'size' => 9], 
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
                ],

            // row 7 = 'LAPORAN PENERIMAAN BARANG'
            'A7:I7' => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'font' => ['bold' => true, 'name' => 'Verdana', 'size' => 16],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
                ],

        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 21,
            'B' => 60,
            'C' => 30,
            'D' => 10,
            'E' => 18,
            'F' => 29,
            'G' => 16,
            'H' => 19,
            'I' => 30,
        ];
    }

}
