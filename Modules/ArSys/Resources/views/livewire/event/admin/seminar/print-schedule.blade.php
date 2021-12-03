<div>
    @include('arsys::livewire.event.admin.seminar.modal.print-schedule-modal')

    <script>
        window.livewire.on('eventAdminSeminarPrintScheduleModal', () => {
            $('#eventAdminSeminarPrintScheduleModal').modal('show');
        });
    </script>
</div>
