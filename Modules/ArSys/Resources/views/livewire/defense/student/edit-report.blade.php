<div>
    @include('arsys::livewire.defense.student.modal.edit-report-modal')
    @include('arsys::livewire.sweetalert.success-alert')
   <script>
        window.livewire.on('defenseStudentEditReportModal', () => {
            $('#defenseStudentEditReportModal').modal('show');
        });
    </script>
</div>
