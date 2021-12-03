@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Defense | Mark of defense
                </div>
                <div class="card-body">
                    @livewire('arsys::defense.program.pre')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

