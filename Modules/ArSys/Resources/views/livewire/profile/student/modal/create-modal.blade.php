<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createStudentProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createStudentProfileCreate">Create Student's Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                </div>
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

                <div wire:ignore class="row">
                    <div class="col-md-4 offset-md-0">
                        <label for="study_program" class="control-label">Study Program</label>
                    </div>
                    <div class="col-md-8 offset-md-0">
                        <div class="form-group">

                            <select class="study_program" id='programStudy' style='width: 260px;' name="study_program">
                            </select>

                            @error('study_program') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div wire:ignore class="row">
                    <div class="col-md-4 offset-md-0">
                        <label for="study_specialization" class="control-label">Specialization</label>
                    </div>
                    <div class="col-md-8 offset-md-0">
                        <div class="form-group">

                            <select class="study_specialization" id='studySpecialization' style='width: 260px;' name="study_specialization">
                            </select>

                            @error('study_specialization') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div>
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <label for="first_name">First Name</label>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            <div class="form-group">
                                <input type="text" class="form-control" wire:model="first_name" id="first_name" placeholder="Enter first name">
                                @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <label for="last_name">Last Name</label>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            <div class="form-group">
                                <input type="text" class="form-control" wire:model="last_name" id="last_name" placeholder="Enter last name">
                                @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div wire:ignore class="row">
                    <div class="col-md-4 offset-md-0">
                        <label for="supervisor" class="control-label">Supervisor</label>
                    </div>
                    <div class="col-md-8 offset-md-0">
                        <div class="form-group">

                            <select class="supervisor" id='supervisor' style='width: 260px;' name="supervisor">
                            </select>

                            @error('supervisor') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div>
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <label for="phone">Phone</label>
                        </div>
                        <div class="col-md-5 offset-md-0">
                            <div class="form-group">
                                <input type="text" class="form-control" wire:model="phone" id="phone" placeholder="Enter phone">
                                @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            <div class="form-group">
                                <input type="text" class="form-control" wire:model="email" id="email" placeholder="Enter email">
                                @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click="store" class="btn btn-sm btn-success"><i class="fas fa-paper-plane"></i> Submit</button>
            </div>
       </div>
    </div>
</div>
