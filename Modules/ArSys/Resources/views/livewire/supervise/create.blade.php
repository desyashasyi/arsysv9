<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    @include('arsys::livewire.supervise.modal.supervise-modal')
    <script>
         window.livewire.on('researchCreateSuperviseModal', () => {
            $('#researchCreateSuperviseModal').modal('show');
        });
    </script>
</div>
