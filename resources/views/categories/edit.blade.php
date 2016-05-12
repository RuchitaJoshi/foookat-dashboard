@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $category->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Categories</a>
                </li>
                <li>
                    <a href="{{ route('categories.all') }}">All</a>
                </li>
                <li class="active">
                    <strong>{{ $category->name }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit {{ $category->name }}</h5>
                    </div>
                    <div class="ibox-content">

                        @include('errors.list')

                        {!! Form::model($category, array('method' => 'PATCH', 'class' => 'form-horizontal', 'route' => ['categories.update',$category->id])) !!}

                        @include('partials.forms.category-form', ['showStatusSection' => 'Yes' , 'submitButtonText' => 'Update Category'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection