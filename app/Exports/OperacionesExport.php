<?php

namespace App\Exports;

use App\Operacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use \Maatwebsite\Excel\Sheet;

class OperacionesExport implements FromCollection, ShouldAutoSize, WithHeadings, WithTitle
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
