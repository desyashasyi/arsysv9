<div>
    @include('timetable::livewire.schedule.admin.modal.siak-input-modal')
    <script>
        window.livewire.on('adminScheduleSIAKInputModal', () => {
           $('#adminScheduleSIAKInputModal').modal('show');
       });
    </script>
</div>
