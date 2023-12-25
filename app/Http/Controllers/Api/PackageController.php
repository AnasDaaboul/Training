<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Services\PackageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;

class PackageController extends Controller
{
    public function __construct(public PackageService $packageService)
    {
    }

    public function index()
    {
        $packages = Package::withTrashed()->get();
        return response()->json($packages);
    }


    public function softDelete(Request $request)
    {
        $id = $request['id'];
        return  $this->packageService->softDelete($id);
    }

    public function store(PackageRequest $request)
    {
        $validatedData = $request->validated();
        return $this->packageService->makePackage($validatedData);
    }
}
