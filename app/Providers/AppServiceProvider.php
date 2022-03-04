<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {

            if(auth()->user())
            {
                $user  = auth()->user();

                $usd  = $user->account()->where('name','like','USD%')->first();
                $eur  = $user->account()->where('name','like','EUR%')->first();
                $ngn  = $user->account()->where('name','like','NGN%')->first();
                $trans = $user->sent->count() + $user->received()->count();



                $view->with([
                    'usd'   => $usd->balance ?? 0,
                    'eur'   => $eur->balance ?? 0,
                    'ngn'   => $ngn->balance ?? 0,
                    'count' => $trans,
                ]);

            }



        });
    }
}
