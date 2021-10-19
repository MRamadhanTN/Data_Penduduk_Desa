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

    <title>Cetak Data Kelahiran Desa Tahun ........ / ........</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>Laporan Data Kelahiran Desa Tahun ........ / ........</b></p>
        <br>
        <table class="static table table-striped " align="center" rules="all" border="1px" style="width: 95%;">
            <tr align="center">
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Berat</th>
                <th>Tinggi</th>
                <th>Ayah</th>
                <th>Ibu</th>
            </tr>
            @foreach ($birthPrint as $print)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $print->name }}</td>
                    <td>{{ $print->resident->gender }}</td>
                    <td>{{ $print->resident->birth }}</td>
                    <td>{{ $print->weight }}</td>
                    <td>{{ $print->width }}</td>
                    <td>{{ $print->father }}</td>
                    <td>{{ $print->mother }}</td>
            @endforeach
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
