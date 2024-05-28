<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SongRepository;
use App\Models\Album;
use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SongController extends Controller
{
    /*
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
   {
       $this->authorize('viewAny', Song::class);
       return view(
           'songs.index'
       );
   }

   public function create()
   {
       $this->authorize('create', Song::class);
       return view(
           'songs.form'
       );
   }

   public function edit(Song $song)
   {
       $this->authorize('update', $song);
       return view(
           'songs.form',
           [
               'song' => $song
           ]
       );
   }

   public function songsForAlbum(Album $album){
    $this->authorize('viewAny', Song::class);
    return view(
        'songs.index',
        [
            'album' => $album
        ]
    );
   }
}
