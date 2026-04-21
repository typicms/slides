@extends('core::admin.master')

@section('title', $model->presentTitle())

@section('content')
    {!! BootForm::open()->put()->action(route('admin::update-slide', $model->id))->addClass('form') !!}
    {!! BootForm::bind($model) !!}
    @include('slides::admin._form')
    {!! BootForm::close() !!}
@endsection
