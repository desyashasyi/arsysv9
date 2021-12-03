<div>
    @include('arsys::livewire.review.specialization.modal.set-supervisor-modal')

    <script>
        window.livewire.on('reviewSetSupervisorModal', () => {
            $('#reviewSetSupervisorModal').modal('show');
        });
    </script>
</div>
