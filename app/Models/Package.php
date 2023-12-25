<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];


    public function registerMediaCollections(): void {
        $this->addMediaCollection('Package')->singleFile();
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }

    public function purchases() {
        return $this->morphMany(Purchase::class, 'purchasable');
    }
}
