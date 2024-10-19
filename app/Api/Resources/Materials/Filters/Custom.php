<?php

namespace App\Api\Resources\Materials\Filters;

use Illuminate\Database\Eloquent\Builder;
use XtendPackages\RESTPresenter\Concerns\InteractsWithRequest;

class Custom
{
    use InteractsWithRequest;

    public function handle(Builder $query, callable $next): Builder
    {
        if ($this->hasFilter('{{ resource_field_name }}') && $this->filterBy('{{ resource_field_name }}')) {
            $query->whereNotNull('{{ resource_field_name }}');
        }

        return $next($query);
    }
}
