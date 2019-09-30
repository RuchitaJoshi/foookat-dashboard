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
                    <a>Users</a>
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
                        <h5>All Users</h5>
                    </div>
                    <div class="ibox-content">

                        @include('flash::message')

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center-table"></th>
                                    <th class="center-table">Name</th>
                                    <th class="center-table">Email</th>
                                    <th class="center-table">Mobile Number</th>
                                    <th class="center-table">Active</th>
                                    <th class="center-table">Created At</th>
                                    <th class="center-table">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($users))
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="center-table">
                                                <img class="img-table"
                                                     @if ($user->profile_picture) src="{{ $user->profile_picture }}"
                                                     @else src="{{ URL::asset('images/uploads/avatars/default.png') }}" @endif>
                                            </td>
                                            <td class="center-table">{{ $user->name }}</td>
                                            <td class="center-table">{{ $user->email }}</td>
                                            <td class="center-table">{{ $user->mobile_number }}</td>
                                            <td class="center-table">
                                                @if ($user->active == 1)
                                                    <span class="label label-primary">Active</span>
                                                @else
                                                    <span class="label label-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="center-table">{{ $user->created_at }}</td>
                                            <td class="center-table">
                                                <a href="{{ route('users.show', $user->id) }}"
                                                   class="btn btn-white btn-sm"><i
                                                            class="fa fa-folder-open"></i> View </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="7">
                                            Currently there are no users in the system.
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row text-center">
                            {{ $users->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection