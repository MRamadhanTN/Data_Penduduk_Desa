@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">
        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-2 d-flex justify-content-between">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('comes.index') }}">Penduduk Datang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>

        <div class="card p-5 border border-2">
            <div class="title text-center py-3" style="line-height: 7px">
                <h2 class="text-primary">Edit Penduduk Tetap</h2>
                <p>( Isi data sesuai dengan KTP atau Kartu Keluarga )</p>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="post" id="locations" action="{{ route('comes.update', $residentDatangs->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="name">Nama Lengkap</label>
                                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror border-2" name="name" value="{{ $residentDatangs->name }}">
                                                    @error('name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="NIK">NIK</label>
                                                    <input type="number" id="NIK" class="form-control @error('NIK') is-invalid @enderror border-2" name="NIK" autocomplete="none" value="{{ $residentDatangs->NIK }}">
                                                    @error('NIK')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="place_birth">Tempat Lahir</label>
                                                    <input type="text" id="place_birth" class="form-control @error('place_birth') is-invalid @enderror border-2" name="place_birth" autocomplete="none" value="{{ $residentDatangs->place_birth }}">
                                                    @error('place_birth')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="birth">Tanggal Lahir</label>
                                                    <input type="date" id="birth" class="form-control @error('birth') is-invalid @enderror border-2" name="birth" autocomplete="none" value="{{ $residentDatangs->birth }}">
                                                    @error('birth')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="job_id">Pekerjaan</label>
                                                    <select type="text" id="job_id" class="form-control @error('job_id') is-invalid @enderror border-2" name="job_id">
                                                        <option disabled="" class="text-gray-500">Pilih Pekerjaan</option>
                                                        @foreach ($jobs as $job)
                                                            <option value="{{ $job->id }}" {{ $job->id==$residentDatangs->job?'selected':'' }}>
                                                                {{ $job->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @if( $residentDatangs->job === null?'selected':'' )
                                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                            </svg>
                                                            <div>
                                                                Data wajib diisi ulang !
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        @error('job_id')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="gender">Jenis Kelamin</label>
                                                    <select type="text" id="gender" class="form-control @error('gender') is-invalid @enderror border-2" name="gender" value="{{ $residentDatangs->gender }}">
                                                        <option value="Pria" {{ $residentDatangs->gender=='Pria'?'selected':'' }}>Pria</option>
                                                        <option value="Wanita" {{ $residentDatangs->gender=='Wanita'?'selected':'' }}>Wanita</option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="RT">RT</label>
                                                    <input type="number" id="RT" class="form-control @error('RT') is-invalid @enderror border-2" name="RT" autocomplete="none" value="{{ $residentDatangs->RT }}">
                                                    @error('RT')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="RW">RW</label>
                                                    <input type="number" id="RW" class="form-control @error('RW') is-invalid @enderror border-2" name="RW" autocomplete="none" value="{{ $residentDatangs->RW }}">
                                                    @error('RW')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="address">Alamat</label>
                                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror border-2" name="address" autocomplete="none">{{ $residentDatangs->address }}</textarea>
                                                    @error('address')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="provinces_id">Provinsi</label>
                                                    <select id="provinces_id" class="form-control @error('provinces_id') is-invalid @enderror border-2" name="provinces_id" v-if="provinces" v-model="provinces_id" value="{{ old('provinces_id') }}">
                                                        <option disabled="" class="text-gray-500">Pilih Provinsi</option>
                                                        <option v-for="province in provinces"  :value="province.id">@{{ province.name }}</option>
                                                    </select>
                                                    <select v-else class="form-control">
                                                        <option disabled="" selected class="text-gray-500">Pilih Provinsi</option>
                                                    </select>

                                                    {{-- @if( $residentDatangs->provinces === null?'':'selected' )
                                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                            </svg>
                                                            <div>
                                                                Data wajib diisi ulang !
                                                            </div>
                                                        </div>
                                                    @endif --}}

                                                    @error('provinces_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="regencies_id">Kabupaten</label>
                                                    <select id="regencies_id" class="form-control @error('regencies_id') is-invalid @enderror border-2" name="regencies_id" v-if="regencies" v-model="regencies_id" value="{{ old('regencies_id') }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih Kabupaten</option>
                                                        <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                                                    </select>

                                                    <select v-else class="form-control">
                                                        <option disabled="" selected class="text-gray-500">Pilih Kabupaten</option>
                                                    </select>

                                                    {{-- @if( $residentDatangs->regencies === null?'':'selected' )
                                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                            </svg>
                                                            <div>
                                                                Data wajib diisi ulang !
                                                            </div>
                                                        </div>
                                                    @endif --}}

                                                    @error('regencies_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="districts_id">Kecamatan</label>
                                                    <select id="districts_id" class="form-control @error('districts_id') is-invalid @enderror border-2" name="districts_id" v-if="districts" v-model="districts_id" value="{{ old('districts_id') }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih Kecamatan</option>
                                                        <option v-for="district in districts" :value="district.id">@{{ district.name }}</option>
                                                    </select>

                                                    <select v-else class="form-control">
                                                        <option disabled="" selected class="text-gray-500">Pilih Kecamatan</option>
                                                    </select>

                                                    {{-- @if( $residentDatangs->districts === null?'':'selected' )
                                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                            </svg>
                                                            <div>
                                                                Data wajib diisi ulang !
                                                            </div>
                                                        </div>
                                                    @endif --}}

                                                    @error('districts_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="villages_id">Kelurahan / Desa</label>
                                                    <select id="villages_id" class="form-control @error('villages_id') is-invalid @enderror border-2" name="villages_id" v-if="villages" v-model="villages_id" value="{{ old('villages_id') }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih Kelurahan</option>
                                                        <option v-for="village in villages" :value="village.id">@{{ village.name }}</option>
                                                    </select>

                                                    <select v-else class="form-control">
                                                        <option disabled="" selected class="text-gray-500">Pilih Kelurahan</option>
                                                    </select>

                                                    {{-- @if( $residentDatangs->villages === null?'':'selected' )
                                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                            </svg>
                                                            <div>
                                                                Data wajib diisi ulang !
                                                            </div>
                                                        </div>
                                                    @endif --}}

                                                    @error('villages_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="blood_group">Golongan Darah</label>
                                                    <select type="text" id="blood_group" class="form-control @error('blood_group') is-invalid @enderror border-2" name="blood_group" value="{{ $residentDatangs->blood_group }}" >
                                                    <option disabled="" selected class="text-gray-500">Pilih</option>
                                                    <option value="A" {{ $residentDatangs->blood_group=='A'?'selected':'' }}>A</option>
                                                    <option value="B" {{ $residentDatangs->blood_group=='B'?'selected':'' }}>B</option>
                                                    <option value="AB" {{ $residentDatangs->blood_group=='AB'?'selected':'' }}>AB</option>
                                                    <option value="O" {{ $residentDatangs->blood_group=='O'?'selected':'' }}>O</option>
                                                    </select>
                                                    @error('blood_group')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="religion">Agama</label>
                                                    <select type="text" id="religion" class="form-control @error('religion') is-invalid @enderror border-2" name="religion" value="{{ $residentDatangs->religion }}" >
                                                    <option disabled="" selected class="text-gray-500">Pilih Agama</option>
                                                    <option value="islam" {{ $residentDatangs->religion=='Islam'?'selected':'' }}>Islam</option>
                                                    <option value="kristen" {{ $residentDatangs->religion=='Kristen'?'selected':'' }}>Kristen</option>
                                                    <option value="katolik" {{ $residentDatangs->religion=='Katolik'?'selected':'' }}>Katolik</option>
                                                    <option value="hindu" {{ $residentDatangs->religion=='Hindu'?'selected':'' }}>Hindu</option>
                                                    <option value="buddha" {{ $residentDatangs->religion=='Buddha'?'selected':'' }}>Buddha</option>
                                                    <option value="konghucu" {{ $residentDatangs->religion=='Konghucu'?'selected':'' }}>Konghucu</option>
                                                    <option value="atheis" {{ $residentDatangs->religion=='Atheis'?'selected':'' }}>Atheis</option>
                                                    </select>
                                                    @error('religion')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select type="text" id="status" class="form-control @error('status') is-invalid @enderror border-2" name="status">
                                                        <option disabled="" class="text-gray-500">Pilih Status</option>
                                                        <option value="Pelajar" {{ $residentDatangs->status=='Pelajar'?'selected':'' }}>Pelajar</option>
                                                        <option value="Menikah" {{ $residentDatangs->status=='Menikah'?'selected':'' }}>Kawin</option>
                                                        <option value="Cerai Hidup" {{ $residentDatangs->status=='Cerai Hidup'?'selected':'' }}>Cerai Hidup</option>
                                                        <option value="Cerai Mati" {{ $residentDatangs->status=='Cerai Mati'?'selected':'' }}>Cerai Mati</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="education">Pendidikan</label>
                                                    <select type="text" id="education" class="form-control @error('education') is-invalid @enderror border-2" name="education" value="{{ $residentDatangs->education }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih Pendidikan</option>
                                                        <option value="SD" {{ $residentDatangs->education=='SD'?'selected':''}}>SD</option>
                                                        <option value="SMP" {{ $residentDatangs->education=='SMP'?'selected':''}}>SMP</option>
                                                        <option value="SMA" {{ $residentDatangs->education=='SMA'?'selected':''}}>SMA</option>
                                                        <option value="S1" {{ $residentDatangs->education=='S1'?'selected':''}}>S1</option>
                                                        <option value="S2" {{ $residentDatangs->education=='S2'?'selected':''}}>S2</option>
                                                        <option value="S3" {{ $residentDatangs->education=='S3'?'selected':''}}>S3</option>
                                                    </select>

                                                    @error('education')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="kewarganegaraan">Kewarganegaraan</label>
                                                    <select type="text" id="kewarganegaraan" class="form-control @error('kewarganegaraan') is-invalid @enderror border-2" name="kewarganegaraan" value="{{ $residentDatangs->kewarganegaraan }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih Kewarganegaraan</option>
                                                        <option value="WNI" {{ $residentDatangs->kewarganegaraan=='WNI'?'selected':''}}>WNI</option>

                                                        <option value="WNA" {{ $residentDatangs->kewarganegaraan=='WNA'?'selected':''}}>WNA</option>
                                                    </select>
                                                    @error('kewarganegaraan')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success">
                <a href="{{ route('comes.index') }}" class="text-decoration-none text-white px-3">
                    Back
                </a>
            </button>
        </div>
    </div>
@endsection

@push('afterScript')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
          this.getProvincesData();
          this.getRegenciesData();
          this.getDistrictsData();
          this.getVillagesData();
        },
        data: {
            provinces: null,
            regencies: null,
            districts: null,
            villages: null,
            provinces_id: {{ $residentDatangs->provinces_id }},
            regencies_id: {{ $residentDatangs->regencies_id }},
            districts_id: {{ $residentDatangs->districts_id }},
            villages_id: {{ $residentDatangs->villages_id }},
        },
        methods: {
            getProvincesData() {
                var self = this;
                axios.get('{{ route('api-provinces') }}')
                    .then(function(response){
                        self.provinces = response.data;
                    })
            },
            getRegenciesData() {
                var self = this;
                axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                    .then(function(response){
                        self.regencies = response.data;
                    })
            },
            getDistrictsData() {
                var self = this;
                axios.get('{{ url('api/districts') }}/' + self.regencies_id)
                    .then(function(response){
                        self.districts = response.data;
                    })
            },
            getVillagesData() {
                var self = this;
                axios.get('{{ url('api/villages') }}/' + self.districts_id)
                    .then(function(response){
                        self.villages = response.data;n
                    })
            },
        },
        watch: {
            provinces_id: function(val, oldVal) {
                this.regencies_id = null;
                this.getRegenciesData();

            },
            regencies_id: function(val, oldVal) {
                this.districts_id = null;
                this.getDistrictsData();
            },
            districts_id: function(val, oldVal) {
                this.villages_id = null;
                this.getVillagesData();
            },
        }
      });
    </script>
@endpush
