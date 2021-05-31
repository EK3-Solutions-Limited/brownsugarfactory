@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <a href="{{ route('storefront') }}" class="btn btn-outline-primary"> Back to store </a>

        <div class="row">
            <div class="col-md-10 mx-auto">
                <h2>
                    My Sugar Kart <i class="fas fa-shopping-cart"></i></h2>
                    @if(count($items) > 0)
                    <div class="card">
                        <div class="list-group">
                            @foreach ($items as $index => $item)
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            @if($item->associatedModel != null)
                                            <img class="img-thumbnail" height="150px" style="max-height: 150px" src="{{ $item->associatedModel->thumbnail }}">
                                            @endif
                                        </div>
                                        <div class="col-md-10">
                                            <h4>{{$item->name}}</h4>
                                            @if($item->associatedModel != null)
                                                <p>{{$item->associatedModel->description}}</p>
                                            @endif
                                            <h5>Qty {{$item->quantity}} &times; Price ${{number_format($item->price, 2, '.', ',')}} = ${{ number_format(($item->quantity * $item->price), 2, '.', ',') }}</h5>

                                            <div class="btn-toolbar">
                                                <div class="btn-group mr-3">
                                                    <form method="POST" action="{{ route('cart.addOne', $index) }}" >
                                                        <button class="btn btn-success btn-sm" type="submit">
                                                            <i class="fas fa-plus"></i>
                                                            Qty
                                                        </button>
                                                        @csrf
                                                    </form>

                                                <form method="POST" action="{{ route('cart.removeOne', $index) }}">
                                                    <button class="btn btn-warning btn-sm" type="submit">
                                                        <i class="fas fa-minus"></i>
                                                        Qty
                                                    </button>
                                                    @csrf
                                                </form>
                                                </div>

                                                <div class="btn-group">
                                                <form method="POST" action="{{ route('cart.remove', $index) }}">
                                                    <button class="btn btn-danger btn-sm" type="submit">
                                                        <i class="fas fa-trash"></i>
                                                        Remove Item
                                                    </button>
                                                    @csrf
                                                </div>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center mb-2">
                            <h6>
                                Subtotal: ${{ number_format(\Cart::session(Auth::user()->id)->getSubTotal(), 2, '.', ',' ) }}
                            </h6>
                            <h4>
                                Total: ${{ number_format(\Cart::session(Auth::user()->id)->getTotal(), 2, '.', ',' ) }}
                            </h4>
                        </div>
                    <a href="{{ route('checkout') }}" class="btn btn-primary btn-block btn-large">Let's Checkout</a>
                    <a href="{{ route('storefront')}}" class="btn btn-secondary btn-block btn-large">Continue Shopping</a>
                    </div>

                    @else
                    <div class="text-center">
                        <h2>
                            Your cart is empty...
                        </h2>
                    <a href="{{ route('storefront')}}" >
                        Let's go shopping :)
                    </a>
                    </div>
                    @endif

            </div>
        </div>
    </div>
@endsection

