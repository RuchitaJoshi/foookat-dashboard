@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Businesses</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Businesses</a>
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
                        <h5>All Businesses</h5>
                    </div>
                    <div class="ibox-content">

                        @include('flash::message')

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center-table">Name</th>
                                    <th class="center-table">Owner</th>
                                    <th class="center-table">Address</th>
                                    <th class="center-table">Zip Code</th>
                                    <th class="center-table">Type</th>
                                    <th class="center-table">Status</th>
                                    <th class="center-table">Created At</th>
                                    <th class="center-table">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($businesses))
                                    @foreach($businesses as $business)
                                        @if (empty($business->deleted_at))
                                            <tr>
                                                <td class="center-table">{{ $business->name }}</td>
                                                <td class="center-table">{{ $business->owner_name }}</td>
                                                <td class="center-table">{{ $business->address }}</td>
                                                <td class="center-table">{{ $business->zip_code }}</td>
                                                <td class="center-table">{{ $business->type }}</td>
                                                <td class="center-table">
                                                    @if ($business->status == 'Pending')
                                                        <span class="label label-warning">Pending</span>
                                                    @elseif ($business->status == 'Approved')
                                                        <span class="label label-primary">Approved</span>
                                                    @else
                                                        <span class="label label-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td class="center-table">{{ $business->created_at }}</td>
                                                <td class="center-table">
                                                    <a href="{{ route('businesses.show', $business->id) }}"
                                                       class="btn btn-white btn-sm"><i
                                                                class="fa fa-folder-open"></i> View </a>
                                                </td>
                                            </tr>
                                        @else
                                            <tr class="danger">
                                                <td class="center-table">{{ $business->name }}</td>
                                                <td class="center-table">{{ $business->owner_name }}</td>
                                                <td class="center-table">{{ $business->address }}</td>
                                                <td class="center-table">{{ $business->zip_code }}</td>
                                                <td class="center-table">{{ $business->type }}</td>
                                                <td class="center-table">
                                                    @if ($business->status == 'Pending')
                                                        <span class="label label-warning">Pending</span>
                                                    @elseif ($business->status == 'Approved')
                                                        <span class="label label-primary">Approved</span>
                                                    @else
                                                        <span class="label label-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td class="center-table">{{ $business->created_at }}</td>
                                                <td class="center-table">
                                                    <a href="{{ route('businesses.show', $business->id) }}"
                                                       class="btn btn-white btn-sm"><i
                                                                class="fa fa-folder-open"></i> View </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="8">
                                            Currently there are no businesses in the system.
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row text-center">
                            {{ $businesses->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection