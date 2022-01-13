<div>
    @include('arsys::livewire.seminar.program.modal.edit-seminar-score-modal')
    <script>
         window.livewire.on('editSeminarScoreModal_Program', () => {
            $('#editSeminarScoreModal_Program').modal('show');
        });
       
    </script>

    @include('arsys::livewire.sweetalert.error-alert')
    @include('arsys::livewire.sweetalert.success-alert')


</div>
