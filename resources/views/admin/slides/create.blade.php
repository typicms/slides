@extends('admin::core.master')

@section('title', __('New slide'))

@section('content')
    {!! BootForm::open()->action(route('admin::index-slides'))->addClass('form') !!}
    @include('admin::slides._form')
    {!! BootForm::close() !!}
@endsection
