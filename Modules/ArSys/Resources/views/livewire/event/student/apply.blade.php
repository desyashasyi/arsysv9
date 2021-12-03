<div>
    @include('arsys::livewire.event.student.modal.apply-event-modal')

    <script>
        window.livewire.on('studentEventApplyModal', () => {
            $('#studentEventApplyModal').modal('show');
        });
    </script>
</div>
