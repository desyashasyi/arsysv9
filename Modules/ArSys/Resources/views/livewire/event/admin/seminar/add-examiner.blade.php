<div>
    @include('arsys::livewire.event.admin.seminar.modal.add-examiner-modal')

    <script>
        window.livewire.on('adminSeminarExaminerModal', () => {
            $('#adminSeminarExaminerModal').modal('show');
        });

    </script>
</div>
