<?php

namespace Xxh\LarTree;

use Illuminate\Support\ServiceProvider;

class LarTreeProvider extends ServiceProvider
{


    public function register()
    {

    }

    public function boot()
    {


        $this->loadViewsFrom(__DIR__.'/views', 'lartree');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/lartree'),
        ]);

        //引入路由
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->publishes([
            __DIR__.'/static' => public_path('lartree'),
        ], 'public');


    }




}
