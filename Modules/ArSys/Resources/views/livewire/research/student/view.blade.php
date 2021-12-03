<div>
    @include('arsys::livewire.research.student.modal.research-view')
    <script>
        window.livewire.on('researchViewModal', () => {
            console.log('view research');
            $('#researchViewModal').modal('show');
        });
    </script>
</div>
