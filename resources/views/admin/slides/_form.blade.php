<x-core::header :$model :back-url="$model->indexUrl()" :back-label="__('Slides')" :default-title="__('New slide')" />

<div class="form-body">
    <x-core::form-errors />

    <div class="row">
        <div class="col-lg-8">
            <div class="row gx-3">
                <div class="col-sm-6">{!! BootForm::text(__('Website'), 'website')->type('url')->placeholder('https://') !!}</div>
            </div>

            {!! BootForm::select(__('Page'), 'page_id', new TypiCMS\Modules\Core\Models\Page()->allForSelect()) !!}

            <div class="mb-3">{!! TranslatableBootForm::hidden('status')->value(0) !!} {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}</div>
            {!! TranslatableBootForm::textarea(__('Body'), 'body') !!}
        </div>
        <div class="col-lg-4">
            <div class="right-column">
                <file-manager></file-manager>
                <file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
            </div>
        </div>
    </div>
</div>
