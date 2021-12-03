@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Config | System configuration
                </div>
                <div class="card-body">
                    @livewire('arsys::config.admin.home')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection