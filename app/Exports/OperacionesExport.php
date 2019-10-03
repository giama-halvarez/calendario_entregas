<?php

namespace App\Exports;

use App\Operacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Writer;
use \Maatwebsite\Excel\Sheet;

class OperacionesExport implements FromCollection, ShouldAutoSize, WithHeadings, WithTitle, WithEvents
{
	use Exportable;

    protected $operaciones;
    protected $titulos;

    public function __construct($operaciones, $titulos = array())
    {
        $this->operaciones = $operaciones;
        $this->titulos = $titulos;

        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });

        Writer::macro('setCreator', function (Writer $writer, string $creator) {
            $writer->getDelegate()->getProperties()->setCreator($creator);
        });

        Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
            $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
        });

    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeExport::class  => function(BeforeExport $event) {
                $event->writer->setCreator('Grupo Giama');
            },
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                $event->sheet->styleCells(
                    'A1:U1',
                    [
                        'font' => [
                            'bold' => true,
                        ],                 
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                        ]
                    ]
                );
            },
        ];
    }

    public function headings(): array
    {
        return $this->titulos;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Operaciones';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->operaciones;
    }
}
