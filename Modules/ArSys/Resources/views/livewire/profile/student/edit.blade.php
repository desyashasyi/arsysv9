<div>
    @include('arsys::livewire.profile.student.modal.edit-modal')
    <script>
        window.livewire.on('editStudentProfileModal', () => {
            $('#editStudentProfileModal').modal('show');
        });


        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $( "#editProgramStudy" ).select2({
                placeholder: "Select study program",
                allowClear: true,
                ajax: {
                    url: "{{route('arsys.data.study-program')}}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                        _token: CSRF_TOKEN,
                        search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                        results: response
                        };
                    },
                    cache: true
                }
            });

            $( "#editProgramStudy" ).on('change', function(e) {
            // Access to full data
                console.log($(this).select2('data'));
                var data = $('#editProgramStudy').select2("val");
                window.livewire.emit('selectEditStudyProgram', { studyProgramId : data });
            });

            $( "#editStudySpecialization" ).select2({
                placeholder: "Select specialization",
                allowClear: true,
                ajax: {
                url: "{{route('arsys.data.study-specialization')}}",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                    _token: CSRF_TOKEN,
                    search: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                    results: response
                    };
                },
                cache: true
                }
            });
            $( "#editStudySpecialization" ).on('change', function(e) {
            // Access to full data
                console.log($(this).select2('data'));
                var data = $('#editStudySpecialization').select2("val");
                window.livewire.emit('selectEditStudySpecialization', { studySpecializationId : data });

            });


            $( "#editSupervisor" ).select2({
                placeholder: "Select supervisor",
                allowClear: true,
                ajax: {
                url: "{{route('arsys.data.faculty')}}",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                    _token: CSRF_TOKEN,
                    search: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                    results: response
                    };
                },
                cache: true
                }
            });
            $( "#editSupervisor" ).on('change', function(e) {
            // Access to full data
                console.log($(this).select2('data'));
                var data = $('#editSupervisor').select2("val");
                window.livewire.emit('selectEditSupervisor', { supervisorId : data });

            });
        });

        window.addEventListener('setSelection', event => {
            console.log(event.detail.program_id);
            //var program_id = event.detail.program_id;
            //$("#editProgramStudy").select2('1');
            /*$("#studySpecialization").select2('data', { id:event.detail.specialization_id} ).trigger('opening')
            $("#supervisor").select2('data', { id:event.detail.supervisor_id} ).trigger('opening')
            */
        });

    </script>

    <script>
        const SwalModal = (icon, title, html) => {
            Swal.fire({
                icon,
                title,
                html
            })
        }

        const SwalConfirm = (icon, title, html, confirmButtonText, method, params, callback) => {
            Swal.fire({
                icon,
                title,
                html,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText,
                reverseButtons: true,
            }).then(result => {
                if (result.value) {
                    return livewire.emit(method, params)
                }

                if (callback) {
                    return livewire.emit(callback)
                }
            })
        }

        const SwalAlert = (icon, title, timeout = 7000) => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: timeout,
                onOpen: toast => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon,
                title
            })
        }

        document.addEventListener('DOMContentLoaded', () => {
            this.livewire.on('swal:modal', data => {
                SwalModal(data.icon, data.title, data.text)
            })

            this.livewire.on('swal:confirm', data => {
                SwalConfirm(data.icon, data.title, data.text, data.confirmText, data.method, data.params, data.callback)
            })

            this.livewire.on('swal:alert', data => {
                SwalAlert(data.icon, data.title, data.timeout)
            })
        })


        window.addEventListener('alert', event => {
            Swal.fire({
                title: event.detail.message ?? '',
                icon: event.detail.type ?? null,
                ...event.detail.options
            })
        });

        window.addEventListener('confirming', confirming => {
            window.addEventListener(confirming.detail, event => {
                Swal.fire({
                    confirmButtonText: event.detail.options.confirmButtonText ?? 'Yes',
                    ...event.detail.options
                }).then((result) => {
                    if (result.isConfirmed) { Livewire.emit(event.detail.onConfirmed); }
                    else { const cancelCallback = event.detail.onCancelled; if (!cancelCallback) { return; } Livewire.emit(cancelCallback) }
                })
            });
        });
</script>

@if (session()->has('livewire-alert'))
    <script>
        const flash = @json(session('livewire-alert'));
        Swal.fire({
            title: flash.message ?? '',
            icon: flash.type ?? null,
            ...flash.options
        })
    </script>
@endif
</div>
