<?php

namespace App\Services;

use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PackageService
{


    public function makePackage($valedatedData)
    {
         $package = Package::create($valedatedData);
         $media = $package->addMediaFromRequest('image')->toMediaCollection('courses');
         return response()->json([$package], 201);
    }
    public function softDelete($id)
    {

         $package = Package::findOrFail($id);
        //  dd("hhhhhh");
         $package->delete();

         return response()->json(['message' => 'Package soft deleted successfully'] , 201);
    }



}
