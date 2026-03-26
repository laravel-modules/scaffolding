<?php

namespace App\Excel;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class GenericImport implements
    ShouldQueue,
    ToModel,
    WithChunkReading,
    WithHeadingRow,
    WithValidation,
    WithUpserts,
    WithBatchInserts
{
    /**
     * @param  class-string<Importable>  $importable
     */
    public function __construct(
        protected string $importable
    ) {}

    /**
     * @return Model|Model[]|null
     */
    public function model(array $row): Model|array|null
    {
        return $this->importable::makeFromExcel($row);
    }

    public function rules(): array
    {
        return $this->importable::validationRules();
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function uniqueBy()
    {
        if (method_exists($this->importable, 'uniqueBy')) {
            return $this->importable::uniqueBy();
        }
        return [];
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
