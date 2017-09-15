<?php

namespace Parsidev\Encryption\Facades;

use Illuminate\Support\Facades\Facade;

class Encryption extends Facade {

    protected static function getFacadeAccessor() {
        return 'encryption';
    }
}