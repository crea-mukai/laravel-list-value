<?php

namespace CreaMukai\LaravelListValue\Facades;

use Illuminate\Support\Facades\Facade;
// use CreaMukai\LaravelListValue\Services\ListValueService;

class ListValueFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ListValueService';
    }
}

