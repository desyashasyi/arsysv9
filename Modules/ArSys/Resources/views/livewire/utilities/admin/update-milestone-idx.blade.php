@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Utilities | Update milestone
                </div>
                <div class="card-body">
                    @livewire('arsys::utilities.admin.update-milestone')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

