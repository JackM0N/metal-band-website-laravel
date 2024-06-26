<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tour;

class Concert extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date','country','city','place','tour_id'];

    public function tour(){
        return $this->belongsTo(Tour::class);
    }
}
