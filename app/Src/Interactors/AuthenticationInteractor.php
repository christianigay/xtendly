<?php
namespace App\Src\Interactors;

use App\Src\Repositories\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticationInteractor {

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function login(Request $request)
    {
        if(Auth::attempt($request->all())){
            $request->session()->regenerate();
            return response(['user' => auth()->user()]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}