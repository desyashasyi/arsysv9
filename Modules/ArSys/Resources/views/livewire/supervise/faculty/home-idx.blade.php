@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Supervise | Research supervision
                </div>
                <div class="card-body">
                    @livewire('arsys::supervise.faculty.home')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript">

    window.livewire.on('defenseReportEditShow', () => {
         $('#defenseReportEdit').modal('show');
    });

    window.livewire.on('defenseReportSubmitShow', () => {
         $('#defenseReportSubmit').modal('show');
    });

    window.livewire.on('researchEditModal', () => {
         $('#researchEditModal').modal('show');
    });

    window.livewire.on('researchViewModal', () => {
         $('#researchViewModal').modal('show');
    });

    window.livewire.on('researchCreateModal', () => {
         $('#researchCreateModal').modal('show');
    });

    window.livewire.on('researchSuperviseModal', () => {
         $('#researchSuperviseModal').modal('show');
    });
    window.livewire.on('superviseDiscussionModal', () => {
         $('#superviseDiscussionModal').modal('show');
    });

    window.livewire.on('todoModal', () => {
         $('#todoModal').modal('show')
    });
    window.livewire.on('allTodoModal', () => {
         $('#allTodoModal').modal('show');
    });

    window.livewire.on('singleTodoModal', () => {
         $('#singleTodoModal').modal('show');
    });

    window.livewire.on('hideAll', () => {
         $('.modal').modal('hide');
    });



</script>

@endsection

