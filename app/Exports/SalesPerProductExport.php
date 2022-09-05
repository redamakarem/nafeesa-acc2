<?php

namespace App\Exports;

use App\Models\Sales;
use App\Models\Finished;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class SalesPerProductExport implements FromQuery,WithMapping,WithHeadings, WithStyles,ShouldAutoSize
{
    use Exportable;

    public $start_date;
    public $end_date;


    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        
    }

    public function query()
    {
        $query =  Finished::query();
        return $query;
    }

    public function map($sale): array
    {
        return [
            $sale->item_code,
            $sale->name_en,
            $sale->unit->name_en,
            $sale->pps_count($this->start_date,$this->end_date),
            number_format((($sale->total_raw_materials_cost / $sale->kilos_per_dough) * $sale->pps_count($this->start_date,$this->end_date)) + 
                                           (($sale->labor_costs / $sale->kilos_per_dough) * $sale->pps_count($this->start_date,$this->end_date)) +
                                           (($sale->semi_finished_quantity_total / $sale->kilos_per_dough) * $sale->pps_count($this->start_date,$this->end_date)) + 
                                           (($sale->shared_costs * $sale->pps_count($this->start_date,$this->end_date)) + 
                                           ($sale->total_related_costs * $sale->pps_count($this->start_date,$this->end_date)) ), 3),
            number_format(($sale->total_raw_materials_cost / $sale->kilos_per_dough) * $sale->pps_count($this->start_date,$this->end_date),3),
            number_format(($sale->labor_costs / $sale->kilos_per_dough) * $sale->pps_count($this->start_date,$this->end_date),3),
            number_format(($sale->semi_finished_quantity_total / $sale->kilos_per_dough) * $sale->pps_count($this->start_date,$this->end_date),3),
            number_format($sale->shared_costs * $sale->pps_count($this->start_date,$this->end_date),3),
            number_format($sale->total_related_costs * $sale->pps_count($this->start_date,$this->end_date),3),
            $sale->pps_sales($this->start_date,$this->end_date),
            number_format($sale->pps_sales($this->start_date,$this->end_date) - ($sale->cost_per_unit * $sale->pps_count($this->start_date,$this->end_date)), 3)
        ];
    }

    public function headings(): array
    {
        return [
            'Code',
            'Item Name',
            'Unit',
            'Quantity',
            'Costs',
            'Raw Materials',
            'Labor',
            'Semi Finished',
            'AMOH',
            'Related Costs',
            'Sale Price',
            'Profit',
            
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }

    
}
