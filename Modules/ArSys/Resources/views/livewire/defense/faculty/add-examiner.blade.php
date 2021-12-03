<div>
    @include('arsys::livewire.defense.faculty.modal.add-examiner-modal')
    <script>
         window.livewire.on('defenseFacultyAddExaminerModal', () => {
            $('#defenseFacultyAddExaminerModal').modal('show');
        });
    </script>

    @include('arsys::livewire.sweetalert.success-alert')

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            @this.on('removeExaminer', examinerId => {
                Swal.fire({
                    title: 'Are You Sure?',
                    text: 'The examiner will be removed!',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Remove!'
                }).then((result) => {
             //if user clicks on delete
                    if (result.value) {
                 // calling destroy method to delete
                        @this.call('removeExaminer',examinerId)
                 // success response
                    }
                });
            });
        })
    </script>
</div>
