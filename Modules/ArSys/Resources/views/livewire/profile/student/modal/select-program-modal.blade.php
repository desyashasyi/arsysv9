<!-- Modal -->
<div wire:ignore.self class="modal fade" id="selectProgramModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal modal-dialog-scrollable" role="document">
       <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="selectProgram">Select Study Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 offset-md-0">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th width="10%">Code</th>
                                    <th width="90%">Decsription</th>
                                    <th width="10%">Action</th>

                                </tr>
                                </thead>
                                <tbody id="users-table">
                                    @if($studyProgram != null)
                                        @foreach($studyProgram as $program)
                                            <tr>
                                                <td>
                                                    {{$program->code}}
                                                </td>
                                                <td>
                                                    {{$program->description}}
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
       </div>
    </div>
</div>
