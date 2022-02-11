<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jadwal</title>

    <style type="text/css">
#tablejadwal {
  font-family: "Times New Roman", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin: 15px 25px 10px 25px;
  color:#444
}

hr {
    display: block;
    height: 2px;
    border: 0;
    border-top: 1px solid #444;
    margin: 1em 0;
    padding: 0px 25px 0px 25px;
    color:#444
}

#kop {
  width: 100%;
  margin: 10px 25px 0px 25px;
  font-size: 20px;
  vertical-align: top;
  color:#666
}


#tablejadwal td, #tablejadwal th {
  border: 1px solid #666;
  padding: 4px;
  vertical-align: top;
  color:#444
}

#bodysurat {
  font-family: "Times New Roman", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin: 4px 25px 10px 25px;
  font-size: 13px;
  color:#444
}

#tablejadwal th {
  padding-top: 5px;
  padding-bottom: 5px;
  text-align: left;
  background-color: #ddd;
  color:#444
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

    </style>

</head>
<body>
    @php ($counter=0)
    @php(\Carbon\Carbon::setLocale('id'))
    @foreach ($faculties as $faculty)
        @if($faculty->duty_id == 1 || $faculty->duty_id == 3)
            @if($faculty->team != null)
                <div id="kop">
                    <table width="100%">
                        <tr>
                            <td align="right" style="width: 18%">
                            <img src="{{ public_path().'/images/upi.png'}}" width="80" height="80"/>
                            </td>
                            <td align="right" style="width: 2%">

                            </td>

                            <td align="left" style="width: 80%">

                            <b>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI <br />
                                    UNIVERSITAS PENDIDIKAN INDONESIA <br />
                                    FAKULTAS PENDIDIKAN TEKNOLOGI DAN KEJURUAN <br /></b>
                            Jl. Dr. Setiabudi No. 207 Bandung 40154 Telp. (022) 2011576 Ext. 34001 s.d 34008, 34017 Fax (022) 2011576
                            </td>
                        </tr>
                    </table>
                </div>
                <div><hr/></div>
                <div id="bodysurat">
                    <table width="100%">
                        <tbody>
                        <tr>
                            <td align="center"><b>SURAT TUGAS</b><br />
                            No: {{$schedule->assignmentletter->number}}/UN40.F5/DT/{{ \Carbon\Carbon::parse($schedule->desc->start_date)->translatedformat('Y') }}
                        </td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>Dekan Fakultas Pendidikan Teknologi dan Kejuruan Universitas Pendidikan Indonesia menugaskan kepada:<br /></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div id="bodysurat">
                    <table width="100%">
                        <tbody>
                        <tr>
                            <td width="10%">Nama</td>
                            <td text-align="left">: {{$faculty->front_title}} {{$faculty->first_name}} {{$faculty->last_name}}, {{$faculty->rear_title}}</td>
                        </tr>

                        @if($faculty->nip == NULL)
                        <tr>
                            <td width="10%">Unit Kerja</td>
                            <td text-align="left">: {{$schedule->program->description}}</td>
                        </tr>
                        @else
                        <tr>
                            <td width="10%">NIP</td>
                            <td text-align="left">: {{$faculty->nip}}</td>
                        </tr>

                        @endif

                        @if($faculty->upi_code == NULL)
                        <tr>
                            <td width="10%">Kode Dosen</td>
                            <td text-align="left">: -</td>
                        </tr>
                        @else
                        <tr>
                            <td width="10%">Kode Dosen</td>
                            <td text-align="left">: {{$faculty->upi_code}}</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                <div id="bodysurat">
                    <table width="100%">
                        <tbody>
                        <tr>
                            <td>
                            @if($faculty->upi_code == NULL)
                                @if ($faculty->status = 3)
                                    Dosen luar biasa
                                @endif
                            @else
                                Dosen
                            @endif
                                Program Studi {{$schedule->program->description}} FPTK UPI,
                                untuk melaksanakan perkuliahan pada semester {{$schedule->desc->semester}} {{$schedule->desc->semester_id}} Tahun {{$schedule->desc->year}} yang dimulai pada tanggal {{ \Carbon\Carbon::parse($schedule->desc->start_date)->translatedformat('d F Y') }}, yaitu:</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div></div>
                <div id="tablejadwal">
                    <table width="100%">
                        <thead>
                        <tr>
                            <th width="2%" align="center">No</th>
                            <th width="3%">Kode</th>
                            <th width="20%">Mata Kuliah</th>
                            <th width="3%" align="center">SKS</th>
                            <th width="7%">Kelas</th>
                            <th width="5%" align="center">Jenjang</th>
                            <th width="7%">Ruang</th>
                            <th width="5%">Hari</th>
                            <th width="7%">Waktu</th>
                            <th width="25%">Dosen</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php($row = 0)
                            @foreach ($faculty->team as $team)
                                @if($team->program_id == $schedule->program_id)
                                    <tr>
                                        <td align="center">{{++$row}}
                                        </td>
                                        <td class="text-left">
                                            @if($team->schedule->subject != null)
                                                {{$team->schedule->subject->code}}
                                            @endif
                                        </td>
                                        <td class="text-left">
                                            @if($team->schedule->subject != null)
                                                {{strtoupper($team->schedule->subject->name)}}
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if($team->schedule->subject != null)
                                                {{$team->schedule->subject->credit}}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($team->schedule->studentsets != null)
                                                @foreach($team->schedule->studentsets as $student)
                                                    {{$student->student->code}}
                                                    <br>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td align="center">S1
                                        </td>

                                        <td class="text-left">
                                            @if($team->schedule->room != null)
                                                {{$team->schedule->room->name}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($team->schedule->daytime != null)
                                                {{ \Carbon\Carbon::parse($team->schedule->daytime)->translatedformat('l') }}<br>
                                            @endif
                                        </td>
                                        <td>
                                            @if($team->schedule->daytime != null)
                                                {{ \Carbon\Carbon::parse($team->schedule->daytime)->format('H:i') }} -
                                                @if($team->schedule->subject != null)
                                                    {{ \Carbon\Carbon::parse($team->schedule->daytime)->addMinute($team->schedule->subject->credit*50)->format('H:i') }}
                                                @endif
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @foreach($team->schedule->teams as $team)
                                                {{$team->faculty->front_title}}
                                                {{$team->faculty->first_name}}
                                                {{$team->faculty->last_name}},
                                                {{$team->faculty->rear_title}}<br>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                                @if($row == 5 || $row == 10)
                                            </tbody>
                                        </table>
                                    </div>
                                    <div></div>
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
                                            <td width="30%">Bandung, {{ \Carbon\Carbon::parse($schedule->desc->letter_date)->translatedformat('d F Y') }} <br />
                                                Dekan, <br /><br /><br /> <br /><br /><br />
                                                Dr. Iwa Kuntadi, M.Pd. <img src="{{ public_path().'/images/marksign.png'}}" width="10" height="10"/><br />
                                                NIP 196208301988031002
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="page-break"></div>
                                    <div id="kop">
                                        <table width="100%">
                                            <tr>
                                                <td align="right" style="width: 18%">
                                                <img src="{{ public_path().'/images/upi.png'}}" width="80" height="80"/>
                                                </td>
                                                <td align="right" style="width: 2%">

                                                </td>

                                                <td align="left" style="width: 80%">

                                                <b>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI <br />
                                                        UNIVERSITAS PENDIDIKAN INDONESIA <br />
                                                        FAKULTAS PENDIDIKAN TEKNOLOGI DAN KEJURUAN <br /></b>
                                                Jl. Dr. Setiabudi No. 207 Bandung 40154 Telp. (022) 2011576 Ext. 34001 s.d 34008, 34017 Fax (022) 2011576
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div><hr/></div>
                                    <div id="bodysurat">
                                        <table width="100%">
                                            <tbody>
                                            <tr>
                                                <td align="center"><b>SURAT TUGAS</b><br />
                                                No: {{$schedule->assignmentletter->number}}/UN40.F5/DT/{{ \Carbon\Carbon::parse($schedule->desc->start_date)->translatedformat('Y') }}
                                            </td>
                                            </tr>
                                            <tr><td>&nbsp;</td></tr>
                                            <tr>
                                                <td>Dekan Fakultas Pendidikan Teknologi dan Kejuruan Universitas Pendidikan Indonesia menugaskan kepada:<br /></td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="bodysurat">
                                        <table width="100%">
                                            <tbody>
                                            <tr>
                                                <td width="10%">Nama</td>
                                                <td text-align="left">: {{$faculty->front_title}} {{$faculty->first_name}} {{$faculty->last_name}}, {{$faculty->rear_title}}</td>
                                            </tr>

                                            @if($faculty->nip == NULL)
                                            <tr>
                                                <td width="10%">Unit Kerja</td>
                                                <td text-align="left">: {{$schedule->program->description}}</td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td width="10%">NIP</td>
                                                <td text-align="left">: {{$faculty->nip}}</td>
                                            </tr>

                                            @endif

                                            @if($faculty->upi_code == NULL)
                                            <tr>
                                                <td width="10%">Kode Dosen</td>
                                                <td text-align="left">: -</td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td width="10%">Kode Dosen</td>
                                                <td text-align="left">: {{$faculty->upi_code}}</td>
                                            </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div id="bodysurat">
                                        <table width="100%">
                                            <tbody>
                                            <tr>
                                                <td>
                                                @if($faculty->upi_code == NULL)
                                                    @if ($faculty->status = 3)
                                                        Dosen luar biasa
                                                    @endif
                                                @else
                                                    Dosen
                                                @endif
                                                    Program Studi {{$schedule->program->description}} FPTK UPI,
                                                    untuk melaksanakan perkuliahan pada semester {{$schedule->desc->semester}} {{$schedule->desc->semester_id}} Tahun {{$schedule->desc->year}} yang dimulai pada tanggal {{ \Carbon\Carbon::parse($schedule->desc->start_date)->translatedformat('d F Y') }}, yaitu:</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div></div>
                                    <div id="tablejadwal">
                                        <table width="100%">
                                            <thead>
                                            <tr>
                                                <th width="2%" align="center">No</th>
                                                <th width="3%">Kode</th>
                                                <th width="20%">Mata Kuliah</th>
                                                <th width="3%" align="center">SKS</th>
                                                <th width="7%">Kelas</th>
                                                <th width="5%" align="center">Jenjang</th>
                                                <th width="7%">Ruang</th>
                                                <th width="5%">Hari</th>
                                                <th width="7%">Waktu</th>
                                                <th width="25%">Dosen</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div></div>
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
                        <td width="30%">Bandung, {{ \Carbon\Carbon::parse($schedule->desc->letter_date)->translatedformat('d F Y') }} <br />
                            Dekan, <br /><br /><br /> <br /><br /><br />
                            Dr. Iwa Kuntadi, M.Pd. <img src="{{ public_path().'/images/marksign.png'}}" width="10" height="10"/><br />
                            NIP 196208301988031002
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div class="page-break"></div>
            @endif
        @endif
    @endforeach
</body>
</html>
