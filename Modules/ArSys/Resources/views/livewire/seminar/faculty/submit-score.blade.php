<div>
    @include('arsys::livewire.seminar.faculty.modal.submit-score-modal')
    @include('arsys::livewire.seminar.faculty.modal.submit-score-supervisor-modal')
    <script>
         window.livewire.on('submitSeminarScoreModal', () => {
            $('#submitSeminarScoreModal').modal('show');
        });
        window.livewire.on('submitSeminarScoreSupervisorModal', () => {
            $('#submitSeminarScoreSupervisorModal').modal('show');
        });
    </script>

    @include('arsys::livewire.sweetalert.error-alert')
    @include('arsys::livewire.sweetalert.success-alert')


</div>
