<?php
namespace App\Src\Repositories;

interface RepositoryInterface {

    public function create($data);

    public function update($id, array $data);

    public function delete($id);

    public function getById($id);
}