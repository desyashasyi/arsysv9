<div>
    @include('timetable::livewire.curriculum.clerk.modal.import-subject-modal')
    <script>
        window.livewire.on('importSubjectModal', () => {
            $('#importSubjectModal').modal('show');
        });
    </script>
</div>
