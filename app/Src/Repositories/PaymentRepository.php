<?php
namespace App\Src\Repositories;

use App\Models\Payment;

class PaymentRepository implements RepositoryInterface {

    public function __construct(Payment $user)
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


}