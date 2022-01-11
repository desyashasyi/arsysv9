@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Space | Space administration
                </div>
                <div class="card-body">
                    @livewire('arsys::event.admin.space')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

