<?php
namespace App\Src\Repositories;

use App\Models\User;

class PaypalRepository implements RepositoryInterface {

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->getById($id)->update($data);
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }
}