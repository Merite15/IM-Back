<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Throwable;

class RunMigration
{
    public static function handle(): Response|Application|ResponseFactory
    {
        try {
            Artisan::call('migrate:fresh', [
                '--path' => '/database/migrations',
                '--force' => true,
            ]);

            Artisan::call('db:seed', [
                '--force' => true,
            ]);

            return response([
                'success' => true,
                'message' => 'Migration changée avec succès',
            ]);
        } catch (Throwable $th) {
            return response([
                'success' => false,
                'message' => "Une erreur s'est produite",
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
