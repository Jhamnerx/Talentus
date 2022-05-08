<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use App\Models\Dispositivos;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;

class DispositivosExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromQuery, WithMapping, WithHeadings, WithCustomValueBinder
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function query()
    {
        return Dispositivos::query();
    }
    // public function collection()
    // {
    //     return dispositivos::all();
    // }
    public function headings(): array
    {
        return [
            '#',
            'IMEI',
            'MODELO',
            'VEHICULO',
            'Fecha',
        ];
    }

    public function map($dispositivo): array
    {
        return [
            $dispositivo->id,
            $dispositivo->imei,
            $dispositivo->modelo->modelo,
            ($dispositivo->vehiculos) ? $dispositivo->vehiculos->placa : 'Disponible',
            Carbon::createFromFormat('Y-m-d H:i:s', $dispositivo->created_at)->format('d-m-Y'),

        ];
    }
}
