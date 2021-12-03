<div>
    @include('arsys::livewire.research.specialization.modal.set-supervisor-modal')

    <script>
        window.livewire.on('inProgressSetSupervisorModal', () => {
            $('#inProgressSetSupervisorModal').modal('show');
        });
    </script>
</div>
