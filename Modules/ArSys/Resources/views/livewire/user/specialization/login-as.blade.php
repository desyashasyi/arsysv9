<div>
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
                            @endif

                        </td>

                        <td>
                            @if($user->student != null)
                                @foreach ($user->roles as $role)
                                {{$role->display_name}}
                                <br>
                                @endforeach
                            @endif

                        </td>


                        <td class="text-right">
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
