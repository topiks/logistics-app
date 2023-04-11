<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

use Illuminate\Contracts\View\View;
use App\Models\BPG;

class BPGexport implements FromView, WithStyles, WithColumnWidths
{
    public function view(): View
    {
        $this->data_bpg = BPG::all();
        $this->jumlah_data = count($this->data_bpg);

        $this->no_seri = $this->data_bpg->first()->no_seri;
        $this->no_order = $this->data_bpg->first()->no_order;
        $this->pemesan = $this->data_bpg->first()->pemesan;
        $this->nomor_bpg = $this->data_bpg->first()->nomor_bpg;

        return view('excel.t_BPG', [
            'BPG' => BPG::all(),
            'no_seri' => $this->no_seri,
            'no_order' => $this->no_order,
            'pemesan' => $this->pemesan,
            'nomor_bpg' => $this->nomor_bpg,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $row_data_awal = 9;
        $row_data_akhir = $row_data_awal + $this->jumlah_data - 1;
        $row_data = 'A'.$row_data_awal . ':' . 'L'.$row_data_akhir;

        $row_mengetahui_awal = $row_data_akhir + 1;
        $row_mengetahui_akhir = $row_mengetahui_awal + 3;
        $row_mengetahui = 'A'.$row_mengetahui_awal . ':' . 'L'.$row_mengetahui_akhir;

        return [
            //  data dinamis
            $row_data => [
                'font' => ['name' => 'Calibri', 'size' => 11],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]
                ],

            // mengetahui
            $row_mengetahui => [
                'font' => ['name' => 'Calibri', 'size' => 11],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]
                ],

            // judul
            'A1:I1' => [
                'font' => ['name' => 'Calibri', 'size' => 12, 'bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
                ],

            'A2:I2' => [
                'font' => ['name' => 'Calibri', 'size' => 12, 'bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
                ],

            // nama kolom
            'A3:G5' => [
                'font' => ['name' => 'Calibri', 'size' => 11],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                ],

            'H3:L5' => [
                'font' => ['name' => 'Calibri', 'size' => 11],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]
                ],

            'A6:L8' => [
                'font' => ['name' => 'Calibri', 'size' => 11],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]
                ],
        ];
    }

    public function columnWidths(): array
    {
        return [
        ];
    }
}
