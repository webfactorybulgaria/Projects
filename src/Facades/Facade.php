<?php

namespace TypiCMS\Modules\Projects\Facades;

use Illuminate\Support\Facades\Facade as MainFacade;

class Facade extends MainFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'TypiCMS\Modules\Projects\Shells\Repositories\ProjectInterface';
    }
}
