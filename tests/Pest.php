<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Validator;

uses(
    Tests\TestCase::class,
    // Illuminate\Foundation\Testing\RefreshDatabase::class,
    // Illuminate\Foundation\Testing\LazilyRefreshDatabase::class,
)->in('Feature');

function createRequest($class, $requestBody)
{
    $createdRequest = new $class();

    $createdRequest->setContainer(app());

    $createdRequest->initialize($requestBody);

    $createdRequest->setValidator(Validator::make($createdRequest->all(), $createdRequest->rules()));

    return $createdRequest;
}
