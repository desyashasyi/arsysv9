<div>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $( "#documentType" ).select2({
                placeholder: "Select research type",
                allowClear: true,
                ajax: {
                url: "{{route('arsys.data.document-type')}}",
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

            $( "#documentType" ).on('change', function(e) {
            // Access to full data
                console.log($(this).select2('data'));
                var data = $('#documentType').select2("val");
                window.livewire.emit('selectdocumentType', { documentType : data });

            });
        });


        window.addEventListener('resetDocumentType', event => {
            $("#documentType").empty().trigger('opening')
        });
    </script>
</div>
