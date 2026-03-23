<?php

namespace App\Excel;

use Illuminate\Support\Collection;

interface Exportable
{
    /**
     * Transform models into Excel rows.
     */
    public static function toExcelRows(Collection $models): Collection;
}
