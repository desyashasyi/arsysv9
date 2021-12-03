<div>
    @include('arsys::livewire.event.student.modal.applicant-modal')

    <script>
        window.livewire.on('studentEventApplicantModal', () => {
            $('#studentEventApplicantModal').modal('show');
        });
    </script>
</div>
