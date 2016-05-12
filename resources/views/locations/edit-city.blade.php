@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $city->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Locations</a>
                </li>
                <li>
                    <a>Cities</a>
                </li>
                <li>
                    <a href="{{ route('locations.cities.all') }}">All</a>
                </li>
                <li class="active">
                    <strong>{{ $city->name }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit {{ $city->name }}</h5>
                    </div>
                    <div class="ibox-content">

                        @include('errors.list')

                        {!! Form::model($city, array('method' => 'PATCH', 'class' => 'form-horizontal', 'route' => ['locations.cities.update',$city->id])) !!}

                        @include('partials.forms.city-form', ['showStatusSection' => 'Yes' , 'submitButtonText' => 'Update City'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection