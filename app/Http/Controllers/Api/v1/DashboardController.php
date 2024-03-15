<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\Dashboard\FetchData;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FetchData $action)
    {
        return $action->handle();
    }
}
