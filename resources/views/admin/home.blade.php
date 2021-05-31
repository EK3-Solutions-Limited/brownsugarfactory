@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h1 class="m-5">
                            {{-- <router-link to="/products">Products</router-link> --}}
                        <a href="{{ route('admin.allProducts')}}">
                                <i class="fas fa-tags"></i>
                                Products
                            </a>
                        </h1>
                        <p>Hey hey</p>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h1 class="m-5">
                            {{-- <router-link>Orders</router-link> --}}
                        <a href="{{ route('admin.allOrders')}}">
                                <i class="fas fa-file-invoice-dollar"></i>
                                Orders
                            </a>
                        </h1>

                        Total: {{$ordersCount}} New: {{$newOrders}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
