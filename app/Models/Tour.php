<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Tour extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'startDate', 'endDate'];

    public function __toString()
    {
        return $this->name;
    }

    public function concerts(){
        return $this->hasMany(Concert::class);
    }

    protected function image(): Attribute
   {
       return Attribute::make(
           get: function ($value) {
               if ($value === null) {
                   return null;
               }
               return config('filesystems.images_dir') . '/' . $value;
           },
       );
   }

   public function imageUrl(): string
   {
       return $this->imageExists()
           ? Storage::url($this->image)
           : Storage::url(
               config('filesystems.default_image')
           );
   }


   public function imageExists(): bool
   {
       return $this->image !== null
           && Storage::disk('public')->exists($this->image);
   }
}
