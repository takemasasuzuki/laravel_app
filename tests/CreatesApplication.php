<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Artisan;//Artisanコマンドを使えるようにする記述
use App\Todo;//modelに当たるApp/Todo.phpを使用できるようにしtableへの操作を行う

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
//ここから追記
    public function prepareForTests()
    {
        Artisan::call('migrate');
        if(!Todo::all()->count()){
            Artisan::call('db:seed');
        }
    }
}
