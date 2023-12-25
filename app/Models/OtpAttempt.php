<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpAttempt extends Model
{
    protected $table = 'otp_attempts';

    protected $fillable = [
        'user_id',
        'otp',
        'expiry_time',
    ];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
