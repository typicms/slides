<x-core::header :$model :back-url="$model->indexUrl()" :back-label="__('Slides')" :default-title="__('New slide')" />

<div class="form-body">
    <x-core::form-errors />

    <div class="row">
        <div class="lg:col-8">
            <div class="row gx-5">
                <div class="sm:col-6"><x-bootform::text :label="__('Website')" name="website" type="url" placeholder="https://" /></div>
            </div>

            <x-bootform::select :label="__('Page')" name="page_id" :options="new TypiCMS\Modules\Core\Models\Page()->allForSelect()" />

            <div class="mb-5">
                <x-transbootform::checkbox :label="__('Published')" name="status" :unchecked-value="0" />
            </div>
            <x-transbootform::textarea :label="__('Body')" name="body" />
        </div>
        <div class="lg:col-4">
            <div class="right-column">
                <file-manager></file-manager>
                <file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
            </div>
        </div>
    </div>
</div>
