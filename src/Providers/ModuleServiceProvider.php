<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Slides\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Override;
use TypiCMS\Modules\Slides\Composers\SidebarViewComposer;

class ModuleServiceProvider extends ServiceProvider
{
    #[Override]
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/slides.php', 'typicms.modules.slides');
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/slides.php');

        $this->publishes([
            __DIR__.'/../../database/migrations/create_slides_table.php.stub' => getMigrationFileName(
                'create_slides_table',
            ),
        ], 'typicms-migrations');
        $this->publishes([
            __DIR__.'/../../resources/views/admin/slides' => resource_path('views/admin/slides'),
        ], ['typicms-views', 'typicms-admin-views', 'typicms-admin-slides-views']);
        $this->publishes([
            __DIR__.'/../../resources/views/public/slides' => resource_path('views/public/slides'),
        ], ['typicms-views', 'typicms-public-views', 'typicms-public-slides-views']);
        $this->publishes([__DIR__.'/../../resources/scss' => resource_path('scss')], 'typicms-resources');

        View::composer('admin::core._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('public::slides.*', function ($view): void {
            $view->page = getPageLinkedToModule('slides');
        });
    }
}
