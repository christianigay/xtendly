<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Src\Interactors\AuthenticationInteractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public function __construct(AuthenticationInteractor $authInteractor)
    {
        $this->authInteractor = $authInteractor;
    }
    
    public function login(UserLoginRequest $request)
    {
        $request->validated();
        return $this->authInteractor->login($request);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function checkUser()
    {
        return Auth::check();
    }

}
