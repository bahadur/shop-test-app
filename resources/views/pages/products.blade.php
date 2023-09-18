@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Products') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul class="list-group">
                            @foreach($products as $product)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{asset('images/' . $product->image )}}" style="width: 88px" /><h3>{{ $product->name }}</h3>
                                        <p class="fw-semibold">{{ $product->price }}</p>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('checkout', ['id' => $product->id]) }}" class="btn btn-primary">Buy</a>
                                    </div>
                                </div>


                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
