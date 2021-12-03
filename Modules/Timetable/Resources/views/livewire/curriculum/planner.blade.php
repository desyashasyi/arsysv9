<div>
    <div class="row">
        <div class="col-sm-3">
            <button wire:click="addSubject" class="btn btn-sm"><i class="fas fa-search"></i> Year: </button>
        </div>
        <div class="col-sm-3">
            <button wire:click="addSubject" class="btn btn-sm"><i class="fas fa-seacrh"></i> Program: </button>
        </div>
        <div class="col-sm-6 align-right">
            <button wire:click="importCurriculum" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Import Curriculum</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
        <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th width="2%">No.</th>
                <th width="5%">Curriculum</th>
                <th width="10%">Program</th>
                <th width="10%">Specialization</th>
                <th width="5%">Code</th>
                <th width="50%">Subject</th>
                <th width="10%">Type</th>
                <th width="10%"></th>

            </tr>
            </thead>
            <tbody id="users-table">
                <tr>

                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    
                </tr>
            </tbody>
        </table>
    </div>
        </div>
    </div>
    
    <br>
</div>
