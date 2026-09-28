<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Slides\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    /** @return array<string, list<string>> */
    public function rules(): array
    {
        return [
            'website' => ['nullable', 'url', 'max:255'],
            'image_id' => ['nullable', 'integer', 'exists:files,id'],
            'page_id' => ['nullable', 'integer'],
            'title.*' => ['nullable', 'max:255'],
            'slug.*' => ['nullable', 'alpha_dash', 'max:255', 'required_if:status.*,1', 'required_with:title.*'],
            'status.*' => ['boolean'],
            'body.*' => ['nullable', 'max:20000'],
        ];
    }
}
