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
        return view('excel.t_LPB', [
            'LPB' => LPB::all()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // set border
            'A2:I2' => ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]],

            // set align center
            'A3:I3' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],

            // set row 2 height to 100
            '8' => ['rowHeight' => 100],
            
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
