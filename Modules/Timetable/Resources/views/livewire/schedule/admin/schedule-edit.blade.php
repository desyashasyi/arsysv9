<div>
    {{-- livewire view --}}

    @include('timetable::livewire.schedule.admin.modal.schedule-edit-modal')
    <script>
        window.livewire.on('editScheduleModal_Admin', () => {
           $('#editScheduleModal_Admin').modal('show');
       });
    </script>
</div>
