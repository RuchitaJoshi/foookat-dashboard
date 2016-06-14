@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit {{ $deal->name }}</h2>
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
                <li>
                    <a href="{{ route('businesses.stores', $business->id) }}">Stores</a>
                </li>
                <li>
                    <a href="{{ route('businesses.stores.show', [$business->id, $store->id]) }}">{{ $store->name }}</a>
                </li>
                <li>
                    <a href="{{ route('businesses.stores.deals', [$business->id, $store->id]) }}">Deals</a>
                </li>
                <li>
                    <a href="{{ route('businesses.stores.deals.show', [$business->id, $store->id, $deal->id]) }}">{{ $deal->name }}</a>
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
                        <h5>Edit Deal</h5>
                    </div>
                    <div class="ibox-content">

                        @include('errors.list')

                        {!! Form::model($deal, array('method' => 'PATCH', 'class' => 'form-horizontal', 'files' => true, 'route' => ['businesses.stores.deals.update', $business->id, $store->id, $deal->id])) !!}

                        @include('partials.forms.deal-form',  ['showActiveSection' => 'Yes', 'showApprovedSection' => 'Yes', 'submitButtonText' => 'Update Deal'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection