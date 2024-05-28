<?php

namespace App\Http\Controllers;

use App\Facades\TourRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Tour::class);
        return view(
            'tours.index'
        );
    }
    /**
     * Return list of resources
     *
     * @param Request $request
     * @return void
     */
    public function async(Request $request): Collection
    {
        return TourRepository::async(
            $request->search,
            $request->input('selected', [])
        );
    }
    public function create()
    {
        $this->authorize('create', Tour::class);
        return view(
            'tours.form'
        );
    }

    public function edit(Tour $tour)
    {
        $this->authorize('update', $tour);
        return view(
            'tours.form',
            [
                'tour' => $tour
            ]
        );
    }
}
