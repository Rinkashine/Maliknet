<?php

namespace App\Exports;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithFooter;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\RichText\Run;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategoryExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping,WithStyles, WithEvents, WithColumnWidths, WithDrawings
{
    protected $user_name;

    protected $date;

    protected $last_row;

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 45,
        ];
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('My Image');
        $drawing->setDescription('This is my image');
        $drawing->setPath(public_path('/dist/images/MainLogo.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return [$drawing];
    }
    public function styles(Worksheet $sheet)
    {

        $sheet->getStyle('A6:B' . $sheet->getHighestDataRow())
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getPageMargins()->setTop(0.3);
        $sheet->getPageMargins()->setLeft(0.25);
        $sheet->getPageMargins()->setRight(0.25);

        // get the total number of rows in the sheet
        $totalRows = $sheet->getHighestRow();

        // initializ a variable to keep track of the row color
        $rowColor = 'cddbd7';
        $fontColor = 'FAFAFA';
        $sheet->getStyle('A6:B6')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '064e3b'
                ],
            ],
        ]);
        $sheet->getStyle('A6:B6')->getFont()->setColor(new Color('FFFFFF'));
        $sheet->getStyle('A2:B2')->getFont()->setColor(new Color('000000'));

        // loop through each row and set its style
        for ($i = 7; $i <= $totalRows; $i++) {
            $sheet->getStyle("A{$i}:B{$i}")->applyFromArray([
                'font' => ['size' => 15],
                // 'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => $rowColor,
                    ],
                ],

            ]);
            $rowColor = ($rowColor === 'FAFAFA') ? 'cddbd7' : 'FAFAFA';
            // $fontColor = ($fontColor === 'FFFFFF') ? '000000' : 'FFFFFF';
        }
        $this->last_row = $sheet->getHighestDataRow();
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
            3 => ['font' => ['bold' => true]],
            'A146' => ['font' => ['bold' => true]],
            'A146' => ['font' =>  ['size' => 14]],
            'A:B'  => ['font' => ['size' => 15]],
            'A6:B6' => ['font' => ['bold' => true]],
            2 => ['font' =>  ['size' => 20]],
            'A3' => ['font' => ['size' => 14]],
            'A2' => ['font' => ['bold' => true]],
            'A5' => ['font' => ['size' => 13]],

        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->setCellValue('A2','List of Categories');

                $event->sheet->getDelegate()->getStyle('A:B')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A' . $this->last_row + 2)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getDelegate()->getStyle('A' . $this->last_row + 3)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->setCellValue('A' . $this->last_row + 2,'Prepared by: ' . $this->user_name);
                $event->sheet->setCellValue('A' . $this->last_row + 3, date('F d, Y h:i:s', strtotime(Carbon::now())));
                $event->sheet->getDelegate()->freezePane('A7');

            },
            BeforeSheet::class => function(BeforeSheet $event) {
                $event->sheet->mergeCells('A2:B2');
                $event->sheet->getStyle('A2:B2')->getAlignment()->setHorizontal('center');
                $event->sheet->mergeCells('A3:B3');
                $event->sheet->getStyle('A3:B3')->getAlignment()->setHorizontal('center');
                $event->sheet->getDelegate()->getPageSetup()->setHorizontalCentered(true);
            },
        ];
    }

    public function __construct()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->user_name = $user->name;
        } else {
            $this->user_name = 'Unknown';
        }
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Category::all();
    }

    public function map($category): array
    {
        return [
            $category->id,
            $category->name,
        ];
    }

    public function headings(): array
    {
        return [
            [],
            [],
            [],
            [],
            [],
            ['Category ID','Category Name']
        ];
    }
}
