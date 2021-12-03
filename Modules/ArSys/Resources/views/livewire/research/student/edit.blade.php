
<div>
    @include('arsys::livewire.research.student.modal.research-edit')

    <script>
      
        window.livewire.on('researchEditModal', () => {
            $('#researchEditModal').modal('show');
        });

        $(document).ready(function(){
            $( "#researchTypeEdit" ).select2({
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

            $( "#researchTypeEdit" ).on('change', function(e) {
            // Access to full data
                console.log($(this).select2('data'));
                var data = $('#researchTypeEdit').select2("val");
                window.livewire.emit('selectResearchTypeEdit', { researchType : data });

            });
        });


        window.addEventListener('resetResearchTypeEdit', event => {
            $("#researchTypeEdit").empty().trigger('opening')
        });
    </script>
</div>
