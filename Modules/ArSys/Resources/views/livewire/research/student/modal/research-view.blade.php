<!-- Modal -->
<div wire:ignore.self class="modal fade" id="researchViewModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Research</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if($researchData != null)
                    <div class="row">
                        <div class="col-sm-3">
                            <b>Research Code</b>
                        </div>
                        <div class="col-sm-9">
                            {{$researchData->research_code}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <b>Title</b>
                        </div>
                        <div class="col-sm-9">
                            {{$researchData->title}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <b>Abstract</b>
                        </div>
                        <div class="col-sm-9">
                            {{$researchData->abstract}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <b>File</b>
                        </div>
                        <div class="col-sm-9">
                            @if ($researchData->file != null)
                                <a href="{{url('/')}}{{ Storage::disk('local')->url($researchData->file->filename)}}" target="blank">{{$researchData->research_code}}.pdf</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                @if($researchData != null)
                    <button type="button" wire:click.prevent="$emit('researchEditComponent', {{$researchData->id}} )" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</button>
                @endif
            </div>

       </div>
    </div>
</div>
