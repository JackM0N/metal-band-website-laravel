<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Tour;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    /*
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
   {
       $this->authorize('viewAny', Concert::class);
       return view(
           'concerts.index'
       );
   }

   public function create()
   {
       $this->authorize('create', Concert::class);
       return view(
           'concerts.form'
       );
   }


   public function edit(Concert $concert)
   {
       $this->authorize('update', $concert);
       return view(
           'concerts.form',
           [
               'concert' => $concert
           ]
       );
   }

   public function concertsForTour(Tour $tour){
        $this->authorize('viewAny', Concert::class);
        return view(
            'concerts.index',
            [
                'tour' => $tour
            ]
        );
    }
}
