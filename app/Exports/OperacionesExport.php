<?php

namespace App\Exports;

use App\Operacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class OperacionesExport implements FromCollection, ShouldAutoSize, WithHeadings
{
	use Exportable;

    protected $operaciones;
    protected $titulos;

    public function __construct($operaciones, $titulos = array())
    {
        $this->operaciones = $operaciones;
        $this->titulos = $titulos;
    }

    public function headings(): array
    {
        return $this->titulos;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->operaciones;
    }
}
