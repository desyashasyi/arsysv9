<div>
    @include('arsys::livewire.review.specialization.modal.set-reviewer-modal')

    <script>
        window.livewire.on('reviewSetReviewerModal', () => {
            $('#reviewSetReviewerModal').modal('show');
        });
    </script>
</div>
