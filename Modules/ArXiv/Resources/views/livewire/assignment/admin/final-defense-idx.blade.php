@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <b>ArXiv</b> | Assignment of Final defense
                </div>
                <div class="card-body">
                    @livewire('arxiv::assignment.admin.final-defense')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

