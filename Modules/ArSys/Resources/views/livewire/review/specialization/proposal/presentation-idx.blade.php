@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Review | Presentation proposal
                </div>
                <div class="card-body">
                    @livewire('arsys::review.specialization.proposal.presentation')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
