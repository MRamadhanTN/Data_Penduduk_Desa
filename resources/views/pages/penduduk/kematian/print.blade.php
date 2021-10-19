<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table.static {
            position: relative;

            border: 1px solid #543535
        }
    </style>

    <title>Cetak Data Kematian Desa</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>Laporan Data Kematian Desa</b></p>
        <br>
        <table class="static table table-striped " align="center" rules="all" border="1px" style="width: 95%;">
            <tr align="center">
                <th>No</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>TTGL</th>
                <th>Pekerjaan</th>
                <th>Agama</th>
                <th>Kewarganegaraan</th>
                <th>Tanggal Wafat</th>
                <th>Waktu</th>
                <th>Umur</th>
                <th>Tempat</th>
                <th>Penyebab</th>
            </tr>
            @foreach ($diePrint as $print)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $print->NIK }}</td>
                    <td>{{ $print->name }}</td>
                    <td>{{ $print->gender }}</td>
                    <td>{{ $print->place_birth }}, {{ $print->birth_date }}</td>
                    <td>{{ $print->job }}</td>
                    <td>{{ $print->religion }}</td>
                    <td>{{ $print->citizenship }}</td>
                    <td>{{ $print->date }}</td>
                    <td>{{ $print->time }}</td>
                    <td>{{ $print->age }}</td>
                    <td>{{ $print->place }}</td>
                    <td>{!! $print->penyebab !!}</td>
            @endforeach
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
