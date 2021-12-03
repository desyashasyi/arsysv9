<div>
    <div>
        @livewire('timetable::subject.admin.import')
    </div>
    <div>
        <div wire:ignore class="row">
            <div class="col-md-4 offset-md-0">
                <div class="form-group">
                    <select class="study_program" id='programStudy' style='width: 260px;' name="study_program">
                    </select>
                    @error('study_program') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <div class="table-responsive users-table">
            <table class="table table-striped table-sm data-table">
                <tbody id="users-table">
                    @php($number = null)
                    @foreach($fets as $fet)
                        <tr>
                            <td width="5%">
                                {{++$number}}
                            </td>
                            <td width="15%">
                                {{$fet->component}}
                            </td>
                            <td width="58%">
                                {{$fet->description}}
                            </td>
                            <td width="12%">
                                <button type="button" wire:click="data({{$fet->id}})" class="btn btn-sm" >
                                    <i class="fa fa-eye"></i> View/Set
                                </button>
                            </td>
                            <td width="10%">
                                <button type="button" wire:click="export({{$fet->id}})"  class="btn btn-sm" >
                                    <i class="fa fa-file-export"></i> Export
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @livewire('timetable::fet.admin.teacher')
    <script>
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
        });
    </script>
</div>
