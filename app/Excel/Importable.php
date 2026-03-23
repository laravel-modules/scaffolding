<?php

namespace App\Excel;

interface Importable
{
    /**
     * Create model instance from Excel row.
     *
     * @return static|static[]|null
     */
    public static function makeFromExcel(array $row): static|array|null;

    /**
     * Get the validation rules that apply to the import.
     */
    public static function validationRules(): array;
}
