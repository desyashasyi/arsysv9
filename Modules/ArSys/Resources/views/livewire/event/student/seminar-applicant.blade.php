<div>
    @include('arsys::livewire.event.student.modal.seminar-applicant-modal')

    <script>
        window.livewire.on('eventSeminarApplicantModal_Student', () => {
            $('#eventSeminarApplicantModal_Student').modal('show');
        });
    </script>
</div>
