@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Utilities | Sync research
                </div>
                <div class="card-body">
                    @livewire('arsys::utilities.admin.sync-research.home')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

