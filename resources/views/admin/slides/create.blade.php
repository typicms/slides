<x-core::layouts.admin :title="__('New slide')">
    {!! BootForm::open()->action(route('admin::index-slides'))->addClass('form') !!}
    @include('admin::slides._form')
    {!! BootForm::close() !!}
</x-core::layouts.admin>
