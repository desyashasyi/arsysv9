<div>
    @include('arsys::livewire.event.admin.modal.defense-setting-modal')

    <script>
        window.livewire.on('adminApplicantDefenseSettingModal', () => {
            $('#adminApplicantDefenseSettingModal').modal('show');
        });


    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $( "#eventSessionDefense" ).select2({
            placeholder: "Select session",
            allowClear: true,
            ajax: {
            url: "{{route('arsys.data.event-session-defense')}}",
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
        $( "#eventSessionDefense" ).on('change', function(e) {
        // Access to full data
            console.log($(this).select2('data'));
            var data = $('#eventSessionDefense').select2("val");
            window.livewire.emit('selectEventSessionSetting', { sessionId : data });

        });

        $( "#eventSpace" ).select2({
            placeholder: "Select space",
            allowClear: true,
            ajax: {
            url: "{{route('arsys.data.event-space')}}",
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
        $( "#eventSpace" ).on('change', function(e) {
        // Access to full data
            console.log($(this).select2('data'));
            var data = $('#eventSpace').select2("val");
            window.livewire.emit('selectEventSpaceSetting', { spaceId : data });

        });



    });

    window.addEventListener('resetSession', event => {
        $("#eventSession").empty().trigger('opening')
    });
    window.addEventListener('resetSpace', event => {
        $("#eventSpace").empty().trigger('opening')
    });
    </script>


</div>
