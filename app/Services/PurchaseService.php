<?php

namespace App\Services;

use App\Events\PurchaseEvent;
use App\Models\User;
use App\Models\Package;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PurchaseService
{
    public function checkIfPackageOrCoursePurchased($purchasableType, $purchasableId , $user_id)
    {

        $user = User::find($user_id);
        if($purchasableType == "Package")
      return  $packagePurchased = $user->checkIfPackageOrCoursePurchased('App\Models\Package', $purchasableId);
        else if($purchasableType == "Course")
        return $coursePurchased = $user->checkIfPackageOrCoursePurchased('App\Models\Course', $purchasableId);
        else return 0;

    }
    public function makePurchase($purchasableType, $purchasableId , $user_id)
    {
        $purchase = 0;
        $user = User::find($user_id);
        // dd($user);
        if($this->checkIfPackageOrCoursePurchased($purchasableType, $purchasableId , $user_id))
        {
            if($purchasableType == "Package")
           {
            $purchase =  Purchase::create([
                    "purchasable_type"=>"App\Models\Package",
                    "purchasable_id"=>"$purchasableId",
                    "user_id"=>"$user_id",
            ]);
            event(new PurchaseEvent($user->email, "You have make a purchase on a package "));
        }

            else if($purchasableType == "Course")
       {

        $purchase = Purchase::create([
                "purchasable_type"=>"App\Models\Course",
                "purchasable_id"=>"$purchasableId",
                "user_id"=>"$user_id",
        ]);
        event(new PurchaseEvent($user->email , "You have make a purchase on a course "));
    }

        return response()->json([$purchase], 201);
    }
    return response()->json(["you can't by this $purchasableType"], 401);
}
}



