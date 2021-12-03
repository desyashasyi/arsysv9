<!-- Modal -->
<div wire:ignore.self class="modal fade" id="researchStudentDocumentModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Document |
                    @if($fileType != null)
                        {{\Modules\ArSys\Entities\ResearchFileType::where('id', $fileType)->first()->description}}
                    @endif
                </h5>
                <button type="button" wire:click="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('arsys::livewire.message.message')

                @if($research != null)
                    <div class="row">
                        <div class="col-sm-12">
                            <b>{{$research->research_code}}</b>
                            <br>
                            {{$research->title}}
                        </div>
                    </div>
                    <hr>
                    <div class="text-danger">
                        <i>
                            If you resubmit the document file, the old document file will be replaced!
                        </i>
                        <br>
                        <br>
                        @if($fileType == \Modules\ArSys\Entities\ResearchFileType::where('code', 'SPV')->first()->id
                            ||
                            $fileType == \Modules\ArSys\Entities\ResearchFileType::where('code', 'COSPV')->first()->id
                            )
                            Max size: 2MB,
                        @elseif($fileType == \Modules\ArSys\Entities\ResearchFileType::where('code', 'DRAFTTHESIS')->first()->id
                            ||
                            $fileType == \Modules\ArSys\Entities\ResearchFileType::where('code', 'THESIS')->first()->id
                            )
                            Max size: 10MB,
                        @elseif($fileType == \Modules\ArSys\Entities\ResearchFileType::where('code', 'PDFART')->first()->id)
                            Max size: 5MB,
                        @endif
                        if you have problem to upload the document file(s), please compress/resize it!
                    </div>
                    <hr>
                    @if($fileType == \Modules\ArSys\Entities\ResearchFileType::where('code', 'SPV')->first()->id
                        ||
                        $fileType == \Modules\ArSys\Entities\ResearchFileType::where('code', 'COSPV')->first()->id
                        )
                        <div class="row">
                            <div class="col-sm-12">
                                @if($fileType == \Modules\ArSys\Entities\ResearchFileType::where('code', 'SPV')->first()->id)
                                    {{\Modules\ArSys\Entities\ResearchFileType::where('code', 'SPV')->first()->message}}
                                @elseif($fileType == \Modules\ArSys\Entities\ResearchFileType::where('code', 'COSPV')->first()->id)
                                    {{\Modules\ArSys\Entities\ResearchFileType::where('code', 'COSPV')->first()->message}}
                                @endif
                                <br>
                                <b>
                                @if($fileType == \Modules\ArSys\Entities\ResearchFileType::where('code', 'SPV')->first()->id)
                                    {{$research->supervisor->first()->faculty->front_title}}
                                    {{$research->supervisor->first()->faculty->first_name}}
                                    {{$research->supervisor->first()->faculty->last_name}}
                                    {{$research->supervisor->first()->faculty->rear_title}}
                                @elseif($fileType == \Modules\ArSys\Entities\ResearchFileType::where('code', 'COSPV')->first()->id)
                                    {{$research->supervisor->last()->faculty->front_title}}
                                    {{$research->supervisor->last()->faculty->first_name}}
                                    {{$research->supervisor->last()->faculty->last_name}}
                                    {{$research->supervisor->last()->faculty->rear_title}}
                                @endif
                                </b>
                            </div>
                        </div>
                        <hr>


                    @endif
                    <form wire:submit.prevent="documentStore">
                        <input type="file" wire:model="documentFile">
                        <br>
                        @error('documentFile') <span class="text-danger">{{ $message }}</span> @enderror
                    </form>

                    <div wire:loading wire:target="documentFile" class="mx-auto text-xs">Uploading...</div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="documentStore" class="btn btn-success btn-sm" ><i class="fa fa-paper-plane"></i> Submit</button>
            </div>
       </div>
    </div>
</div>
