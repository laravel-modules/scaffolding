<?php

namespace App\Http\Filters;

use AhmedAliraqi\LaravelFilterable\BaseFilter;

class AdminFilter extends BaseFilter
{
    /**
     * The list of relations that are allowed to be included with the query.
     */
    protected array $supportedInclude = [];

    /**
     * Registered filters to operate upon.
     */
    protected array $filters = [
        'name',
        'type',
        'email',
        'phone',
        'selected_id',
    ];

    /**
     * Apply a filter to the query based on the "name" field.
     */
    protected function name(mixed $value): void
    {
        $this->builder->where('name', 'like', "%$value%");
    }

    /**
     * Apply a filter to the query based on the "type" field.
     */
    protected function type(mixed $value): void
    {
        $this->builder->where('type', $value);
    }

    /**
     * Apply a filter to the query based on the "email" field.
     */
    protected function email(mixed $value): void
    {
        $this->builder->where('email', 'like', "%$value%");
    }

    /**
     * Apply a filter to the query based on the "phone" field.
     */
    protected function phone(mixed $value): void
    {
        $this->builder->where('email', 'like', "%$value%");
    }

    /**
     * Sorting results by the given ids.
     */
    public function selectedId($ids): void
    {
        if ($ids) {
            $this->builder->sortingByIds($ids);
        }
    }
}
