<div>
    @include('arsys::livewire.review.specialization.modal.set-supervisor-external-modal')

    <script>
        window.livewire.on('reviewSetExternalSupervisorModal', () => {
            $('#reviewSetExternalSupervisorModal').modal('show');
        });
    </script>
</div>
