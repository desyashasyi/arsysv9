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

                  <b>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN<br />
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
                                    && $letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'DEANINV')->first()->id
                                    )
                                    {{$letter->number}}/UN40.F5.9/PK/{{ \Carbon\Carbon::parse($event->event_date)->format('Y')}}
                                @endif
                            @endforeach
                        @endif
                        @if($program->code ==
                            \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->code)
                            @foreach($event->letter as $letter)
                                @if($letter->program_id == \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->id
                                    && $letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'DEANINV')->first()->id
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
                    -
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
                    Undangan Pembukaan Sidang Yudisium Program Studi {{$program->description}}
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
                    Dengan ini, kami memberitahukan bahwa Ujian Sidang Sarjana

                    {{$program->description}} FPTK UPI akan dilaksanakan tanggal
                    {{ \Carbon\Carbon::parse($event->event_date)->translatedformat('d F Y')}}.
                    Untuk itu, kami mengundang Bapak untuk membuka Sidang Yudisium tersebut pada pada:
                    <br>
                    <br>
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td text-align="left" valign="top" width="15%">
                                    Hari, Tanggal
                                </td>
                                <td text-align="left" valign="top" width="1%">
                                    :
                                </td>
                                <td text-align="left" width="90%">
                                    {{ \Carbon\Carbon::parse($event->event_date)->translatedformat('d F Y')}}.
                                </td>
                            </tr>

                            <tr>
                                <td text-align="left" valign="top" width="15%">
                                    Waktu
                                </td>
                                <td text-align="left" valign="top" width="1%">
                                    :
                                </td>
                                <td text-align="left" width="90%">
                                    Pukul 07:00-selesai
                                </td>
                            </tr>

                            <tr>
                                <td text-align="left" valign="top" width="9%">
                                    Meeting ID
                                </td>
                                <td text-align="left" valign="top" width="1%">
                                    :
                                </td>
                                <td text-align="left" width="90%">
                                    84839604556
                                </td>
                            </tr>
                            <tr>
                                <td text-align="left" valign="top" width="9%">
                                   Passcode
                                </td>
                                <td text-align="left" valign="top" width="1%">
                                    :
                                </td>
                                <td text-align="left" width="90%">
                                    450579
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    Demikian undangan ini, atas perkenan Bapak kami ucapkan terima kasih.
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
                                && $letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'DEANINV')->first()->id
                                )
                                {{ \Carbon\Carbon::parse($letter->date)->translatedformat('d F Y')}} <br />
                            @endif
                        @endforeach
                        Ketua Program Studi, <br /><br />
                        <img src="{{ public_path().'/images/ink.png'}}" width="80" height="80"/>
                        <br />
                        Iwan Kustiawan, Ph.D <br />
                        NIP 196307271993021001
                    @endif
                    @if($program->code ==
                        \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->code)
                        @foreach($event->letter as $letter)
                            @if($letter->program_id == \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->id
                                && $letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'DEANINV')->first()->id
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
                                    && $letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'DEANINV')->first()->id
                                    )
                                    {{$letter->number}}/UN40.F5.9/PK/{{ \Carbon\Carbon::parse($event->event_date)->format('Y')}}
                                @endif
                            @endforeach
                        @endif
                        @if($program->code ==
                            \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'PTE')->first()->code)
                            @foreach($event->letter as $letter)
                                @if($letter->program_id == \Modules\ArSys\Entities\StudyProgram::where('abbrev', 'TE')->first()->id
                                    && $letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'DEANINV')->first()->id
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
                    -
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
                    Undangan Pembukaan Sidang Yudisium Program Studi {{$program->description}}
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
                    Bapak Wakil Dekan I FPTK UPI
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
                    Dengan ini, kami memberitahukan bahwa Ujian Sidang Sarjana

                    {{$program->description}} FPTK UPI akan dilaksanakan tanggal
                    {{ \Carbon\Carbon::parse($event->event_date)->translatedformat('d F Y')}}.
                    Untuk itu, kami mengundang Bapak untuk membuka Sidang Yudisium tersebut pada pada:
                    <br>
                    <br>
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td text-align="left" valign="top" width="15%">
                                    Hari, Tanggal
                                </td>
                                <td text-align="left" valign="top" width="1%">
                                    :
                                </td>
                                <td text-align="left" width="90%">
                                    {{ \Carbon\Carbon::parse($event->event_date)->translatedformat('d F Y')}}.
                                </td>
                            </tr>

                            <tr>
                                <td text-align="left" valign="top" width="15%">
                                    Waktu
                                </td>
                                <td text-align="left" valign="top" width="1%">
                                    :
                                </td>
                                <td text-align="left" width="90%">
                                    Pukul 07:00-selesai
                                </td>
                            </tr>

                            <tr>
                                <td text-align="left" valign="top" width="9%">
                                    Meeting ID
                                </td>
                                <td text-align="left" valign="top" width="1%">
                                    :
                                </td>
                                <td text-align="left" width="90%">
                                    84839604556
                                </td>
                            </tr>
                            <tr>
                                <td text-align="left" valign="top" width="9%">
                                   Passcode
                                </td>
                                <td text-align="left" valign="top" width="1%">
                                    :
                                </td>
                                <td text-align="left" width="90%">
                                    450579
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    Demikian undangan ini, atas perkenan Bapak kami ucapkan terima kasih.
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
                                && $letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'DEANINV')->first()->id
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
                                && $letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'DEANINV')->first()->id
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

</body>
</html>
