<?php

namespace App\Exports;

use App\Model\RedeemPoint;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromView,WithColumnWidths,WithStyles
{
    public function view(): View
    {
        return view('exports.report-partner', [
            'redeem_points' => RedeemPoint::all()
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,            
            'B' => 40,            
            'C' => 40,            
            'D' => 15,            
            'E' => 15,                       
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 12]],
        ];
        $sheet->getStyle('1')->getFont()->setBold(true);
    }
}
