@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <a href="{{ route('cart.view') }}" class="btn btn-outline-primary"> Back to Cart </a>

        <div class="row">
            <div class="col-md-6">
                <h2>Payment Details</h2>
                <div class="card mb-2">
                    <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" v-model="selected" value="delivery" name="pay-with-cash" id="delivery-cash">
                                <label class="form-check-label" for="delivery-cash">
                                    Cash on Delivery (Send location via WhatsApp $5 Delivery Fee)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" v-model="selected" value="pickup-cash" name="pickup-cash" id="pickup-cash">
                                <label class="form-check-label" for="pickup-cash">
                                    Cash during Pick-UP (Off Fox Hill round about-Scheduled)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" v-model="selected" value="bank-transfer" name="bank-transfer" id="bank-transfer">
                                <label class="form-check-label" for="bank-transfer">
                                    Online Bank Transfer (Receive Details via WhatsApp)
                                </label>
                            </div>
                            @if(auth()->user()->address != null)
                                {{-- <div v-if="selected === 'delivery'">
                                    <div>
                                        <h5>Saved Address</h5>
                                    <Address id="address" class="alert alert-info">
                                        {{ auth()->user()->address->street_address }} <br>
                                        {{ auth()->user()->address->city }}<br>
                                        {{ auth()->user()->address->island }}<br>
                                        <br>
                                        Delivery Notes: <br>
                                        {{ auth()->user()->address->delivery_notes }}
                                    </Address>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#address_update_form">Update Address</button>
                                    </div>
                                </div> --}}


                                <div v-if="selected === 'delivery'">
                                    {{-- Delivery Details
                                    <form class="form" method="POST" action="{{ route('address.create') }}">
                                        @csrf
                                        <div class="form-row mb-2">
                                            <div class="col-md">
                                                <input type="text" class="form-control" placeholder="Street Address" name="street_address" required>
                                            </div>
                                            <div class="col-md">
                                                <input type="text" class="form-control" placeholder="City" name="city" required>
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-md">
                                                <region-select v-model="region" name="island" :country="country" :region="region" region-name="true" class="form-control"  placeholder="Select Island" required />
                                            </div>
                                            <div class="col-md">
                                                <country-select v-model="country" :country="country" topCountry="US" class="form-control" disabled="true" name="country"  />
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label for="delivery_notes" class="label">Delivery Instructions</label>
                                            <textarea class="form-control" name="delivery_notes" rows="3" placeholder="If you are living on the family island please tell us which boat that you perfer."></textarea>
                                        </div>
                                        <button class="btn btn-primary btn-block mt-2" type="submit">Confirm Delivery Details</button>
                                    </form> --}}
                                    Send your location via
                                    <a href="https://wa.me/message/S3KDFRJOMKJHI1" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-block">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
                                </div>
                                @else
                                <div v-if="(selected === 'delivery') || (selected === 'pickup-cash') || (selected === 'bank-transfer')">
                                    {{-- Delivery Details
                                    <form class="form" method="POST" action="{{ route('address.create') }}">
                                        @csrf
                                        <div class="form-row mb-2">
                                            <div class="col-md">
                                                <input type="text" class="form-control" placeholder="Street Address" name="street_address" required>
                                            </div>
                                            <div class="col-md">
                                                <input type="text" class="form-control" placeholder="City" name="city" required>
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-md">
                                                <region-select v-model="region" name="island" :country="country" :region="region" region-name="true" class="form-control"  placeholder="Select Island" required />
                                            </div>
                                            <div class="col-md">
                                                <country-select v-model="country" :country="country" topCountry="US" class="form-control" disabled="true" name="country"  />
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label for="delivery_notes" class="label">Delivery Instructions</label>
                                            <textarea class="form-control" name="delivery_notes" rows="3" placeholder="If you are living on the family island please tell us which boat that you perfer."></textarea>
                                        </div>
                                        <button class="btn btn-primary btn-block mt-2" type="submit">Confirm Delivery Details</button>
                                    </form> --}}
                                    <a href="https://wa.me/message/S3KDFRJOMKJHI1" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-block">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
                                </div>
                            @endif
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <form method="POST" action="{{route('create_order')}}">
                    @csrf
                <h3>My Sugar Kart <i class="fas fa-shopping-cart"></i></h3>
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

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center mb-2">
                            <h4>
                                Subtotal: ${{ number_format(\Cart::session(Auth::user()->id)->getSubTotal(), 2, '.', ',' ) }}
                            </h4>
                            {{-- <h4 v-if="selected === 'delivery'">
                                Delivery: $5.00
                            </h4> --}}
                            <h4 v-if="selected === 'delivery'">
                                Total: ${{ number_format((\Cart::session(Auth::user()->id)->getTotal()), 2, '.', ',' )}}
                            </h4>
                            <h4 v-else>
                                Total: ${{ number_format(\Cart::session(Auth::user()->id)->getTotal(), 2, '.', ',' ) }}
                            </h4>
                        </div>
                        <button class="btn btn-success btn-block" v-if="selected != ''">Checkout</button>
                    </div>
                    <input type="hidden" name="payment_method" v-bind:value="selected">
                </form>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="address_update_form" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update Address</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @if(auth()->user()->address != null)
                {!! Form::model(auth()->user()->address, ['route' => ['address.update', 'user' => auth()->user()->id]]) !!}
                <div class="form-row mb-2">
                    <div class="col-md">
                        {!! Form::text('street_address', null, ['required' => 'true', 'class' => 'form-control', 'placeholder' => 'Street Address']) !!}
                    </div>
                    <div class="col-md">
                        {!! Form::text('city', null, ['required' => 'true', 'class' => 'form-control', 'placeholder' => 'City']) !!}
                    </div>
                </div>
                <div class="form-row mb-2">
                    <div class="col-md">
                        <region-select v-model="region" name="island" :country="country" :region="region" region-name="true" class="form-control"  placeholder="Select Island" required />
                    </div>
                    <div class="col-md">
                        <country-select v-model="country" :country="country" topCountry="US" class="form-control" disabled="true" name="country"  />
                    </div>
                </div>
                <div class="form-row">
                    <label for="delivery_notes" class="label">Delivery Instructions</label>
                    {!! Form::textarea('delivery_notes', null, ['rows' => '3', 'class' => 'form-control', 'placeholder' => 'If you are living on the family island please tell us which boat that you perfer.']) !!}
                </div>
                <button class="btn btn-primary btn-block mt-2" type="submit">Confirm Delivery Details</button>
                {!! Form::close() !!}
                @endif
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
@endsection

