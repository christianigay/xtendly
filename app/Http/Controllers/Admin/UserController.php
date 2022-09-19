<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsertUserRequest;
use App\Src\Interactors\UserInteractor;

class UserController extends Controller
{
    public function __construct(UserInteractor $userInteractor){
        $this->userInteractor = $userInteractor;
    }

    public function insert(InsertUserRequest $request)
    {
        $request->validated();
        $result =  $this->userInteractor->create($request->all());
        return response()->json(['created' => $result ? true : false], 201);
    }
}
