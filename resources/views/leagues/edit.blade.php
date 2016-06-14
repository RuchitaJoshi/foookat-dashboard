@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit {{ $league->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Leagues</a>
                </li>
                <li>
                    <a href="{{ route('leagues.all') }}">All</a>
                </li>
                <li>
                    <a href="{{ route('leagues.show', $league->id) }}">{{ $league->name }}</a>
                </li>
                <li class="active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit {{ $league->name }}</h5>
                    </div>
                    <div class="ibox-content">

                        @include('errors.list')

                        {!! Form::model($league, array('method' => 'PATCH', 'class' => 'form-horizontal', 'route' => ['leagues.update',$league->id])) !!}

                        @include('partials.forms.league-form', ['submitButtonText' => 'Update League'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection