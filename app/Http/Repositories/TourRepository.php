<?php

namespace App\Http\Repositories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TourRepository
{
    public function async(string|null $search, array|null $selected): Collection
    {
        return Tour::query()
            ->select('id', 'title')
            ->orderBy('title')
            ->when(
                $search,
                fn (Builder $query) => $query->where('title', 'like', "%{$search}%")
            )
            ->when(
                $selected,
                fn (Builder $query) => $query->whereIn('id', $selected),
                fn (Builder $query) => $query
            )
            ->get();
    }
}
