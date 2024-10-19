<?php

namespace App\Api\Resources\Materials\Filters;

use Illuminate\Database\Eloquent\Builder;
use XtendPackages\RESTPresenter\Concerns\InteractsWithRequest;

class Customer
{
    use InteractsWithRequest;

    public function handle(Builder $query, callable $next): Builder
    {
        $filterBy = $this->filterBy('customer_id');
        if ($this->hasFilter('customer_id') && $filterBy) {
            is_array($filterBy)
                ? $query->whereIn('customer_id', $filterBy)
                : $query->where('customer_id', $filterBy);
        }

        return $next($query);
    }
}
