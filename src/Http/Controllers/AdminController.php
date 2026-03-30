<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Slides\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Slides\Http\Requests\FormRequest;
use TypiCMS\Modules\Slides\Models\Slide;

final class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('slides::admin.index');
    }

    public function create(): View
    {
        $model = new Slide;

        return view('slides::admin.create', ['model' => $model]);
    }

    public function edit(Slide $slide): View
    {
        return view('slides::admin.edit', ['model' => $slide]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $slide = Slide::query()->create($request->validated());

        return $this->redirect($request, $slide)->withMessage(__('Item successfully created.'));
    }

    public function update(Slide $slide, FormRequest $request): RedirectResponse
    {
        $slide->update($request->validated());

        return $this->redirect($request, $slide)->withMessage(__('Item successfully updated.'));
    }
}
