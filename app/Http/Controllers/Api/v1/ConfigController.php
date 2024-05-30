<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\AppConfig;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AppConfig $action)
    {
        return $action->handle();
    }
}
