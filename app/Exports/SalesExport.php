<?php

namespace App\Exports;

use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class SalesExport implements FromQuery
{

    public $q;

    public function __construct($q)
    {
        $this->q = $q;
    }

    public function query()
    {
        return $this->q;
    }
}
