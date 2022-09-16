<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsertUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function insert(InsertUserRequest $request)
    {
        $request->validated();
        $result =  User::create($request->all());
        return response()->json(['created' => $result]);
    }
}
