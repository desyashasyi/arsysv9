<div>
   @include('arsys::livewire.defense.student.modal.submit-report-modal')
   @include('arsys::livewire.sweetalert.success-alert')
   <script>
        window.livewire.on('defenseStudentSubmitReportModal', () => {
            $('#defenseStudentSubmitReportModal').modal('show');
        });
    </script>

</div>
