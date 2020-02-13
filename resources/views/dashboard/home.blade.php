@extends('layouts.dashboard')

@section('content')
    @component('Template::components.page')
        @slot('title', trans('dashboard.home'))
        @slot('breadcrumbs', ['dashboard.home'])

    @endcomponent
@endsection

