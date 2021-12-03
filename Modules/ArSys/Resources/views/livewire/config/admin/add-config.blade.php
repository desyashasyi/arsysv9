<div>
    @include('arsys::livewire.config.admin.modal.add-config-modal')

    <script>
        window.livewire.on('configAdminAddModal', () => {
            $('#configAdminAddModal').modal('show');
        });
    </script>
</div>
