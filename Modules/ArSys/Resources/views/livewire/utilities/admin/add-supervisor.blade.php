<div>
    @include('arsys::livewire.utilities.admin.modal.add-supervisor-modal')

    <script>
        window.livewire.on('UtilSetSupervisor', () => {
            $('#UtilSetSupervisor').modal('show');
        });
    </script>


</div>
