<?php

namespace App\Providers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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

        Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {

            if(auth()->user())
            {


                $ready      = Order::query()->where('status', 'ORDER_RECEIVED')->count();
                $received   = Order::query()->where('status', 'ORDER_SHIPPED')->count();
                $processed  = Order::query()->where('status', 'ORDER_READY_TO_SHIP')->count();
                $shipped    = Order::query()->where('status', 'ORDER_PROCESSING')->count();


                $view->with([
                    'ready'   => $ready ?? 0,
                    'received'   => $received ?? 0,
                    'processed'   => $processed ?? 0,
                    'shipped' => $shipped ?? 0,
                ]);

            }



        });
    }
}
