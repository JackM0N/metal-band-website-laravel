<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Facades\AlbumRepository;

class AlbumController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Album::class);
        return view(
            'albums.index'
        );
    }

    public function async(Request $request)
    {
        return AlbumRepository::async(
            $request->search,
            $request->input('selected', [])
        );
    }

    public function create()
    {
        $this->authorize('create', Album::class);
        return view(
            'albums.form'
        );
    }

    public function edit(Album $album)
    {
        $this->authorize('update', $album);
        return view(
            'albums.form',
            [
                'album' => $album
            ]
        );
    }
}
