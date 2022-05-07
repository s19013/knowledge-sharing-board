<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;

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
        //すべてのメソッドが呼ばれる前に先に呼ばれるメソッド
        view()->composer('*',function($view) {
                //ビューにわたす
                //第1引数はViewで使う時の命名
                //第2引数はわたしたい変数or配列名
                $imgUrl = User::select('imgUrl')
                            ->where('id','=',\Auth::id())
                            ->find();

                $view->with('imgUrl',$imgUrl);
            });
    }
}
