
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                            @if(!$isAdmin)
                            @foreach($userRoles as $role)
                                <div class="alert alert-success mt-5" role="alert">
                                    <h4 class="alert-heading">{{ str()->upper($role) }}</h4>

                                </div>

                            <ul class="list-group">
                                @foreach($paymentMethods as $paymentMethod)
                                <li class="list-group-item">
                                    {{ $paymentMethod->card->last4 }}
                                    </li>
                                @endforeach

                            </ul>
                            @endforeach
                            @else

                                    <div class="alert alert-success mt-5" role="alert">
                                        <h4 class="alert-heading">Admin</h4>

                                    </div>

                                    <ul class="list-group">
                                        @foreach($users as $user)
                                            <li class="list-group-item">
                                                <div>{{ $user->name }}</div>
                                                <div class="pull-right">
                                                    @if($user->isActive())
                                                        <a class="btn btn-link" href="{{ route('cancel-access', ['id' => $user->id]) }}">Cancel Access</a>
                                                    @else
                                                        Access Canceled
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

