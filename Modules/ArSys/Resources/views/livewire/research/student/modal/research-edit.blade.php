<!-- Modal -->
<div wire:ignore.self class="modal fade" id="researchEditModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable" >
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Research</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('arsys::livewire.message.message')
                <div class="row">
                </div>

                <form>
                <div class="form-group" wire:ignore>
                    <label for="researchFile">Research Type</label>
                    <br>
                    <select id='researchTypeEdit' style='width: 250px;'>
                    </select>
                </div>
            </form>

                @if($researchType != null)
                @if($researchType != \Modules\ArSys\Entities\ResearchType::where('code','PI')->first()->id)
                    @include('arsys::livewire.research.student.modal.research')
                @else
                    @include('arsys::livewire.research.student.modal.industrial') 
                @endif
            @endif
            </div>

            <div class="modal-footer">
            </div>

       </div>
    </div>
</div>
