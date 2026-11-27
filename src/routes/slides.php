<?php

declare(strict_types=1);

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Slides\Http\Controllers\AdminController;
use TypiCMS\Modules\Slides\Http\Controllers\ApiController;

/*
 * Admin routes
 */
Route::middleware('admin')
    ->prefix('admin')
    ->name('admin::')
    ->group(function (Router $router): void {
        $router->get('slides', [AdminController::class, 'index'])->name('index-slides')->middleware('can:read slides');
        $router
            ->get('slides/create', [AdminController::class, 'create'])
            ->name('create-slide')
            ->middleware('can:create slides');
        $router
            ->get('slides/{slide}/edit', [AdminController::class, 'edit'])
            ->name('edit-slide')
            ->middleware('can:read slides');
        $router
            ->post('slides', [AdminController::class, 'store'])
            ->name('store-slide')
            ->middleware('can:create slides');
        $router
            ->put('slides/{slide}', [AdminController::class, 'update'])
            ->name('update-slide')
            ->middleware('can:update slides');
    });

/*
 * API routes
 */
Route::middleware(['web', 'api', 'auth'])->prefix('api')->group(function (Router $router): void {
    $router->get('slides', [ApiController::class, 'index'])->middleware('can:read slides');
    $router->patch('slides/{slide}', [ApiController::class, 'updatePartial'])->middleware('can:update slides');
    $router->delete('slides/{slide}', [ApiController::class, 'destroy'])->middleware('can:delete slides');
});
