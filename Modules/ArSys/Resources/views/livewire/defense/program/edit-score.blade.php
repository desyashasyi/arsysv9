<div>
    @include('arsys::livewire.defense.program.modal.edit-score-modal')
    <script>
         window.livewire.on('editExaminerScoreModal', () => {
            $('#editExaminerScoreModal').modal('show');
        });

    </script>

    @include('arsys::livewire.sweetalert.error-alert')
    @include('arsys::livewire.sweetalert.success-alert')
</div>
