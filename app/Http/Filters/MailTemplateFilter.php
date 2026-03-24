<?php

namespace App\Http\Filters;

use AhmedAliraqi\LaravelFilterable\BaseFilter;

class MailTemplateFilter extends BaseFilter
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
        'selected_id',
    ];

    /**
     * Apply a filter to the query based on the "name" field.
     */
    protected function name(mixed $value): void
    {
        $this->builder->whereTranslationLike('name', "%$value%");
    }

    /**
     * Sorting results by the given id.
     */
    public function selectedId(mixed $ids): void
    {
        if ($ids) {
            $this->builder->sortingByIds($ids);
        }
    }
}
