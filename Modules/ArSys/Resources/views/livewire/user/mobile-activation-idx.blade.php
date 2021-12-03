@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <b>User</b> | Mobile activation
                </div>
                <div class="card-body">
                    @if(Auth::user()->password == null)
                        @livewire('arsys::user.mobile-activation')
                    @else
                        Your mobile login already activated
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
