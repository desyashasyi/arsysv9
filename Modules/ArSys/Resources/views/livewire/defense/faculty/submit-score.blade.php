<div>
    @include('arsys::livewire.defense.faculty.modal.submit-score-modal')
    <script>
         window.livewire.on('defenseFacultySubmitScoreModal', () => {
            $('#defenseFacultySubmitScoreModal').modal('show');
        });
    </script>

    @include('arsys::livewire.sweetalert.error-alert')
    @include('arsys::livewire.sweetalert.success-alert')


</div>
