<div>
    <div class="row">
        <div class="col-sm-12">
            <button wire:click="$emit('emiterConfigAdminAddConfig')" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Add Configuration</button>
        </div>
    </div>
    <br>
    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <tbody id="users-table">
                @php($number = 0)
                @forelse ($configs as $config)
                    <tr>
                        <td  width="5%">
                            {{++$number}}.
                        </td>
                        <td width="30%">
                            {{$config->code}}
                        </td>
                        <td>
                            {{$config->description}}
                        </td>
                        <td>
                            @if($config->status)
                                <button wire:click="setConfig({{$config->id}})" class="btn btn-sm"><i class="fa fa-lg fa-toggle-on" style ="color:green" aria-hidden="true"></i></button>
                            @else
                                <button wire:click="setConfig({{$config->id}})" class="btn btn-sm"><i class="fa fa-lg fa-toggle-off" aria-hidden="true" style ="color:gray"></i></button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan = "6">
                            No data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{$configs->links()}}
    @livewire('arsys::config.admin.add-config')
</div>
