<?php
namespace App\Src\Interactors;

use App\Src\Repositories\RepositoryInterface;

class UserInteractor {

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }
}