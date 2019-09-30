@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Deals</h2>
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
                <li class="active">
                    <strong>Deals</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div style="min-height:65px;" class="ibox-title">
                        <h5>All Deals</h5>
                        <div style="display:inline-block;float: right">
                            <a href="{{ route('businesses.stores.deals.create', [$business->id, $store->id]) }}"
                               class="btn btn-primary btn-sm">
                                Create </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        @include('flash::message')

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center-table">Deal Name</th>
                                    <th class="center-table">Category</th>
                                    <th class="center-table">Status</th>
                                    <th class="center-table">Approved</th>
                                    <th class="center-table">Created At</th>
                                    <th class="center-table">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($deals))
                                    @foreach($deals as $deal)
                                        <tr>
                                            <td class="center-table">{{ $deal->name }}</td>
                                            <td class="center-table">{{ $deal->category }}</td>
                                            <td class="center-table">
                                                @if ($deal->status == 'Live Now')
                                                    <span class="label label-primary">Live Now</span>
                                                @else
                                                    <span class="label label-danger">Offline</span>
                                                @endif
                                            </td>
                                            <td class="center-table">
                                                @if ($deal->approved == 'Pending')
                                                    <span class="label label-warning">Pending</span>
                                                @elseif ($deal->approved == 'Approved')
                                                    <span class="label label-primary">Approved</span>
                                                @else
                                                    <span class="label label-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td class="center-table">{{ $deal->created_at }}</td>
                                            <td class="center-table">
                                                <a href="{{ route('businesses.stores.deals.show', [$business->id,$store->id,$deal->id]) }}"
                                                   class="btn btn-white btn-sm"><i
                                                            class="fa fa-folder-open"></i> View </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            Currently there are no deals in the system.
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row text-center">
                            {{ $deals->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection