<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    @include('arsys::livewire.supervise.modal.discussion-modal')
    <script>
        window.livewire.on('superviseDiscussionModal', () => {
           $('#superviseDiscussionModal').modal('show');
       });
   </script>
</div>
