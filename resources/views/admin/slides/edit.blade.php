@extends('admin::core.master')

@section('title', $model->presentTitle())

@section('content')
    {!! BootForm::open()->put()->action(route('admin::update-slide', $model->id))->addClass('form') !!}
    {!! BootForm::bind($model) !!}
    @include('admin::slides._form')
    {!! BootForm::close() !!}
@endsection
