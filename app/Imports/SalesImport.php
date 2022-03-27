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

class SalesImport implements ToCollection,WithValidation,SkipsOnError
{
    use Importable,SkipsErrors;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            $item_id = Finished::where('item_code',$row[0])->first()->id;
            Sales::create(
                [
                    'item_id' => $item_id,
                    'qty' => $row[2],
                    'branch_id' => $row[5],
                    'date' => $row[4],
                    'selling_price' => $row[3],
                    'weekday' => Carbon::parse($row[4])->dayOfWeek,

                ]
            );
        }
    }

    public function rules():array
    {
        return [
            '*.0'  => function($attribute, $value, $onFailure) {
            $item_id = Finished::where('item_code',$value)->first();
                if ($item_id ==null) {
                    $onFailure('Item ID ' .$value . ' does not exist');
                }
            },
            '*.1'  => ['required'],
            '*.5'  => ['exists:branches,id'],
            '*.3'  => ['required'],
            '*.2'  => ['required'],
        ];
    }


    public function onError(Throwable $e)
    {
    }
}
