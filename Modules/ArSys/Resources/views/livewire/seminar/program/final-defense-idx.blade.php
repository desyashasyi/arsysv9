@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Seminar | Mark of Final Defense
                </div>
                <div class="card-body">
                    @livewire('arsys::seminar.program.final-defense')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

