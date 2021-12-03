<div>
    @include('arsys::livewire.research.student.modal.research-create')

    <script>
        window.livewire.on('researchCreateModal', () => {
            $('#researchCreateModal').modal('show');
        });


        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $( "#researchType" ).select2({
                placeholder: "Select research type",
                allowClear: true,
                ajax: {
                url: "{{route('arsys.data.research-type')}}",
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

            $( "#researchType" ).on('change', function(e) {
            // Access to full data
                console.log($(this).select2('data'));
                var data = $('#researchType').select2("val");
                window.livewire.emit('selectResearchType', { researchType : data });

            });
        });


        window.addEventListener('resetResearchType', event => {
            $("#researchType").empty().trigger('opening')
        });
    </script>
</div>
