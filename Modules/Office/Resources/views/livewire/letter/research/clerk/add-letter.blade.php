<div>
    @section('plugins.DateRangePicker', true)
    @include('office::livewire.letter.research.clerk.modal.add-letter-modal')
    <script>
        window.livewire.on('addResearchAssignmentLetterModal_Clerk', () => {
            $('#addResearchAssignmentLetterModal_Clerk').modal('show');
        });
    </script>
</div>
