@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>CollabRe</b> | Front Page
                </div>
                <div class="card-body">
                    @livewire('collabre::front.founder')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

