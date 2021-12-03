<div>
    @include('arsys::livewire.event.admin.common.modal.letter-time-modal')
    <script>
        window.livewire.on('eventLetterTimeModal', () => {
           $('#eventLetterTimeModal').modal('show');
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
        window.addEventListener('resetSpace', event => {
            $("#eventSpace").empty().trigger('opening')
        });
    </script>
</div>
