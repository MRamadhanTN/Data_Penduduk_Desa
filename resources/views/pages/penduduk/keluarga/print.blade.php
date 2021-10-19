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

    <title>Cetak Data Keluarga Desa</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>Laporan Data Keluarga Desa</b></p>
        <br>
        <table class="static table table-striped " align="center" rules="all" border="1px" style="width: 95%;">
            <tr align="center">
                <th>No</th>
                <th>Nomor Kartu Keluarga</th>
                <th>NIK</th>
                <th>Kepala Keluarga</th>
            </tr>
            @foreach ($familyPrint as $print)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $print->no_kk }}</td>
                    <td>{{ $print->residents->NIK }}</td>
                    <td>{{ $print->residents->name }}</td>
            @endforeach
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
