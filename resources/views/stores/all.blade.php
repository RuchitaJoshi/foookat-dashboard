@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Stores</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Stores</a>
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
                    <div style="min-height:65px;" class="ibox-title">
                        <h5>All Stores</h5>
                    </div>
                    <div class="ibox-content">

                        @include('flash::message')

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center-table">Store Name</th>
                                    <th class="center-table">Business</th>
                                    <th class="center-table">Address</th>
                                    <th class="center-table">Zip Code</th>
                                    <th class="center-table">Approved</th>
                                    <th class="center-table">Created At</th>
                                    <th class="center-table">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($stores))
                                    @foreach($stores as $store)
                                        <tr>
                                            <td class="center-table">{{ $store->name }}</td>
                                            <td class="center-table">{{ $store->business_name }}</td>
                                            <td class="center-table">{{ $store->address }}</td>
                                            <td class="center-table">{{ $store->zip_code }}</td>
                                            <td class="center-table">
                                                @if ($store->approved == 'Pending')
                                                    <span class="label label-warning">Pending</span>
                                                @elseif ($store->approved == 'Approved')
                                                    <span class="label label-primary">Approved</span>
                                                @else
                                                    <span class="label label-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td class="center-table">{{ $store->created_at }}</td>
                                            <td class="center-table">
                                                <a href="{{ route('stores.show', [$store->id]) }}"
                                                   class="btn btn-white btn-sm"><i
                                                            class="fa fa-folder-open"></i> View </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="7">
                                            Currently there are no stores in the system.
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row text-center">
                            {{ $stores->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection