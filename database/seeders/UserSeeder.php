<?php

namespace Database\Seeders;

use App\Src\Interactors\UserInteractor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function __construct(UserInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'email' => 'test@gmail.com',
            'name' => 'test email',
            'password' => 'password'
        ];
        return $this->interactor->create($data);
    }
}
