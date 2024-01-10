@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">Order Listing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Product Listing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">Customer Listing</a>
            </li>
        </ul>
        <div class="col-md-12 mt-2">
            <div class="tab-content">
                <div class="tab-pane {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    @yield('order_content')
                </div>
                <div class="tab-pane {{ request()->routeIs('products.*') ? 'active' : '' }}">
                    @yield('product_content')
                </div>
                <div class="tab-pane {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                    @yield('customer_content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
