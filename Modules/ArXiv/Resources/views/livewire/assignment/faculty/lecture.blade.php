<div>
    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
                <tr>

                    <th width="5%">No</th>
                    <th width="25%">Semester</th>
                    <th class="text-left" width="70%">Assignment Letter</th>
                </tr>
            </thead>
            <tbody id="users-table">
                @forelse ($academicYears as $number => $academicYear)
                    <tr>
                        <td>
                            {{++$number}}.
                        </td>
                        <td>
                            {{$academicYear->academic_year}}
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                @empty
                    No data
                @endforelse
            </tbody>
        </table>
    </div>
</div>
