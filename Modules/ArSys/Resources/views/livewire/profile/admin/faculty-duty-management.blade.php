<div>
    @include('arsys::livewire.profile.admin.modal.add-duty-modal')
    <div class="row">
        <div class="col-md-3 offset-md-0">
            <input wire:model="search" type="text" class="my-1 form-control" placeholder="Search username">
        </div>
    </div>
    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
                <tr>

                    <th width="5%">No</th>
                    <th width="20%">First Name</th>
                    <th width="20%">Last Name</th>
                    <th width="30%">Duty</th>

                    <th class="text-right" width="30%">Action</th>
                </tr>
            </thead>
            <tbody id="users-table">
               @forelse ($faculties as $number => $faculty)
                    <tr>
                        <td> {{$faculties->firstItem() + $number}} </td>
                        <td>{{$faculty->first_name}}</td>
                        <td>{{$faculty->last_name}}</td>


                        <td>
                            @if($faculty->duty != null)
                                @foreach ($faculty->duty as $duty)
                                {{$duty->type->display_name}}
                                <br>
                                @endforeach
                            @endif
                            <button wire:click="addDuty({{$faculty->id}})" data-toggle="modal" data-target="#adminFacultyProfileAssignDuty" class="btn btn-xs"><i class="fa fa-user fa-user-plus fa-xs" style ="color:black" aria-hidden="true"></i> Add</button>

                        </td>


                        <td class="text-right">

                        </td>
                    </tr>
               @empty
                    No Data
               @endforelse
            </tbody>
        </table>
    </div>
    {{$faculties->render()}}
</div>
