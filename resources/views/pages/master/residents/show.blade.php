<table class="table table-bordered table-striped">
    <tr>
        <th>Nomor Kartu Keluarga</th>
        <td>
            @if($residents->no_kk)
                <span class="badge bg-success">{{ $residents->no_kk }}</span>
            @else
                <span class="badge bg-danger">Kosong</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>
            @if($residents->kepala_keluarga)
                <span class="badge bg-success">{{$residents->kepala_keluarga}}</span>
            @else
                <span class="badge bg-danger">Kosong</span>
            @endif

            {{-- @if($residents->id == $dies->resident_id)
                <span class="badge bg-warning">Meninggal</span>
            @endif --}}
            @foreach($dies as $death)
                @if($residents->id == $death->resident_id)
                    <span class="badge bg-warning">Meninggal</span>
                @endif
            @endforeach
        </td>
    </tr>
    <tr>
        <th>NIK</th>
        <td>{{ $residents->NIK }}</td>
    </tr>
    <tr>
        <th>Nama Lengkap</th>
        <td>{{ $residents->name }}</td>
    </tr>
    <tr>
        <th>Tempat Lahir</th>
        <td>{{ $residents->place_birth }}</td>
    </tr>
    <tr>
        <th>Tanggal Lahir</th>
        <td>{{ $residents->birth }}</td>
    </tr>
    <tr>
        <th>Pekerjaan</th>
        <td>
            @if($residents->job)
                {{ $residents->job }}
            @else
                <span class="badge bg-danger">Kosong</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Jenis Kelamin</th>
        <td>{{ $residents->gender }}</td>
    </tr>
    <tr>
        <th>RT</th>
        <td>{{ $residents->RT }}</td>
    </tr>
    <tr>
        <th>RW</th>
        <td>{{ $residents->RW }}</td>
    </tr>
    <tr>
        <th>Address</th>
        <td>{{ $residents->address }}</td>
    </tr>
    <tr>
        <th>Provinsi</th>
        <td>
            @if($residents->provinces)
                {{ $residents->provinces }}
            @else
                <span class="badge bg-danger">Kosong</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Kabupaten</th>
        <td>
            @if($residents->regencies)
                {{ $residents->regencies }}
            @else
                <span class="badge bg-danger">Kosong</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Kecamatan</th>
        <td>
            @if($residents->districts)
                {{ $residents->districts }}
            @else
                <span class="badge bg-danger">Kosong</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Kelurahan / Desa </th>
        <td>
            @if($residents->villages )
                {{ $residents->villages }}
            @else
                <span class="badge bg-danger">Kosong</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Agama</th>
        <td>{{ $residents->religion }}</td>
    </tr>
    <tr>
        <th>Golongan Darah</th>
        <td>
            @if( $residents->blood_group )
                {{ $residents->blood_group }}
            @else
                <span class="badge bg-danger">Kosong</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Status</th>
        <td>{{ $residents->status }}</td>
    </tr>
    <tr>
        <th>Pendidikan</th>
        <td>
            @if( $residents->education )
                {{ $residents->education }}
            @else
                <span class="badge bg-danger">Kosong</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Kewarganegaraan</th>
        <td>{{ $residents->kewarganegaraan }}</td>
    </tr>
    <tr>
        <th>Kategori</th>
        <td>
            @if($residents->category == 'Penduduk Tetap')
                <span class="badge bg-success">Penduduk Tetap</span>
            @elseif($residents->category == 'Penduduk Pindah')
                <span class="badge bg-warning">Penduduk Pindah</span>
            @elseif($residents->category == 'Penduduk Datang')
                <span class="badge bg-info">Penduduk Datang</span>
            @else
                <span class="badge bg-danger">Kosong</span>
            @endif
        </td>
    </tr>
</table>
