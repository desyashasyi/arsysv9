<div>
    @include('arsys::livewire.event.admin.modal.change-applicant-modal')

    <script>
        window.livewire.on('changeApplicantModal', () => {
            $('#changeApplicantModal').modal('show');
        });
    </script>

</div>
