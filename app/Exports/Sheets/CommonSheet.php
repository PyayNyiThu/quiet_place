<?php

namespace App\Exports\Sheets;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CommonSheet implements FromArray, WithColumnFormatting, WithEvents, WithTitle, ShouldAutoSize, WithHeadings
{
    private $excel_data;
    private $excel_heading;
    private $excel_title;

    public function __construct($data = array())
    {
        $this->excel_title = $data['excel_title'];
        $this->excel_data = $data['excel_data'];
        $this->excel_heading = $data['excel_heading'];
    }
    public function array(): array
    {
        return $this->excel_data;
    }

    public function headings(): array
    {
        return $this->excel_heading;
    }

    public function title(): string
    {
        return $this->excel_title;
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER,
        ];
    }


    public function registerEvents(): array
    {
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
        $count = count($this->excel_data) + 1;

        return [
            AfterSheet::class => function (AfterSheet $event) use ($count) {

                $event->sheet->styleCells(
                    'A2:W' . $count,
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                        ],
                    ]
                );

                $event->sheet->styleCells(
                    'A1:AH1',
                    [
                        'font' => [
                            'bold' => true,
                            'size' => 12
                        ]
                    ]
                );
            },
        ];
    }
}
