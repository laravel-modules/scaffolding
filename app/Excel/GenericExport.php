<?php

namespace App\Excel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class GenericExport implements FromCollection
{
    /**
     * @param  class-string<\App\Excel\Exportable>  $exportable
     */
    public function __construct(
        protected Collection $items,
        protected string $exportable
    ) {}

    public function collection(): Collection
    {
        $collection = $this->exportable::toExcelRows($this->items);

        if ($collection->isEmpty()) {
            return collect();
        }

        $firstItem = $collection->first();
        $firstItemArray = $firstItem instanceof Model ? $firstItem->toArray() : (array) $firstItem;

        return collect([array_keys($firstItemArray)])
            ->merge(
                $collection->map(fn ($item) => $item instanceof Model ? array_values($item->toArray()) : array_values((array) $item))
            );
    }
}
