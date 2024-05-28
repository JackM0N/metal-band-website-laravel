<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Album extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','publicationYear'];

    public function songs(){
        return $this->hasMany(Song::class);
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
