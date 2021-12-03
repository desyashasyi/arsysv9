<div>
    @include('arsys::livewire.event.admin.seminar.modal.add-room-modal')

    <script>
        window.livewire.on('seminarAddRoomModal', () => {
            $('#seminarAddRoomModal').modal('show');
        });

    </script>

<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){
    $( "#eventSessionSeminar" ).select2({
        placeholder: "Select session",
        allowClear: true,
        ajax: {
        url: "{{route('arsys.data.event-session-seminar')}}",
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
    $( "#eventSessionSeminar" ).on('change', function(e) {
    // Access to full data
        console.log($(this).select2('data'));
        var data = $('#eventSessionSeminar').select2("val");
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
