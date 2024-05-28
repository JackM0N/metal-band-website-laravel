<?php

namespace App\Http\Livewire\Filters;

use LaravelViews\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class SoftDeletedConcertFilter extends Filter
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('translation.attributes.deleted_at');
    }

    public function apply(Builder $query, $value, $request): Builder
    {
        if ($value == 1) {
            return $query->whereNotNull('concerts.deleted_at');
        }
        return $query->whereNull('concerts.deleted_at');
    }

    public function options(): array
    {
        return [
            __('translation.yes') => 1,
            __('translation.no') => 0,
        ];
    }
}
