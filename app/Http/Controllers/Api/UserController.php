<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Events\SendMessageEvent;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyLoginRequest;
use App\Models\User;

class UserController extends Controller
{

    public function __construct(public UserService $userService)
{
}


    /**
     * Display a listing of the resource.
     */
    public function verifyLogin(VerifyLoginRequest $request)
    {
        $validatedData = $request->validated();
       return  $response = $this->userService->checkOtp($validatedData);
    }


     public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();
        $response = $this->userService->LoginUser($validatedData);
        $user = User::find($validatedData);


        return $response;
    }
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {

        $validatedData = $request->validated();
        return $response = $this->userService->CreateUser($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
         $request->user()->currentAccessToken()->delete();
         return response()->json(['logged out'] , 201);
    }
}
