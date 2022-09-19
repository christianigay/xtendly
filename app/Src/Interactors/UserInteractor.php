<?php
namespace App\Src\Interactors;

use App\Src\Repositories\RepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserInteractor {

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->repository->create($data);
    }

    public function details()
    {
        return Auth::user();
    }
}