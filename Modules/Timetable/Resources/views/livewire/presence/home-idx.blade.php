@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Lectures | Presence
                </div>
                <div class="card-body">
                    @livewire('timetable::presence.home')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

    window.livewire.on('editModal', () => {
         $('#editModal').modal('show');
    });
    window.livewire.on('recapModal', () => {
         $('#recapModal').modal('show');
    });

    window.livewire.on('addTeacherModal', () => {
         $('#addTeacherModal').modal('show');
    });

    window.livewire.on('importStudentModal', () => {
         $('#importStudentModal').modal('show');
    });
    window.livewire.on('importPresenceModal', () => {
         $('#importPresenceModal').modal('show');
    });
    
    window.livewire.on('addLectureModal', () => {
         $('#addLectureModal').modal('show');
    });

    window.livewire.on('hideAddLectureModal', () => {
         $('#addLectureModal').modal('hide');
    });


    window.livewire.on('hideAll', () => {
            $('.modal').modal('hide');
    });

    $('.modal').on('hidden.bs.modal', function () {
        window.livewire.emit('refreshComponent');
    });
</script>
@endsection
