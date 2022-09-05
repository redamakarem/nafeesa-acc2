<?php

namespace App\Exports;

use App\Models\Sales;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesExport implements FromQuery,WithMapping,WithHeadings, WithStyles,ShouldAutoSize
{
    use Exportable;

    public $from_date;
    public $to_date;
    public $branches;
    public $items;
    public $weekdays;

    /**
     * SalesExport constructor.
     * @param $from_date
     * @param $to_date
     * @param $branches
     * @param $items
     * @param $weekdays
     */
    public function __construct($from_date, $to_date, $branches, $items, $weekdays)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->branches = $branches;
        $this->items = $items;
        $this->weekdays = $weekdays;
    }


    public function query()
    {
        $query = Sales::with(['item', 'branch']);
        $query = $query->whereBetween('date',[$this->from_date,$this->to_date]);

        if (count($this->branches)>0){

            $query->whereIn('branch_id',$this->branch_filters);
        }
        if (count($this->weekdays)>0){

            $query->whereIn('weekday',$this->weekday_filters);
        }
        if (count($this->items)>0){

            $query->whereIn('item_id',$this->finished_filters);
        }
        return $query;
    }


    public function map($sale): array
    {
        return [
            $sale->item->item_code,
            $sale->item->name_en ?? '',
            $sale->qty,
            number_format($sale->selling_price,3),
            number_format($sale->profit,3),
//            Date::dateTimeToExcel($sale->date),
            Carbon::parse($sale->date)->format(config('project.date_format')),
            $sale->branch->title_en ?? '',
            ($sale->item->total_raw_materials_cost/$sale->item->kilos_per_dough) * $sale->qty,
            ($sale->item->labor_costs/$sale->item->kilos_per_dough) * $sale->qty,
            ($sale->item->semi_finished_quantity_total/$sale->item->kilos_per_dough) * $sale->qty,
            $sale->item->shared_costs,
            $sale->item->total_related_costs

        ];
    }


    public function headings(): array
    {
        return [
            'Code',
            'Item Name',
            'Quantity',
            'Sale Price',
            'Profit',
            'Date',
            'Branch',
            'Raw Materials',
            'Labor',
            'Semi Finished',
            'AMOH',
            'Related Costs',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
