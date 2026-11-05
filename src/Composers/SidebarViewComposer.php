<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Slides\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use TypiCMS\Modules\Sidebar\SidebarGroup;
use TypiCMS\Modules\Sidebar\SidebarItem;
use TypiCMS\Modules\Sidebar\SidebarManager;

class SidebarViewComposer
{
    public function compose(View $view): void
    {
        $sidebar = $view->offsetGet('sidebar');

        if (! $sidebar instanceof SidebarManager) {
            return;
        }

        if (Gate::denies('read slides')) {
            return;
        }

        $sidebar->group(
            __(config()->string('typicms.modules.slides.sidebar.group', 'Content')),
            function (SidebarGroup $group): void {
                $group->id = 'content';
                $group->weight = 30;
                $group->addItem(
                    __(config()->string('typicms.modules.slides.sidebar.label', 'Slides')),
                    function (SidebarItem $item): void {
                        $item->id = 'slides';
                        $item->icon = config()->string('typicms.modules.slides.sidebar.icon');
                        $item->weight = config()->integer('typicms.modules.slides.sidebar.weight');
                        $item->route('admin::index-slides');
                    },
                );
            },
        );
    }
}
