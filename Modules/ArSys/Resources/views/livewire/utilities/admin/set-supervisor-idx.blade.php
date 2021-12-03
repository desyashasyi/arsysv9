@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Utilities | Set supervisor
                </div>
                <div class="card-body">
                    @livewire('arsys::utilities.admin.set-supervisor')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

