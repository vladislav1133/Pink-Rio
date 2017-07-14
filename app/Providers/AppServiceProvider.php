<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;
use Blade;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(100);

        // @set($i,10)
        Blade::directive('set',function ($exp){
            list($name,$val)=explode(',',$exp);

            return "<?php $name=$val?>";
        });


        //функция которая срабатывает при выполнении sql запросов
//        DB::listen(function ($query){
//            //просмотрю sql запроса
//            dump($query->sql);
//            //отсылаемые параметры
//            //dump($query->bindings);
//        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
