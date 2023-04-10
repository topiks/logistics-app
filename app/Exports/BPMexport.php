<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

use Illuminate\Contracts\View\View;
use App\Models\BPM;

class BPMexport implements FromView, WithStyles, WithColumnWidths
{
    public function view(): View
    {
        $this->data_bpm = BPM::all();
        $this->jumlah_data = count($this->data_bpm);

        $this->nama_supplier = $this->data_bpm->first()->nama_supplier;
        $this->tanggal_penerimaan = $this->data_bpm->first()->updated_at;
        $this->order_masuk_no = $this->data_bpm->first()->order_masuk_no;
        $this->op_no = $this->data_bpm->first()->op_no;
        $this->bpm_no = $this->data_bpm->first()->bpm_no;

        return view('excel.t_BPM', [
            'BPM' => BPM::all(),
            'nama_supplier' => $this->nama_supplier,
            'tanggal_penerimaan' => $this->tanggal_penerimaan,
            'order_masuk_no' => $this->order_masuk_no,
            'op_no' => $this->op_no,
            'bpm_no' => $this->bpm_no,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $row_data_awal = 7;
        $row_data_akhir = $row_data_awal + $this->jumlah_data - 1;
        $row_data = 'A'.$row_data_awal . ':' . 'J'.$row_data_akhir;

        $row_mengetahui_awal = $row_data_akhir + 1;
        $row_mengetahui_akhir = $row_mengetahui_awal + 2;
        $row_mengetahui = 'A'.$row_mengetahui_awal . ':' . 'J'.$row_mengetahui_akhir;

        return [
            // judul
            '1' => [
                'font' => ['name' => 'Calibri', 'size' => 11, 'bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
                ],
            '2' => [
                'font' => ['name' => 'Calibri', 'size' => 11, 'bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
                ],

            'A3:J3' => [
                'borders' => ['bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                ],

            'A6:J6' => [
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'font' => ['name' => 'Calibri', 'size' => 11, 'bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]
                ],

            // row data dinamis
            $row_data => [
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'font' => ['name' => 'Calibri', 'size' => 11],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
                ],

            // row mengetahui dinamis
            $row_mengetahui => [
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'font' => ['name' => 'Calibri', 'size' => 11],
                'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]
                ],

        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 19,
            'B' => 8,
            'C' => 12,
            'D' => 8,
            'E' => 8,
            'F' => 9,
            'G' => 7,
            'H' => 9,
            'I' => 11,
            'J' => 11,
        ];
    }
}
