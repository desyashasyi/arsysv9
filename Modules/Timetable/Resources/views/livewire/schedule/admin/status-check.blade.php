<div>
    @include('timetable::livewire.schedule.admin.modal.check-status-modal')
    <script>
        window.livewire.on('adminScheduleCheckStatusModal', () => {
           $('#adminScheduleCheckStatusModal').modal('show');
       });
    </script>
</div>
