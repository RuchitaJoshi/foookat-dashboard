@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $store->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Businesses</a>
                </li>
                <li>
                    <a href="{{ route('businesses.all') }}">All</a>
                </li>
                <li>
                    <a href="{{ route('businesses.show', $business->id) }}">{{ $business->name }}</a>
                </li>
                <li class="active">
                    <a href="{{ route('businesses.stores', $business->id) }}">Stores</a>
                </li>
                <li class="active">
                    <strong>{{ $store->name }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Store</h5>
                    </div>
                    <div class="ibox-content">

                        @include('errors.list')

                        {!! Form::model($store, array('method' => 'PATCH', 'class' => 'form-horizontal', 'route' => ['businesses.stores.update', $business->id, $store->id])) !!}

                        @include('partials.forms.store-form', ['showActiveSection' => 'Yes', 'showStatusSection' => 'Yes', 'submitButtonText' => 'Update Store'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection