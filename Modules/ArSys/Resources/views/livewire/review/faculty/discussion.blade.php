<div>
    {{-- livewire view --}}
    @include('arsys::livewire.review.faculty.modal.discussion-modal')

    <script type="text/javascript">

        window.livewire.on('submitReviewFacultyDiscussionModal', () => {
            $('#submitReviewFacultyDiscussionModal').modal('show');
        });

        window.livewire.on('hideAll', () => {
            $('.modal').modal('hide');
        });

    </script>

</div>
