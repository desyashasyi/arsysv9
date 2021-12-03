<!-- Modal -->


<div wire:ignore.self class="modal fade" id="addResearchAssignmentLetterModal_Clerk" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Letter of Research Assignment</h5>
                    <button wire:click="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('office::livewire.message.message')
                    @if($research)
                        {{-- Minimal --}}
                        {{$research->student->program->code}}.{{$research->student->student_number}}
                        <br>
                        {{$research->student->first_name}} {{$research->student->lats_name}}
                        <hr>
                        {{$research->research_code}}
                        <br>
                        {{$research->title}}
                        <hr>
                        <div class="form-group">
                            <label for="letterNumber">Number of Letter Assignment</label>
                            <br>
                            <div class="row">
                                <div class="col-md-6 offset-md-0">
                                    <input wire:model = "letterNumber" class="form-control">
                                    @error('letterNumber') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="letterDate">Date of Letter</label>
                            <br>
                            <div class="row">
                                <div class="col-md-6 offset-md-0">
                                    <p>{{$letterDate}}<p>
                                    <div class="form-group">
                                        <x-inputs.date id="letterDate" wire:model.debounce.0ms="letterDate" />
                                        @error('letterDate') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <hr>
                        <button wire:click="saveLetter" class="btn btn-success btn-sm">
                            <i class="fas fa-save"></i>
                                Submit
                        </button>
                    @endif
                </div>
                <div class="modal-footer">
                    <i>Office Module of ArSys</i>
                </div>
        </div>
    </div>
</div>
