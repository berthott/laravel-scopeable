<?php

namespace berthott\Scopeable\Facades;

use Illuminate\Support\Facades\Facade;

class Scopeable extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Scopeable';
    }
}
