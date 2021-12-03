<div>
    {{-- livewire view --}}
    @include('arsys::livewire.research.student.modal.review-discussion-modal')

    <script type="text/javascript">

        window.livewire.on('reviewDiscussionModal_Student', () => {
            $('#reviewDiscussionModal_Student').modal('show');
        });

        window.livewire.on('hideAll', () => {
            $('.modal').modal('hide');
        });

    </script>

</div>
