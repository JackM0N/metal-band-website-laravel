<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AlbumRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AlbumRepository';
    }
}
