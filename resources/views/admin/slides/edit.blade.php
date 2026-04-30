<x-core::layouts.admin :title="$model->presentTitle()" :model="$model">
    {!! BootForm::open()->put()->action(route('admin::update-slide', $model->id))->addClass('form') !!}
    {!! BootForm::bind($model) !!}
    @include('admin::slides._form')
    {!! BootForm::close() !!}
</x-core::layouts.admin>
