<?php

namespace App\Exports;

use App\Member;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportMemberExport implements FromView,WithColumnWidths,WithStyles
{

    public function view(): View
    {
        return view('exports.report-member', [
            'members' => Member::all()
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,            
            'B' => 30,            
            'C' => 13,            
            'D' => 25,            
            'E' => 25,            
            'F' => 20,            
            'G' => 15,                       
            'H' => 20,                       
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
