<!-- Modal -->
<div wire:ignore.self class="modal fade" id="UtilSetSupervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supervisor Update</h5>
                <button wire:click="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        @if($research !=null)
                            <b>{{$research->research_code}} | {{$research->type->description}}</b>
                            <br>
                            {{$research->title}}
                            <br>
                            <br>

                            @if($research->supervisortemp != null)
                                <b>Supervisor</b>
                                <br>
                                    <i class="text-danger">Khusus untuk Skripsi/TA, Perhatikan urutan pembimbing sesuai dengan tugas pembimbing.
                                    Appakah dosen tersebut sebagai pembimbing pertama atau kedua.
                                    <br>
                                    <b>Jika sudah menambahkan pembimbing, silahkan tambahkan SK Pembimbing atau bukti bimbingan!</b>
                                    </i>
                                <br>
                                <br>
                                @php($counter = 0)
                                @foreach ($research->supervisortemp as $supervisor)
                                    <b>
                                    @if($counter == 0)
                                        {{++$counter}}st. Supervisor:
                                    @else
                                        {{++$counter}}nd. Supervisor:
                                    @endif
                                    </b>
                                    {{$supervisor->faculty->first_name}} {{$supervisor->faculty->last_name}}
                                    <button wire:click="unAssign({{ $researchId }}, {{ $supervisor->faculty->id }})" class="btn btn-xs"><i class="fa fa-user fa-user-minus" style ="color:red" aria-hidden="true"></i></button>
                                    |
                                    @if($supervisor->file != null)

                                        <a href="{{url('/')}}{{ Storage::disk('local')->url($supervisor->file)}}" target="blank">File availabale</a>
                                    @else
                                        File NULL
                                    @endif
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 offset-md-0">
                                            <div class="form-group">
                                                <input type="file" wire:model="supervisionFile">
                                                <button wire:click="storeFile({{$supervisor->id}})" class="btn btn-xs btn-success"> Attach file</button>
                                                <br>
                                                @error('supervisionFile') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 offset-md-0">
                        <input wire:model="search" type="text" class="my-3 form-control" placeholder="Search faculty name">
                    </div>
                </div>
                <div class="table-responsive users-table">
                    <table class="table table-striped table-sm data-table">
                        <thead class="thead">
                        <tr>
                            <th width="10%">Code</th>
                            <th width="40%">Name</th>
                            @if($research != null)
                                @if($research->type->research_model == 'defense')
                                    <th width="40%">Aggregate</th>
                                @endif
                            @endif
                            @if($research != null)
                                @if($research->type->research_model == 'seminar')
                                    <th width="40%">Aggregate</th>
                                @endif
                            @endif
                            <th class="text-right" width="10%">Action</th>

                        </tr>
                        </thead>
                        <tbody id="users-table">
                            @foreach ($faculties as $faculty)
                            <tr>
                                <td>
                                    {{$faculty->code}}
                                </td>
                                <td>
                                    {{$faculty->first_name}} {{$faculty->last_name}}
                                </td>

                                @if($research != null)
                                    @if($research->type->research_model == 'seminar')
                                        <td>Seminar Supervise</td>
                                    @endif
                                @endif
                                @if($research != null)
                                    @if($research->type->research_model == 'defense')
                                        <td>{{$faculty->defenseSupervisor->count()}}</td>
                                    @endif
                                @endif

                                <td class="text-right">
                                    <button wire:click="assign({{ $researchId }}, {{ $faculty->id }})" class="btn btn-xs"><i class="fa fa-user fa-user-plus" style ="color:green" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$faculties->links()}}


            </div>
            <div class="modal-footer">
            </div>
       </div>
    </div>

</div>
