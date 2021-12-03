<div>
    @include('arsys::livewire.research.student.document.modal.document-submit-modal')
    @include('arsys::livewire.sweetalert.success-alert')
    <script>
        window.livewire.on('researchStudentDocumentModal', () => {
            $('#researchStudentDocumentModal').modal('show');
        });
    </script>
    {{-- livewire view --}}
</div>
