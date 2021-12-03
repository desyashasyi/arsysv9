@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Student | Home
                </div>
                <div class="card-body">
                    Please use the following template of proposal:
                    <br>
                    1. <a href="{{ public_path().'/doc/STE.docx'}}">Seminar TE</a>
                    <br>
                    2. <a href="{{ public_path().'/doc/TA.docs'}}" >Tugas Akhir/ Skripsi</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
