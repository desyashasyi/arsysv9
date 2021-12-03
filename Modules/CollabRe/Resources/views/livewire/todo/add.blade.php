<div>
    <style type="text/css">
        .form-control {
            border: 0;
        }
    </style>
    
    <div class="row">
        <div class="text-left col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="text-left col-md-12">
                            <input class="form-control" wire:model="title" aria-describedby="title" placeholder="Describe this to-do">
                            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="text-right col-sm-3">
                            Assign to
                        </div>
                        <div class="text-left col-sm-9">
                            <input class="form-control" wire:model="" aria-describedby="" placeholder="Describe this to-do">
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-sm-3">
                            Due on
                        </div>
                        @if($dueDateEnable == true)
                            <div class="text-left col-sm-9">
                                <div class="row">
                                    <div class="text-left col-sm-9">
                                        <div class="form-check">
                                            <input class="form-check-input" wire:model="dueOrNo" wire:change="checkDueOrNo" type="radio" name="exampleRadios" id="exampleRadios1" value="0" checked>
                                            <label class="form-check-label" for="exampleRadios1">
                                            No due date
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-left col-sm-5">
                                        <div class="form-check">
                                            <input class="form-check-input" wire:model="dueOrNo" wire:change="checkDueOrNo" type="radio" name="exampleRadios" id="exampleRadios1" value="1" checked>
                                            @if($dueOrNo == 1)
                                                <x-inputs.date id="dueDate" wire:model.debounce.0ms="dueDate" />
                                                @error('dueDate') <span class="text-danger">{{ $message }}</span>@enderror
                                            @else
                                                <label class="form-check-label" for="exampleRadios1">
                                                    On a specific date
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-left col-sm-12">
                                        <div class="form-check">
                                            <input class="form-check-input" wire:model="dueOrNo" wire:change="checkDueOrNo" type="radio" name="exampleRadios" id="exampleRadios1" value="2" checked>
                                            @if($dueOrNo == 2)
                                                <div class="row">
                                                    <div class="text-left col-sm-2">
                                                    <b>Start date:</b>
                                                    </div>
                                                    <div class="text-left col-sm-5">
                                                        <x-inputs.date id="startDate" wire:model.debounce.0ms="startDate" />
                                                        @error('startDate') <span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="text-left col-sm-2">
                                                        <b>End date:</b>
                                                    </div>
                                                    <div class="text-left col-sm-5">
                                                        <x-inputs.date id="endDate" wire:model.debounce.0ms="endDate" />
                                                        @error('endDate') <span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                            @else
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Range of date
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        @else
                            <div class="text-left col-sm-9">
                                <div style="color:grey; cursor:pointer" wire:click="dueDateSelector">
                                    <input class="form-control" placeholder="Please selecet the due date">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="text-right col-sm-3">
                            @if($enableTrixEditor)
                                <br>
                            @endif
                            Note
                        </div>
                        <div class="text-left col-sm-9">
                            <div style="color:grey; cursor:pointer" wire:click="enableTrixEditor">
                                @if($enableTrixEditor)
                                <br>
                                    <livewire:collabre::editor.trix :value="$notes">
                                    @error('notes') <span class="text-danger">{{ $message }}</span>@enderror
                                @else
                                    &nbsp;&nbsp;&nbsp;Add notes...
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="text-left col-md-12">
                            <button type="button" wire:click="save" class="btn btn-default btn-sm">
                                <i class="fa fa-sm fa-save" aria-hidden="true"></i>
                                Add this to-do
                            </button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
