@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Admins</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Admins</a>
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
                        <h5>All Admins</h5>
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
                                    <th class="center-table">Role</th>
                                    <th class="center-table">Status</th>
                                    <th class="center-table">Created At</th>
                                    <th class="center-table">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($admins))
                                    @foreach($admins as $admin)
                                        @if (empty($admin->deleted_at))
                                            <tr>
                                                <td class="center-table">
                                                    <img class="img-table" src="{{ $admin->profile_picture }}"></img>
                                                </td>
                                                <td class="center-table">{{ $admin->name }}</td>
                                                <td class="center-table">{{ $admin->email }}</td>
                                                <td class="center-table">{{ $admin->mobile_number }}</td>
                                                <td class="center-table">{{ $admin->role }}</td>
                                                <td class="center-table">
                                                    @if ($admin->portal_active == 1)
                                                        <span class="label label-primary">Active</span>
                                                    @else
                                                        <span class="label label-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="center-table">{{ $admin->created_at }}</td>
                                                <td class="center-table">
                                                    <a href="{{ route('admins.show', $admin->id) }}"
                                                       class="btn btn-white btn-sm"><i
                                                                class="fa fa-folder-open"></i> View </a>
                                                    <a href="{{ route('admins.edit', $admin->id) }}"
                                                       class="btn btn-white btn-sm"><i class="fa fa-pencil"></i>
                                                        Edit </a>
                                                    {!! Form::open(array('method' => 'DELETE', 'style' => 'display: inline-block','route' => ['admins.destroy',$admin->id])) !!}
                                                    <button class="btn btn-sm btn-danger" type="button"
                                                            data-toggle="modal"
                                                            data-target="#confirmDelete"
                                                            data-title="Confirm Delete User"
                                                            data-message="Are you sure you want to delete this user?">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @else
                                            <tr class="danger">
                                                <td class="center-table">
                                                    <img class="img-table" src="{{ $admin->profile_picture }}"></img>
                                                </td>
                                                <td class="center-table">{{ $admin->name }}</td>
                                                <td class="center-table">{{ $admin->email }}</td>
                                                <td class="center-table">{{ $admin->mobile_number }}</td>
                                                <td class="center-table">{{ $admin->role }}</td>
                                                <td class="center-table">
                                                    @if ($admin->portal_active == 1)
                                                        <span class="label label-primary">Active</span>
                                                    @else
                                                        <span class="label label-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="center-table">{{ $admin->created_at }}</td>
                                                <td class="center-table">
                                                    <a href="{{ route('admins.show', $admin->id) }}"
                                                       class="btn btn-white btn-sm"><i
                                                                class="fa fa-folder-open"></i> View </a>
                                                    <a href="{{ route('admins.edit', $admin->id) }}"
                                                       class="btn btn-white btn-sm"><i class="fa fa-pencil"></i>
                                                        Edit </a>
                                                    {!! Form::open(array('method' => 'DELETE', 'style' => 'display: inline-block', 'route' => ['admins.destroy',$admin->id])) !!}
                                                    <button class="btn btn-sm btn-danger" type="button"
                                                            data-toggle="modal"
                                                            data-target="#confirmDelete"
                                                            data-title="Confirm Delete User"
                                                            data-message="Are you sure you want to delete this user?">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="8">
                                            Currently there are no admins in the system.
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row text-center">
                            {{ $admins->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.modals.delete')

@endsection