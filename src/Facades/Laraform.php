<?php
namespace Rishadblack\Laraform\Facades;

use Illuminate\Support\Facades\Facade;

class Laraform extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laraform';
    }
}
