<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['user_id' , 'purchasable_id' , 'purchasable_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchasable() {
        return $this->morphTo();
    }
}
