<div>
    @include('timetable::livewire.schedule.admin.modal.import-modal')
    <script>
        window.livewire.on('importTimetableModal', () => {
           $('#importTimetableModal').modal('show');
       });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
                $( "#program" ).select2({
                    placeholder: "Select study program",
                    allowClear: true,
                    ajax: {
                        url: "{{route('timetable.data.study-program-second')}}",
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

                $( "#program" ).on('change', function(e) {
                // Access to full data
                    console.log($(this).select2('data'));
                    var data = $('#program').select2("val");
                    window.livewire.emit('selectProgram', { programId : data });

                });

                window.addEventListener('resetProgramSelection', event => {
                    $("#program").empty().trigger('opening')
                });
            });
    </script>
</div>
