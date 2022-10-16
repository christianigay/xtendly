<?php

namespace App\Providers;

use App\Src\Interactors\UserInteractor;
use App\Src\Repositories\UserRepository;
use App\Src\Interactors\PaymentInteractor;
use App\Src\Repositories\OrderRepository;
use App\Src\Interactors\PaymentApproveInteractor;
use App\Src\Repositories\PaymentRepository;
use App\Src\Interactors\AuthenticationInteractor;
use Illuminate\Support\ServiceProvider;

class InteractorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $interactors = [
            [
                'class' => UserInteractor::class, 
                'name' => 'App\Src\Interactors\UserInteractor', 
                'dependency' => UserRepository::class
            ],
            [
                'class' => AuthenticationInteractor::class, 
                'name' => 'App\Src\Interactors\AuthenticationInteractor', 
                'dependency' => UserRepository::class
            ],
            [
                'class' => PaymentInteractor::class, 
                'name' => 'App\Src\Interactors\PaymentInteractor', 
                'dependency' => OrderRepository::class
            ],
            [
                'class' => PaymentApproveInteractor::class, 
                'name' => 'App\Src\Interactors\PaymentApproveInteractor', 
                'dependency' => PaymentRepository::class
            ]
        ];
        foreach($interactors as $interactor){
            $this->app->bind($interactor['class'], function ($app) use($interactor) {
                return new $interactor['name']($app->make($interactor['dependency']));
            });
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
