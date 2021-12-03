<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day --}}

    <div class="row">
        <div class="col-md-12 offset-md-0">
            <i style ="color:red"> Karena web framework yang digunakan telah diupdate, dan ada script yang perlu penyesuaian/error (tetapi bukan prioritas untuk diselesaikan), maka menyebabkan data dosen wali tidak bisa disearch
            <br>
            Untuk itu, bagi mahasiswa yang akan submit proposal dan terhenti karena saat submit profile tidak ada pilihan dosen walinya, abaikan dulu. Pilih dosen wali yang tersedia, sehingga profile tetap bisa diinput, dan dapat segera submit proposal penelitian.
            <br>
            Sampai saat ini, data dosen wali belum digunakan untuk keperluan apapun.
            </i>
        </div>
    </div>
    <hr>

    @if($profile === null)
        <div class="row">
            <div class="col-sm-12">
                <button wire:click="$emit('createStudentProfileComponent')" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Create</button>
            </div>
        </div>

    @else
    <div class="row">
        <div class="col-md-4 offset-md-0">
            <div class="form-group">
                <label for="supervisor" class="control-label">Study Program</label>

                <div>
                    <input type="text" class="form-control bg-light text-dark"
                        @if($profile->program != null)
                            value="{{$profile->program->code}} {{$profile->program->description}}"
                        @endif
                    readonly>
                </div>
            </div>
        </div>

        <div class="col-md-4 offset-md-0">
            <div class="form-group">
                <label for="supervisor" class="control-label">Specialization</label>

                <div>
                    <input type="text" class="form-control bg-light text-dark"
                        @if($profile->specialization != null)
                            value="{{$profile->specialization->code}} {{$profile->specialization->description}}"
                        @endif
                    readonly>
                </div>
            </div>
        </div>

        <div class="col-md-4 offset-md-0">
            <div class="form-group">
            <label for="task" class="control-label">Student Number</label>
                <div>
                    <input type="text" name="student_number" id="student_number" class="form-control bg-light text-dark" value="{{$profile->student_number}}" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 offset-md-0">
            <div class="form-group">
                <label for="supervisor" class="control-label">First Name</label>

                <div>
                    <input type="text" class="form-control bg-light text-dark" value="{{$profile->first_name}}" readonly>
                </div>
            </div>
        </div>

        <div class="col-md-4 offset-md-0">
            <div class="form-group">
            <label for="task" class="control-label">Last Name</label>
                <div>
                    <input type="text" name="student_number" id="student_number" class="form-control bg-light text-dark" value="{{$profile->last_name}}" readonly>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-5 offset-md-0">
            <div class="form-group">
                <label for="supervisor" class="control-label">Academic Supervisor</label>

                <div>
                    @if($profile->supervisor != null)
                        <input type="text" class="form-control bg-light text-dark" value="{{$profile->supervisor->front_title}} {{$profile->supervisor->first_name}} {{$profile->supervisor->last_name}} {{$profile->supervisor->rear_title}}" readonly>
                    @else
                        <i class="fa fa-exclamation-triangle fa-xs" style ="color:red" aria-hidden="true"></i>
                        <i>You should update your academic supervisor</i>
                    @endif
                </div>
            </div>
        </div>



        <div class="col-md-3 offset-md-0">
            <label for="phone_number" class="control-label ">Phone Number</label>
            <div>
                <input type="text" name="phone" id="phone" class="form-control bg-light text-dark" value="{{$profile->phone}}" readonly>
            </div>
        </div>

        <div class="col-md-4 offset-md-0">
            <label for="email" class="control-label ">Email</label>
            <div>
                <input type="text" name="email" id="email" class="form-control bg-light text-dark" value="{{$profile->email}}" readonly>
            </div>
        </div>
    </div>


    <br>
        <button wire:click="$emit('editStudentProfileComponent')" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</button>
    @endif


    @livewire('arsys::profile.student.create')
    @livewire('arsys::profile.student.edit')

    <script>
        $('.modal').on('hidden.bs.modal', function () {
            window.livewire.emit('refreshComponent');
        });
    </script>

</div>
