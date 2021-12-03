<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ArSys Defense Schedule</title>

    <style type="text/css">

#tablejadwal {
  font-family: "Times New Roman", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin: 15px 25px 10px 25px;
}


hr {
    display: block;
    height: 2px;
    border: 0;
    border-top: 1px solid #444;
    margin: 1em 0;
    padding: 0px 25px 0px 25px;
}

#kop {
  width: 100%;
  margin: 10px 25px 0px 25px;
  font-size: 20px;
  vertical-align: top;
}


#tablejadwal td, #tablejadwal th {
  border: 1px solid #666;
  padding: 4px;
  vertical-align: top;
}

#bodysurat {
  font-family: "Times New Roman", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin: 4px 25px 10px 25px;
  font-size: 13px;
}

#tablejadwal th {
  padding-top: 5px;
  padding-bottom: 5px;
  text-align: left;
  background-color: #ddd;
  color: #000;
}

        .page-break {
            page-break-after: always;
        }
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: times;
        }

        table {
            font-size: small;
            border-collapse: collapse;
        }

        h2 {
            margin: 0;
            font-size: 15px;
        }
        h5 {
            margin: 0;
            font-size: 10px;
        }
        footer{
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;

                /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 0.7cm;
        }

    </style>

</head>
<body>
    @php(\Carbon\Carbon::setLocale('id'))
    <div id="kop">
        <table width="100%">
            <tr>
                <td align ="right" style="width: 18%">
                <img src="{{ public_path().'/images/upi.png'}}" width="80" height="80"/>
                </td>
                <td class="text-right" style="width: 2%">

                </td>

                <td align ="left" style="width: 80%">

                  <b>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI<br />
                        UNIVERSITAS PENDIDIKAN INDONESIA <br />
                        FAKULTAS PENDIDIKAN TEKNOLOGI DAN KEJURUAN <br />
                        @if($applicant->research->student->program->code ==
                            \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->code)
                            PROGRAM STUDI PENDIDIKAN TEKNIK ELEKTRO
                        @endif
                        @if($applicant->research->student->program->code ==
                            \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->code)
                            PROGRAM STUDI TEKNIK ELEKTRO
                        @endif
                  </b>
                        <br>

                   Jl. Dr. Setiabudi No. 207 Bandung 40154 <br />Telp. (022) 2011576 Ext. 34001 s.d 34008, 34017 Fax (022) 2011576
                </td>
            </tr>
        </table>
    </div>
    <hr/>

    <div id="bodysurat">
        <table width="100%">
            <tbody>
            <tr>
            <td align="center" width="100%">
                <b>SURAT TUGAS</b>
                <br>
                @if($applicant->research->student->program->code ==
                    \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->code)
                    No:
                    @if($applicant->event->letter != null)
                        @foreach($applicant->event->letter as $letter)
                            @if($letter->program->code ==
                                \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->code)
                                {{$letter->number}}
                            @endif
                        @endforeach
                    @endif

                    /UN.40.F5.3/PK/{{ \Carbon\Carbon::parse($applicant->event->event_date)->format('Y')}}
                @endif
                @if($applicant->research->student->program->code ==
                    \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->code)
                    No:
                    @if($applicant->event->letter != null)
                        @foreach($applicant->event->letter as $letter)
                            @if($letter->program->code ==
                                \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->code)
                                {{$letter->number}}
                            @endif
                        @endforeach
                    @endif

                    /UN.40.F5.9/PK/{{ \Carbon\Carbon::parse($applicant->event->event_date)->format('Y')}}
                @endif
            </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div id="bodysurat">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="100%">
                        Dalam rangka pelaksanaan kegiatan {{$applicant->event->type->ina_description}}
                        @if($applicant->research->student->program->code ==
                            \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->code)
                            Program Studi Pendidikan Teknik Elektro
                        @endif
                        @if($applicant->research->student->program->code ==
                            \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->code)
                            Program Studi Teknik Elektro
                        @endif
                        UPI, dengan ini kami menugaskan Bapak/Ibu/Saudara:

                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="bodysurat">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="18%" valign="top">Nama
                    </td>
                    <td width="1%" valign="top">:
                    </td>
                    <td text-align="left" valign="top">
                        @if($applicant->examiner->contains('examiner_id', Auth::user()->faculty->id))
                            @foreach($applicant->examiner as $examiner)
                                @if($examiner->examiner_id == Auth::user()->faculty->id)
                                    {{$examiner->faculty->front_title}}
                                    {{$examiner->faculty->first_name}}
                                    {{$examiner->faculty->last_name}}
                                    {{$examiner->faculty->rear_title}}
                                @endif
                            @endforeach
                        @endif
                        @if($applicant->research->supervisor->contains('supervisor_id', Auth::user()->faculty->id))
                            @foreach($applicant->research->supervisor as $supervisor)
                                @if($supervisor->supervisor_id == Auth::user()->faculty->id)
                                    {{$supervisor->faculty->front_title}}
                                    {{$supervisor->faculty->first_name}}
                                    {{$supervisor->faculty->last_name}}
                                    {{$supervisor->faculty->rear_title}}
                                @endif
                            @endforeach
                        @endif
                    </td>

                </tr>
                <tr>
                    <td width="18%" valign="top">NIP
                    </td>
                    <td width="1%" valign="top">:
                    </td>
                    <td text-align="left" valign="top">
                        @if($applicant->examiner->contains('examiner_id', Auth::user()->faculty->id))
                            @foreach($applicant->examiner as $examiner)
                                @if($examiner->examiner_id == Auth::user()->faculty->id)
                                    {{$examiner->faculty->nip}}
                                @endif
                            @endforeach
                        @endif
                        @if($applicant->research->supervisor->contains('supervisor_id', Auth::user()->faculty->id))
                            @foreach($applicant->research->supervisor as $supervisor)
                                @if($supervisor->supervisor_id == Auth::user()->faculty->id)
                                    {{$supervisor->faculty->nip}}
                                @endif
                            @endforeach
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="bodysurat">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="100%">
                        sebagai
                        @if($applicant->examiner->contains('examiner_id', Auth::user()->faculty->id))
                            Penguji
                        @endif
                        @if($applicant->research->supervisor->contains('supervisor_id', Auth::user()->faculty->id))
                            Pembimbing
                        @endif

                        pada pelaksanaan {{$applicant->event->type->ina_description}} {{ \Carbon\Carbon::parse($applicant->event->event_date)->translatedformat('l,') }}
                        {{ \Carbon\Carbon::parse($applicant->event->event_date)->translatedformat('d F Y')}}. Jadwal pelaksanaan sidang sebagai berikut:
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="bodysurat">
        <table width="100%">
            <tbody>

                <tr>
                    <td width="18%" valign="top">Waktu
                    </td>
                    <td width="1%" valign="top">:
                    </td>
                    <td text-align="left" valign="top">
                        {{$applicant->session->time}}
                    </td>
                </tr>
                <tr>
                    <td width="18%" valign="top">Meeting Id
                    </td>
                    <td width="1%" valign="top">:
                    </td>
                    <td text-align="left" valign="top">
                        {{$applicant->space->space}}
                    </td>
                </tr>
                @if($applicant->space->passcode != '')
                    <tr>
                        <td width="18%" valign="top">Passcode
                        </td>
                        <td width="1%" valign="top">:
                        </td>
                        <td text-align="left" valign="top">
                            {{$applicant->space->passcode}}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div id="bodysurat">
        <table width="100%">
            <tbody>
            <tr>
            <td width="100%">Demikian surat tugas ini untuk dilaksanakan dengan sebaik-baiknya dan penuh tanggung jawab. </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="bodysurat">
        <table width="100%">
            <tbody>
            <tr>
            <td width="70%"> </td>
            <td width="30%">Bandung,
                @if($applicant->event->letter != null)
                    @if($applicant->research->student->program_id ==
                        \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->id)
                        @foreach($applicant->event->letter as $letter)
                            @if($letter->program_id == \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->id)
                                {{ \Carbon\Carbon::parse($letter->date)->translatedformat('d F Y')}} <br />
                            @endif
                        @endforeach
                        Ketua Program Studi, <br /><br />
                        <img src="{{ public_path().'/images/ink.png'}}" width="80" height="80"/>
                        <br />
                        Iwan Kustiawan, Ph.D <br />
                        NIP 197709082003121002
                    @endif
                    @if($applicant->research->student->program_id ==
                        \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->id)
                        @foreach($applicant->event->letter as $letter)
                            @if($letter->program_id == \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->id)
                                {{ \Carbon\Carbon::parse($letter->date)->translatedformat('d F Y')}} <br />
                            @endif
                        @endforeach
                        Ketua Program Studi, <br /><br />
                        <img src="{{ public_path().'/images/tsm.png'}}" width="80" height="80"/>
                        <br />
                        Dr. Tasma Sucita, MT <br />
                        NIP 196307271993021001
                    @endif
                @endif


            </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="page-break"></div>




    <div id="kop">
        <table width="100%">
            <tr>
                <td align ="right" style="width: 18%">
                <img src="{{ public_path().'/images/upi.png'}}" width="80" height="80"/>
                </td>
                <td class="text-right" style="width: 2%">

                </td>

                <td align ="left" style="width: 80%">

                  <b>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI<br />
                        UNIVERSITAS PENDIDIKAN INDONESIA <br />
                        FAKULTAS PENDIDIKAN TEKNOLOGI DAN KEJURUAN <br />
                        @if($applicant->research->student->program->code ==
                            \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->code)
                            PROGRAM STUDI PENDIDIKAN TEKNIK ELEKTRO
                        @endif
                        @if($applicant->research->student->program->code ==
                            \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->code)
                            PROGRAM STUDI TEKNIK ELEKTRO
                        @endif
                  </b>
                        <br>
                   Jl. Dr. Setiabudi No. 207 Bandung 40154 <br />Telp. (022) 2011576 Ext. 34001 s.d 34008, 34017 Fax (022) 2011576
                </td>
            </tr>
        </table>
    </div>
    <hr/>

    <div id="bodysurat">
        <table width="100%">
            <tbody>
                <tr>
                    <td align="center" width="100%">
                        <b>DATA PENELITIAN</b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="tablejadwal">
        <table width="100%">
            <thead>
            <tr>
                <th width="30%">Mahasiswa</th>
                <th width="35%">Judul</th>
                <th width="35%">Pembimbing dan Penguji</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{$applicant->research->student->program->code}}.
                        {{$applicant->research->student->student_number}}
                        <br>
                        {{$applicant->research->student->first_name}}
                        {{$applicant->research->student->last_name}}
                    </td>
                    <td>
                        {{$applicant->research->research_code}}
                        <br>
                        {{$applicant->research->title}}
                    </td>
                    <td>
                        <b>Pembimbing</b>
                        <br>
                        @foreach($applicant->research->supervisor as $supervisor)
                            {{$supervisor->faculty->front_title}}
                            {{$supervisor->faculty->first_name}}
                            {{$supervisor->faculty->last_name}}
                            {{$supervisor->faculty->rear_title}}
                            <br>
                        @endforeach
                        <br>
                        <b>Penguji</b>
                        <br>

                            @foreach($applicant->examiner as $examiner)
                                {{$examiner->faculty->front_title}}
                                {{$examiner->faculty->first_name}}
                                {{$examiner->faculty->last_name}}
                                {{$examiner->faculty->rear_title}}
                                <br>
                            @endforeach
                    </td>
                </tr>

            </tbody>
        </table>
    </div>


    <div id="bodysurat">
        <table width="100%">
            <tbody>
            <tr>
            <td width="70%"> </td>
            <td width="30%">Bandung,
                @if($applicant->event->letter != null)
                    @if($applicant->research->student->program_id ==
                        \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->id)
                        @foreach($applicant->event->letter as $letter)
                            @if($letter->program_id == \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->id)
                                {{ \Carbon\Carbon::parse($letter->date)->translatedformat('d F Y')}} <br />
                            @endif
                        @endforeach
                        Ketua Program Studi, <br /><br />
                        <img src="{{ public_path().'/images/ink.png'}}" width="80" height="80"/>
                        <br />
                        Iwan Kustiawan, Ph.D <br />
                        NIP 197709082003121002
                    @endif
                    @if($applicant->research->student->program_id ==
                        \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->id)
                        @foreach($applicant->event->letter as $letter)
                            @if($letter->program_id == \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->id)
                                {{ \Carbon\Carbon::parse($letter->date)->translatedformat('d F Y')}} <br />
                            @endif
                        @endforeach
                        Ketua Program Studi, <br /><br />
                        <img src="{{ public_path().'/images/tsm.png'}}" width="80" height="80"/>
                        <br />
                        Dr. Tasma Sucita, MT <br />
                        NIP 196307271993021001
                    @endif
                @endif

            </td>
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
