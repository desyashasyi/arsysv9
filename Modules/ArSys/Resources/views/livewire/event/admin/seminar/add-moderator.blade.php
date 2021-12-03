<div>
    @include('arsys::livewire.event.admin.seminar.modal.add-moderator-modal')

    <script>
        window.livewire.on('adminSeminarModeratorModal', () => {
            $('#adminSeminarModeratorModal').modal('show');
        });

    </script>
</div>
