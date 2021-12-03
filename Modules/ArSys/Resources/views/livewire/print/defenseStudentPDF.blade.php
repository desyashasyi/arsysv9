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
                No: {{$applicant->event->letter_number}}/UN40.A5/DA/{{ \Carbon\Carbon::parse($applicant->event->event_date)->format('Y')}}
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
                        Departemen Pendidikan Teknik Elektro UPI, dengan ini kami menugaskan Bapak/Ibu/Saudara:
                        <br>
                        <br>
                        @php($number = 0)
                        @if($applicant->research->supervisor != null)
                            @forelse ($applicant->research->supervisor as $supervisor)
                                {{++$number}}.
                                {{$supervisor->faculty->front_title}}
                                {{$supervisor->faculty->first_name}}
                                {{$supervisor->faculty->last_name}}
                                {{$supervisor->faculty->rear_title}}
                                <br>
                            @empty
                            @endforelse
                        @endif

                        @if($applicant->examiner != null)
                            @foreach ($applicant->examiner as $examiner)
                                {{++$number}}.
                                {{$examiner->faculty->front_title}}
                                {{$examiner->faculty->first_name}}
                                {{$examiner->faculty->last_name}}
                                {{$examiner->faculty->rear_title}}
                                <br>
                            @endforeach
                        @endif
                        <br>
                        Untuk menguji:
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div id="bodysurat">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="18%" valign="top">Peserta</td>
                    <td width="1%" valign="top">:</td>
                    <td text-align="left" valign="top">
                        @if($applicant->research->student->studyProgram != null)
                            {{$applicant->research->student->studyProgram->code}}.{{$applicant->research->student->student_number}} -
                        @endif
                        {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                </tr>
                <tr>
                    <td width="18%" valign="top">Judul</td>
                    <td width="1%" valign="top">:</td>
                    <td text-align="left" valign="top">
                        <b>{{$applicant->research->research_code}}</b>
                        <br>
                        {{$applicant->research->title}}
                    </td>
                </tr>
                <tr>
                    <td width="18%" valign="top">Hari, Tanggal</td>
                    <td width="1%" valign="top">:</td>
                    <td text-align="left">{{ \Carbon\Carbon::parse($applicant->event->event_date)->format('l,') }}
                        {{ \Carbon\Carbon::parse($applicant->event->event_date)->format('d F Y')}}
                </tr>
                <tr>
                    <td width="18%" valign="top">Waktu</td>
                    <td width="1%" valign="top">:</td>
                    <td text-align="left" valign="top">
                        @if ($applicant->session != null)
                        {{$applicant->session->time}}<br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td width="18%" valign="top">Tempat</td>
                    <td width="1%" valign="top">:</td>
                    <td text-align="left" valign="top">
                        @if($applicant->space != null)
                            {{$applicant->space->space}} - {{$applicant->space->passcode}}
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
                            {{ \Carbon\Carbon::parse($applicant->event->letter_date)->format('d F Y')}} <br />
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
</body>
</html>
