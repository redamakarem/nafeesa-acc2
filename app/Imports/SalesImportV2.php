<?php

namespace App\Imports;

use App\Models\Finished;
use App\Models\Sales;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class SalesImportV2 implements ToCollection, WithValidation, SkipsOnError
{
    use Importable, SkipsErrors;

    public $date;
    public $branch_id;
    public function  __construct($date, $branch_id)
    {
        $this->date = $date;
        $this->branch_id = $branch_id;
    }


    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            $item_id = Finished::where('item_code', $row[0])->first()->id;
            $existing_item = Sales::where('item_id', $item_id)
                // ->where('qty', $row[2])
                ->where('branch_id', $this->branch_id)
                ->where('date', $this->date)
                // ->where('selling_price', $row[3])
                ->where('weekday', Carbon::parse($this->date)->dayOfWeek)->count() > 0;

            if(!$existing_item){
                Sales::create(
                    [
                        'item_id' => $item_id,
                        'qty' => $row[2],
                        'branch_id' => $this->branch_id,
                        'date' => $this->date,
                        'selling_price' => $row[3],
                        'weekday' => Carbon::parse($this->date)->dayOfWeek,
    
                    ]
                );
            }
        }
    }

    public function rules(): array
    {
        return [
            '*.0'  => function ($attribute, $value, $onFailure) {
                $item_id = Finished::where('item_code', $value)->first();
                if ($item_id == null) {
                    $onFailure('Item ID ' . $value . ' does not exist');
                }
            },

            '*.3'  => ['required'],
            '*.2'  => ['required'],
        ];
    }


    public function onError(Throwable $e)
    {
    }
}
