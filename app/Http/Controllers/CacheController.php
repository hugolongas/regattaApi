<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CacheController extends Controller
{
    function regenerateCache(){
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('route:clear');

        \Artisan::call('config:cache');
        \Artisan::call('route:cache');
        return "OK";
    }
}
