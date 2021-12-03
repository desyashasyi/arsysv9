<div>
    @include('arsys::livewire.event.admin.common.modal.letter-number-modal')
    <script>
        window.livewire.on('eventAddLetterNumberModal', () => {
           $('#eventAddLetterNumberModal').modal('show');
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

            $(document).ready(function(){
                $( "#letterType" ).select2({
                    placeholder: "Select type of letter",
                    allowClear: true,
                    ajax: {
                        url: "{{route('arsys.data.letter-type')}}",
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
            });

            $( "#letterType" ).on('change', function(e) {
            // Access to full data
                console.log($(this).select2('data'));
                var data = $('#letterType').select2("val");
                window.livewire.emit('selectLetterType', { letterTypeId : data });

            });

            window.addEventListener('resetSelection', event => {
                $("#programStudy").empty().trigger('opening')
                $("#letterType").empty().trigger('opening')
            });

        });
   </script>
   @include('arsys::livewire.sweetalert.success-alert')
</div>
