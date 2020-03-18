<?php

namespace Pandoc\Facades;

use Illuminate\Support\Facades\Facade;

class Pandoc extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Pandoc\Pandoc::class;
    }
}
