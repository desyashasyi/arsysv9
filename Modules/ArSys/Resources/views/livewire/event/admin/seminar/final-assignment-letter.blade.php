<div>
    @include('arsys::livewire.event.admin.seminar.modal.final-assigment-letter-modal')

    <script>
        window.livewire.on('addFinalAssignmentModal', () => {
           $('#addFinalAssignmentModal').modal('show');
       });

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

            window.addEventListener('resetProgramStudySelection', event => {
                $("#programStudy").empty().trigger('opening')
            });

        });
   </script>
   @include('arsys::livewire.sweetalert.success-alert')
   @include('arsys::livewire.sweetalert.error-alert')
</div>
