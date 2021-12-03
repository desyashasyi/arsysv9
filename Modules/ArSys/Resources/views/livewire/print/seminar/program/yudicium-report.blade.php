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

    #tablejadwal td, #tablejadwal th {
        border: 1px solid #666;
        padding: 4px;
        vertical-align: top;
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
        <div class="row">
            <div class="col-sm-12 offset-s-0">
                <div id="kop">
                    <table width="100%">
                        <tr>
                            <td width="15%">
                                <img src="{{ public_path().'/images/upi.png'}}" width="100" height="100"/>
                            </td>
                            <td>
                                <b>
                                    KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN
                                    <br>
                                    UNIVERSITAS PENDIDIKAN INDONESIA
                                    <br>
                                    FAKULTAS PENDIDIKAN TEKNOLOGI DAN KEJURUAN
                                    <br>
                                    PROGRAM STUDI {{Str::upper($program->description)}}
                                    <br>
                                </b>
                                <br>
                                Jl. Dr. Setiabudi No. 207 Bandung 40154 <br />Telp. (022) 2011576 Ext. 34001 s.d 34008, 34017 Fax (022) 2011576
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <br>
        <div class="row">
            <div class="col-sm-12 offset-s-0">
                <div id="bodysurat">
                    <table width="100%">
                        <tr>
                            <td align="center">
                                YUDISIUM SIDANG SARJANA PROGRAM STUDI {{Str::upper($program->description)}}
                                <br>
                                {{\Carbon\Carbon::parse($event->event_date)->format('d F Y')}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 offset-s-0">
                <div id="tablejadwal">
                    <table width="100%">
                       <thead>

                       </thead>

                       <tbody>

                       </tbody>
                    </table>
                </div>
            </div>
        </div>




    </body>
</html>
