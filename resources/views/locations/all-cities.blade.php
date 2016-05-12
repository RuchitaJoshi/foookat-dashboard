@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All</h2>
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
                <li class="active">
                    <strong>All</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>All Cities</h5>
                    </div>
                    <div class="ibox-content">

                        @include('flash::message')

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center-table">Name</th>
                                    <th class="center-table">State</th>
                                    <th class="center-table">Created At</th>
                                    <th class="center-table">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($cities))
                                    @foreach($cities as $city)
                                        @if (empty($city->deleted_at))
                                            <tr>
                                                <td class="center-table">{{ $city->name }}</td>
                                                <td class="center-table">@if ($city->state) {{ $city->state->name }} @else Unavailable @endif</td>
                                                <td class="center-table">{{ $city->created_at }}</td>
                                                <td class="center-table">
                                                    <a href="{{ route('locations.cities.show', $city->id) }}" class="btn btn-white btn-sm"><i
                                                                class="fa fa-folder-open"></i> View </a>
                                                    <a href="{{ route('locations.cities.edit', $city->id) }}"
                                                       class="btn btn-white btn-sm"><i class="fa fa-pencil"></i>
                                                        Edit </a>
                                                    {!! Form::open(array('method' => 'DELETE', 'style' => 'display: inline-block', 'route' => ['locations.cities.destroy',$city->id])) !!}
                                                    <button class="btn btn-sm btn-danger" type="button"
                                                            data-toggle="modal"
                                                            data-target="#confirmDelete"
                                                            data-title="Confirm Delete City"
                                                            data-message="Are you sure you want to delete this city?">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @else
                                            <tr class="danger">
                                                <td class="center-table">{{ $city->name }}</td>
                                                <td class="center-table">@if ($city->state) {{ $city->state->name }} @else Unavailable @endif</td>
                                                <td class="center-table">{{ $city->created_at }}</td>
                                                <td class="center-table">
                                                    <a href="{{ route('locations.cities.show', $city->id) }}" class="btn btn-white btn-sm"><i
                                                                class="fa fa-folder-open"></i> View </a>
                                                    <a href="{{ route('locations.cities.edit', $city->id) }}"
                                                       class="btn btn-white btn-sm"><i class="fa fa-pencil"></i>
                                                        Edit </a>
                                                    {!! Form::open(array('method' => 'DELETE', 'style' => 'display: inline-block', 'route' => ['locations.cities.destroy',$city->id])) !!}
                                                    <button class="btn btn-sm btn-danger" type="button"
                                                            data-toggle="modal"
                                                            data-target="#confirmDelete"
                                                            data-title="Confirm Delete City"
                                                            data-message="Are you sure you want to delete this city?">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            Currently there are no cities in the system.
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row text-center">
                            {{ $cities->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.modals.delete')

@endsection