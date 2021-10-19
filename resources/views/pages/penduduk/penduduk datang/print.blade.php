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

    <title>Cetak Data Penduduk Datang Desa</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>Laporan Data Desa Penduduk Datang</b></p>
        <br>
        <table class="static table table-striped " align="center" rules="all" border="1px" style="width: 95%;">
            <tr align="center">
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Pekerjaan</th>
                <th>Jenis Kelamin</th>
                <th>RT</th>
                <th>RW</th>
                <th>Alamat</th>
                <th>Provinsi</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
                <th>Kelurahan/Desa</th>
                <th>Agama</th>
                <th>Status</th>
                <th>Pendidikan</th>
                <th>Kewarganegaraan</th>
            </tr>
            @foreach ($comePrint as $print)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $print->NIK }}</td>
                    <td>{{ $print->name }}</td>
                    <td>{{ $print->place_birth }}</td>
                    <td>{{ $print->birth }}</td>
                    <td>{{ $print->job }}</td>
                    <td>{{ $print->gender }}</td>
                    <td>{{ $print->RT }}</td>
                    <td>{{ $print->RW }}</td>
                    <td>{{ $print->address }}</td>
                    <td>{{ $print->provinces }}</td>
                    <td>{{ $print->regencies }}</td>
                    <td>{{ $print->districts }}</td>
                    <td>{{ $print->villages }}</td>
                    <td>{{ $print->religion }}</td>
                    <td>{{ $print->status }}</td>
                    <td>{{ $print->education }}</td>
                    <td>{{ $print->kewarganegaraan }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
