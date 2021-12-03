<div>
    @include('arsys::livewire.user.admin.modal.add-role')

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
                    <th width="20%">Username</th>
                    <th width="30%">Identity</th>
                    <th width="15%">Roles</th>

                    <th class="text-right" width="30%">Action</th>
                </tr>
            </thead>
            <tbody id="users-table">
                @php($counter = 0)
               @forelse ($users as $user)
                    <tr>
                        <td> {{++$counter}} </td>
                        <td>{{$user->name}}</td>

                        <td>
                            @if(strlen($user->sso_username) < 9 && $user->student != null)
                            {{$user->student->first_name}} {{$user->student->last_name}}
                            @elseif($user->faculty != null)
                            {{$user->faculty->first_name}} {{$user->faculty->last_name}}
                            @endif

                        </td>

                        <td>
                            @if($user->student != null || $user->faculty != null)
                                @foreach ($user->roles as $role)
                                {{$role->display_name}}
                                <br>
                                @endforeach
                            @endif

                        </td>


                        <td class="text-right">
                            @if($user->faculty != null)
                                <button wire:click="assignRole({{$user->faculty->id}}, {{$user->id}})" data-toggle="modal" data-target="#setRole" class="btn btn-xs btn-success"><i class="fa fa-user fa-user-plus fa-xs" style ="color:black" aria-hidden="true"></i> Role</button>
                            @endif
                                <button wire:click="loginAs({{ $user->id }})" class="btn btn-xs btn-warning"><i class="fa fa-user fa-xs" style ="color:black" aria-hidden="true"></i> Login As</button>

                        </td>
                    </tr>
               @empty
                    No Data
               @endforelse
            </tbody>
        </table>
    </div>
    {{$users->links()}}
</div>
