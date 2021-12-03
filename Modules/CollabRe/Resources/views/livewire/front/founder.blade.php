<div>
    <style type="text/css">
        h1 {
            color:green;
        }
        .xyz {
            background-size: auto;
            text-align: center;
            padding-top: 100px;
        }
        .btn-circle.btn-sm {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            font-size: 8px;
            text-align: center;
        }
        .btn-circle.btn-md {
            width: 50px;
            height: 50px;
            padding: 7px 0px;
            border-radius: 25px;
            font-size: 20px;
            text-align: center;
        }
        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 12px;
            text-align: center;
        }
    </style>
    <div class="text-right">
        <button type="button" wire:click="editPage" class="btn btn-default btn-circle btn-sm"><i class="fa fa-sm fa-edit" aria-hidden="true"></i></button>
    </div>
    @if($collabre != null)
        @if($editPageStatus)
            <div class="text-center">
                <input type="text" class="text-center form-control" wire:model="collabreName" id="collabreName" placeholder="Enter first name">
                <br>
                <input type="text" class="text-center form-control" wire:model="collabreDescription" id="collabreDescription" placeholder="Enter first name">
                <br>
                <button type="button" wire:click="submitEditPage" class="btn btn-default btn-circle btn-md">OK</button>
            </div>
        @else
            <div class="text-center">
                <h2>
                    {{$collabre->name}}
                </h2>
                <h5>
                    {{$collabre->description}}
                </h5>
            </div>
            <hr>
            <div class="text-center">
                @foreach($members as $member)
                    <button type="button" wire:click="memberProfile" class="btn btn-default btn-circle btn-md">
                            <h6>
                                @if($member->student->first_name != null)
                                    {{$member->student->first_name[0]}}
                                @endif
                                @if($member->student->last_name != null)
                                    {{$member->student->last_name[0]}}
                                @endif
                            </h6>
                    </button>
                @endforeach
            </div>
        @endif
    @endif
    <hr>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div style="cursor:pointer" wire:click="todoList" class="text-center card-header">
                        <b>To-dos</b>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="text-center card-header">
                        <b>Message</b>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="text-center card-header">
                        <b>Schedule</b>
                    </div>
                    <div class="text-center card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
