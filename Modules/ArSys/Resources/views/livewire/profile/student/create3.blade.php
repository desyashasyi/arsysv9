<div>
    @include('arsys::livewire.profile.student.modal.create-modal')


    <script>
        window.livewire.on('createStudentProfileModal', () => {
            $('#createStudentProfileModal').modal('show');
        });

        window.addEventListener('resetEventTypeEdit', event => {
            $("#eventTypeEdit").empty().trigger('opening')
        });

        window.addEventListener('resetStudyProgram', event => {
            $("#programStudy").empty().trigger('opening')
        });
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            window.initTicketTypesDrop=()=>{
                $('#studyProgram').select2({
                    placeholder: "Select your option",
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
            }

            initTicketTypesDrop();
            $('#studyProgram').on('change', function (e) {
                localStorage.setItem('study_program',$(this).val());
                @this.set('study_program',$(this).val());
            });


        });

        window.livewire.on('select2',()=>{
            initTicketTypesDrop();
        });

        document.addEventListener("livewire:load", function(event) {

            Livewire.hook('message.processed', (message, component) => {
            if(localStorage.getItem('study_Program'))
            {
                $('#studyProgram').val(localStorage.getItem('study_program').split(','));
            }

        });
    });





    </script>
</div>


