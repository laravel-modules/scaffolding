<?php

namespace App\Http\Filters;

use AhmedAliraqi\LaravelFilterable\BaseFilter;

class FeedbackFilter extends BaseFilter
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
        'status',
    ];

    /**
     * Apply a filter to the query based on the "name" field.
     */
    protected function name(mixed $value): void
    {
        $this->builder->where('name', 'like', "%$value%");
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
