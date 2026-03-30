<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Slides\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Slides\Composers\SidebarViewComposer;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/slides.php', 'typicms.modules.slides');

        $this->loadRoutesFrom(__DIR__.'/../routes/slides.php');

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'slides');

        $this->publishes([
            __DIR__.'/../../database/migrations/create_slides_table.php.stub' => getMigrationFileName(
                'create_slides_table',
            ),
        ], 'typicms-migrations');
        $this->publishes([__DIR__.'/../../resources/views' => resource_path('views/vendor/slides')], 'typicms-views');
        $this->publishes([__DIR__.'/../../resources/scss' => resource_path('scss')], 'typicms-resources');

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('slides::public.*', function ($view): void {
            $view->page = getPageLinkedToModule('slides');
        });
    }
}
