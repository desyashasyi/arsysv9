<div>
    @include('arsys::livewire.seminar.faculty.modal.submit-score-modal')
    <script>
         window.livewire.on('submitSeminarScoreModal', () => {
            $('#submitSeminarScoreModal').modal('show');
        });
    </script>

    @include('arsys::livewire.sweetalert.error-alert')
    @include('arsys::livewire.sweetalert.success-alert')


</div>
