<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Reply extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'reply';
    }
}
