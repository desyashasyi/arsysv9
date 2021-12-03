<div>
    @include('arsys::livewire.review.specialization.modal.view-abstract-modal')
    <script>
        window.livewire.on('researchReviewViewAbstractModal', () => {
            console.log('view research');
            $('#researchReviewViewAbstractModal').modal('show');
        });
    </script>
</div>
