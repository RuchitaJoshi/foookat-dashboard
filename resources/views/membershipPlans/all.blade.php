@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Plans</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Plans</a>
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
                    <div class="col-lg-12">
                        <h3>Subscription Plans</h3>
                    </div>
                    <div class="col-md-4">
                        <div class="ibox">
                            <div class="ibox-content product-box">
                                <div style="color:white;font-size: 25px;background-color: #8a74b9;"
                                     class="product-imitation">
                                    {{ $membershipPlans[0]->name }}
                                </div>
                                <div class="product-desc">
                                    <span class="product-price">
                                        <i class="fa fa-inr"></i>{{ round($membershipPlans[0]->amount) }}
                                    </span>
                                    <span class="product-name">{{ $membershipPlans[0]->name }} includes</span>
                                    <ul class="list-group">
                                        <li class="list-group-item">1 Store</li>
                                        <li class="list-group-item">Unlimited Deals</li>
                                        <li class="list-group-item">Basic Reports</li>
                                    </ul>
                                    <div class="m-t text-righ">
                                        <a href="{{ route('businesses.create', ['plan' => $membershipPlans[0]->name]) }}"
                                           class="btn btn-xs btn-outline btn-primary">Sign
                                            Up <i class="fa fa-long-arrow-right"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ibox">
                            <div class="ibox-content product-box">
                                <div style="color:white;font-size: 25px;background-color: #efb57c;"
                                     class="product-imitation">
                                    {{ $membershipPlans[1]->name }}
                                </div>
                                <div class="product-desc">
                                    <span class="product-price">
                                        <i class="fa fa-inr"></i>{{ round($membershipPlans[1]->amount) }}
                                    </span>
                                    <span class="product-name">{{ $membershipPlans[1]->name }} includes</span>
                                    <ul class="list-group">
                                        <li class="list-group-item">Up to 5 Stores</li>
                                        <li class="list-group-item">Unlimited Deals</li>
                                        <li class="list-group-item">Detailed Reports</li>
                                    </ul>
                                    <div class="m-t text-righ">
                                        <a href="{{ route('businesses.create', ['plan' => $membershipPlans[1]->name]) }}"
                                           class="btn btn-xs btn-outline btn-primary">Sign
                                            Up <i class="fa fa-long-arrow-right"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ibox">
                            <div class="ibox-content product-box">
                                <div style="color:white;font-size: 25px;background-color: #3499e0;"
                                     class="product-imitation">
                                    {{ $membershipPlans[2]->name }}
                                </div>
                                <div class="product-desc">
                                    <span class="product-price">
                                        <i class="fa fa-inr"></i>{{ round($membershipPlans[2]->amount) }}
                                    </span>
                                    <span class="product-name"> {{ $membershipPlans[2]->name }} includes</span>
                                    <ul class="list-group">
                                        <li class="list-group-item">Up to 10 Stores</li>
                                        <li class="list-group-item">Unlimited Deals</li>
                                        <li class="list-group-item">Detailed Reports</li>
                                        <li class="list-group-item">Access to Customer Engagement</li>
                                        <li class="list-group-item">Foookat Promotions</li>
                                    </ul>
                                    <div class="m-t text-righ">
                                        <a href="{{ route('businesses.create', ['plan' => $membershipPlans[2]->name]) }}"
                                           class="btn btn-xs btn-outline btn-primary">Sign
                                            Up <i class="fa fa-long-arrow-right"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection