@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Event | Upcoming final defense
                </div>
                <div class="card-body">
                    @livewire('arsys::event.program.upcoming-seminar')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

