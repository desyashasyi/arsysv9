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
  margin: 10px 25px 10px 25px;
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
            margin: 30px;
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
                        PROGRAM STUDI {{Str::upper($program->description)}}
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
                <td text-align="left" width="9%">
                    Nomor
                </td>
                <td text-align="left" width="1%">
                    :
                </td>
                <td text-align="left" width="90%">
                    @if($event->letter != null)
                        @if($program->code ==
                            \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->code)
                            @foreach($event->letter as $letter)
                                @if($letter->program_id == \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->id
                                    && $letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'YUDPRO')->first()->id
                                    )
                                    {{$letter->number}}/UN40.F5.9/PK/{{ \Carbon\Carbon::parse($event->event_date)->format('Y')}}
                                @endif
                            @endforeach
                        @endif
                        @if($program->code ==
                            \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->code)
                            @foreach($event->letter as $letter)
                                @if($letter->program_id == \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->id
                                    && $letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'YUDPRO')->first()->id
                                    )
                                    {{$letter->number}}/UN40.F5.3/PK/{{ \Carbon\Carbon::parse($event->event_date)->format('Y')}}
                                @endif
                            @endforeach
                        @endif
                    @endif
                </td>
            </tr>
            <tr>
                <td text-align="left" width="9%">
                    Lampiran
                </td>
                <td text-align="left" width="1%">
                    :
                </td>
                <td text-align="left" width="90%">
                    Satu berkas
                </td>
            </tr>
            <tr>
                <td text-align="left" width="9%">
                    Perihal
                </td>
                <td text-align="left" width="1%">
                    :
                </td>
                <td text-align="left" width="90%">
                    Permohonan Surat Keputusan Pelaksanaan Sidang Sarjana {{$program->description}}
                </td>
            </tr>
            <tr>
                <td text-align="left" colspan="3">
                    <br>
                </td>
            </tr>

            <tr>
                <td text-align="left" valign="top" width="9%">
                    Kepada
                </td>
                <td text-align="left" valign="top" width="1%">
                    :
                </td>
                <td text-align="left" width="90%">
                    Bapak Dekan FPTK UPI
                    <br>
                    di
                    <br>
                    Tempat
                </td>
            </tr>
            <tr>
                <td text-align="left" colspan="3">
                    <br>
                </td>
            </tr>
            <tr>
                <td text-align="left" valign="top" width="9%">
                </td>
                <td text-align="left" valign="top" width="1%">
                </td>
                <td text-align="left" width="90%">
                    Dengan hormat,
                    <br>
                    <br>
                    Sehubungan dengan pelaksanaan Sidang Sarjana
                    {{$program->description}} pada tanggal {{ \Carbon\Carbon::parse($event->event_date)->translatedformat('d F Y')}},

                    maka kami mengajukan permohonan SK pelaksanaan Sidang Sarjana
                    untuk peserta sidang sesuai lampiran.

                    <br>
                    <br>
                    Demikian permohon ini diajukan, terima kasih.

                </td>
            </tr>
            </tbody>
        </table>
    </div>



    <div id="bodysurat">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="10%">
                    </td>
                    <td width="90%">

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
                @if($event->letter != null)
                    @if($program->code ==
                        \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->code)
                        @foreach($event->letter as $letter)
                            @if($letter->program_id == \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->id
                                && $letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'YUDPRO')->first()->id
                                )
                                {{ \Carbon\Carbon::parse($letter->date)->translatedformat('d F Y')}} <br />
                            @endif
                        @endforeach
                        Ketua Program Studi, <br /><br />
                        <img src="{{ public_path().'/images/ink.png'}}" width="80" height="80"/>
                        <br />
                        Iwan Kustiawan, Ph.D <br />
                        NIP 197709082003121002
                    @endif
                    @if($program->code ==
                        \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->code)
                        @foreach($event->letter as $letter)
                            @if($letter->program_id == \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->id
                                && $letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'YUDPRO')->first()->id
                                )
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
                <td text-align ="left" style="width: 100%">
                    LAMPIRAN:
                </td>
            </tr>
            <tr>
                <td align ="center" style="width: 100%">
                    SURAT KEPUTUSAN DEKAN FPTK
                    <br>
                    UNIVERSITAS PENDIDIKAN INDONESIA
                    <br>
                    <br>
                    TENTANG PENETAPAN PANITIA, PENGUJI, DAN PESERTA UJIAN SIDANG
                    @if($program->code ==
                        \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->code)
                        SARJANA TEKNIK
                    @endif
                    @if($program->code ==
                        \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->code)
                        SARJANA PENDIDIKAN
                    @endif
                    <br>
                    PROGRAM STUDI {{Str::upper($program->description)}}  – S1

                    <br>
                    FPTK UNIVERSITAS PENDIDIKAN INDONESIA
                    <br>PERIODE BULAN  {{ Str::upper(\Carbon\Carbon::parse($event->event_date)->translatedformat('F Y'))}} <br />
                    <br>
                    <br>
                    SK NO. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/UN40.F5/PK/{{ Str::upper(\Carbon\Carbon::parse($letter->date)->translatedformat('Y'))}} – {{ Str::upper(\Carbon\Carbon::parse($letter->date)->translatedformat('d F Y'))}}
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
                        <b>Penanggung Jawab:</b>
                        <br>Rektor UPI
                        <br>Prof. Dr. M. Solehuddin M.Pd., M.A
                        <br>
                        <br>
                        <b>Ketua:</b>
                        <br>Dekan FPTK UPI
                        <br>Dr. Iwa Kuntadi, M.Pd
                        <br>
                        <br>
                        <b>Sekretaris:</b>
                        <br>Ketua DPTE
                        <br>Dr. Yadi Mulyadi, MT
                        <br>
                        <br>
                        <b>Anggota:</b>
                        <br>Wakil Dekan I FPTK UPI
                        <br>Dr. Dedi Rohendi, M.Si
                        <br>
                        <br>

                        @if($program->code ==
                            \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->code)
                            Ketua Program Studi {{$program->description}}
                            <br>
                            Iwan Kustiawan, Ph.D
                        @endif
                        @if($program->code ==
                            \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->code)
                            Ketua Program Studi {{$program->description}}
                            <br>
                            Dr. Tasma Sucita, MT
                        @endif

                        <br>
                        <br>Sekretaris DPTE
                        <br>Didin Wahyudin, Ph.D
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="page-break"></div>


    <div id="tablejadwal">
        <table width="100%">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama dan NIM</th>
                    <th width="30%">Judul</th>
                    <th width="40%">Pembimbing dan Penguji</th>
                </tr>
            </thead>
            <tbody>
                @php($counter = 0)
                @php($page = 0)
                @foreach($applicants as $applicant)
                    @if($applicant->research->student->program_id == $program->id)

                        <tr>
                            <td align="center">
                                {{++$counter}}
                                @php(++$page)
                            </td>
                            <td>
                                {{$applicant->research->student->program->code}}.
                                {{$applicant->research->student->student_number}}
                                <br>
                                {{$applicant->research->student->first_name}}
                                {{$applicant->research->student->last_name}}
                            </td>

                            <td>
                                {{Str::upper($applicant->research->title)}}
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
                                @foreach($applicant->previous->examiner as $examiner)
                                    @if($examiner->presence != null)
                                        {{$examiner->faculty->front_title}}
                                        {{$examiner->faculty->first_name}}
                                        {{$examiner->faculty->last_name}}
                                        {{$examiner->faculty->rear_title}}
                                        <br>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endif
                @endforeach


                @if($waitingApplicants->isNotEmpty())

                    @foreach($waitingApplicants as $applicant)
                        @if($applicant->research->student->program_id == $program->id)


                            <tr>
                                <td align="center">
                                    {{++$counter}}
                                    @php(++$page)
                                </td>
                                <td>
                                    {{$applicant->research->student->program->code}}.
                                    {{$applicant->research->student->student_number}}
                                    <br>
                                    {{$applicant->research->student->first_name}}
                                    {{$applicant->research->student->last_name}}
                                </td>

                                <td>
                                    {{Str::upper($applicant->research->title)}}
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
                                    @foreach($applicant->previous->examiner as $examiner)
                                        @if($examiner->presence != null)
                                            {{$examiner->faculty->front_title}}
                                            {{$examiner->faculty->first_name}}
                                            {{$examiner->faculty->last_name}}
                                            {{$examiner->faculty->rear_title}}
                                            <br>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div id="bodysurat">
        <table width="100%">
            <tbody>
            <tr>
                <td width="70%" align="right">Ditetapkan di</td>
                <td width="30%">: Bandung
            </td>
            <tr>
                <td width="70%" align="right">Pada tanggal</td>
                </td>
                <td width="30%">
                    : {{ \Carbon\Carbon::parse($letter->date)->translatedformat('d F Y')}}
                </td>
            </tr>

            <tr>
                <td width="70%" align="right">Dekan</td>
                </td>
            </tr>
            <tr>
                <td width="100%">
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />

                <b>Dr. Iwa Kuntadi, M.Pd.</b>
                <br>
                NIP. 196208301988031002
            </td>
            </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
