<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['package_id' , 'name' ];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('Course')->singleFile();
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function purchases() {
        return $this->morphMany(Purchase::class, 'purchasable');
    }

}

