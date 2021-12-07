@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    User | Specialization - Login As
                </div>
                <div class="card-body">
                @livewire('arsys::user.specialization.login-as')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
