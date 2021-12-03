<div>
    @include('arsys::livewire.profile.student.modal.create-modal')


    <script>
        window.livewire.on('createStudentProfileModal', () => {
            $('#createStudentProfileModal').modal('show');
        });


        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $( "#programStudy" ).select2({
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

            $( "#programStudy" ).on('change', function(e) {
            // Access to full data
                console.log($(this).select2('data'));
                var data = $('#programStudy').select2("val");
                window.livewire.emit('selectStudyProgram', { studyProgramId : data });

            });

            $( "#studySpecialization" ).select2({
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
            $( "#studySpecialization" ).on('change', function(e) {
            // Access to full data
                console.log($(this).select2('data'));
                var data = $('#studySpecialization').select2("val");
                window.livewire.emit('selectStudySpecialization', { studySpecializationId : data });

            });


            $( "#supervisor" ).select2({
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
            $( "#supervisor" ).on('change', function(e) {
            // Access to full data
                console.log($(this).select2('data'));
                var data = $('#supervisor').select2("val");
                window.livewire.emit('selectSupervisor', { supervisorId : data });

            });
        });

        //$("#mySelect2").select2('data', { id:"elementID", text: "Hello!"});


        window.addEventListener('resetSelection', event => {
            $("#programStudy").empty().trigger('opening')
            $("#studySpecialization").empty().trigger('opening')
            $("#supervisor").empty().trigger('opening')
        });

    </script>
</div>


