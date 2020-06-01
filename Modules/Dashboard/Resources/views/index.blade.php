@extends('layout::master')
@section('content')
    @component('layout::components.page')
        @slot('title', trans('dashboard::dashboard.home'))
        @slot('breadcrumbs', ['dashboard.home'])

    @endcomponent
@endsection
