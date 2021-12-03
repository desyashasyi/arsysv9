<div>
    <div class="row">
        <div class="col-sm-6 align-right">
            <button wire:click="$emit('clerkImportSubjectComponent')" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Import Curriculum</button>
        </div>
    </div>
    @livewire('timetable::curriculum.clerk.import-subject')

    <br>
    @if($subjects->isNotEmpty())
        <div class="row">
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                    <tr>
                        <th>
                            Nomor
                        </th>
                        <th>Kode Mata Kuliah
                        </th>
                        <th>
                            Nama Mata Kuliah
                        </th>
                    </tr>
                    </thead>
                    <tbody id="users-table">
                        @php($number = 0)
                        @foreach($subjects as $subject)
                            <tr>
                                <td>
                                    {{++$number}}
                                </td>
                                <td>
                                    {{$subject->subject_code}}
                                </td>
                                <td>
                                    {{$subject->subject_name}}
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    @else
        No subject data
    @endif
</div>
