<div>
    {{-- livewire view --}}
    @include('arsys::livewire.review.specialization.modal.discussion-modal')

    <script type="text/javascript">

        window.livewire.on('reviewDiscussionModal_specialization', () => {
            $('#reviewDiscussionModal_specialization').modal('show');
        });

        window.livewire.on('hideAll', () => {
            $('.modal').modal('hide');
        });

    </script>

</div>
