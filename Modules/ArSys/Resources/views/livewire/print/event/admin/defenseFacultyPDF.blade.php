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

@php ($counter=0)
@foreach ($faculties as $faculty)
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
                        DEPARTEMEN PENDIDIKAN TEKNIK ELEKTRO</b><br />
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
                No: {{$event->letter_number}}/UN40.A5/DA/{{ \Carbon\Carbon::parse($event->event_date)->format('Y')}}
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
                        Dalam rangka pelaksanaan kegiatan {{$event->type->ina_description}}
                        Departemen Pendidikan Teknik Elektro UPI, dengan ini kami menugaskan Bapak/Ibu/Saudara:

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
                        {{$faculty->front_title}}
                        {{$faculty->first_name}}
                        {{$faculty->last_name}}
                        {{$faculty->rear_title}}
                </tr>
                <tr>
                    <td width="18%" valign="top">NIP
                    </td>
                    <td width="1%" valign="top">:
                    </td>
                    <td text-align="left" valign="top">
                        {{$faculty->nip}}
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
                        sebagai pembimbing/penguji pada pelaksanaan {{$event->type->ina_description}} {{ \Carbon\Carbon::parse($event->event_date)->format('l,') }}
                        {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y')}}. Jadwal pelaksanaan sidang sebagai berikut:
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="tablejadwal">
        <table width="100%">
            <thead>
            <tr>
                <th width="2%">No</th>
                <th width="35%">Mahasiswa</th>
                <th width="60%">Judul</th>
                <th width="60%">Pembimbing dan Penguji</th>
            </tr>
            </thead>
            <tbody>
                @php($counter = 0)
                @foreach($faculty->examiner as $examiner)
                    <tr>
                        <td>
                            {{++$counter}}
                        </td>
                        <td>
                            @if($examiner->applicant->research->student->studyProgram != null)
                                {{$examiner->applicant->research->student->studyProgram->code}}.
                            @endif
                            {{$examiner->applicant->research->student->student_number}}
                            <br>
                            {{$examiner->applicant->research->student->first_name}}
                            {{$examiner->applicant->research->student->last_name}}
                            <br>
                            <br>
                            <b>Waktu</b>
                            <br>
                            {{$examiner->applicant->session->time}}
                            <br>
                            <b>Tempat</b>
                            <br>
                            {{$examiner->applicant->space->space}} - {{$examiner->applicant->space->passcode}}

                        </td>
                        <td>
                            <b>{{$examiner->applicant->research->research_code}}</b>
                            <br>
                            {{$examiner->applicant->research->title}}

                        </td>
                        <td>

                            @if($examiner->applicant->research->researchSupervisor != null)
                                <b>Pembimbing</b>
                                <br>
                                @foreach($examiner->applicant->research->researchSupervisor  as $supervisor)
                                    {{$supervisor->faculty->front_title}}
                                    {{$supervisor->faculty->first_name}}
                                    {{$supervisor->faculty->last_name}}
                                    {{$supervisor->faculty->rear_title}}
                                    <br>
                                @endforeach
                            @endif
                            <br>
                            @if($examiner->applicant->examiner != null)
                                <b>Penguji</b>
                                <br>
                                @foreach($examiner->applicant->examiner as $examiner)
                                    {{$examiner->faculty->front_title}}
                                    {{$examiner->faculty->first_name}}
                                    {{$examiner->faculty->last_name}}
                                    {{$examiner->faculty->rear_title}}
                                    <br>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach
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
                {{ \Carbon\Carbon::parse($event->letter_date)->format('d F Y')}} <br />
                Ketua Departemen, <br /><br />
                <img src="{{ public_path().'/images/ydm.png'}}" width="80" height="80"/>
                <br />
                Dr. Yadi Mulyadi, MT <br />
                NIP 196307271993021001
            </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="page-break"></div>
@endforeach
</body>
</html>
