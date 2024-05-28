<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class TourRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'TourRepository';
    }
}
