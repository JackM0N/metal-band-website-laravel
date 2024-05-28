<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use App\Models\Album;

class Song extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title','duration','album_id'];

    public function album(){
        return $this->belongsTo(Album::class)->withTrashed();
    }
}
