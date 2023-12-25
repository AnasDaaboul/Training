<?php


namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'id',

    ];


    public function checkIfPackageOrCoursePurchased($purchasableType, $purchasableId)
    {
        // Get the purchases related to the user for the given purchasable type and ID
        $purchases = $this->purchases()->where([
            'purchasable_type' => $purchasableType,
            'purchasable_id' => $purchasableId,
        ])->get();
        if ($purchases) {
            if ($purchasableType === Package::class) {
                $package = Package::find($purchasableId);
                if ($package && $package->courses()->exists()) {
                    $purchasedCourses = $this->purchases()
                        ->whereIn('purchasable_type', [Course::class])
                        ->whereIn('purchasable_id', $package->courses()->pluck('id'))
                        ->get();

                    // If any of the associated courses have been purchased, return true
                    if ($purchasedCourses->isNotEmpty()) {
                        return true;
                    }
                }
            }

            // If the purchased item is not a course or it's a course without associated packages, return true
            return $purchasableType !== Course::class;
        }
        return false;
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function OtpAttempts()
    {
        return $this->hasMany(OtpAttempt::class);
    }


}
