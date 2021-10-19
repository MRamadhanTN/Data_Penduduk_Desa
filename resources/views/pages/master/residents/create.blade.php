@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">
        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-2 d-flex justify-content-between">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('residents.index') }}">Data Penduduk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
            </ol>
        </nav>

        <div class="card p-5 border border-2">
            <div class="title text-center py-3" style="line-height: 7px">
                <h2 class="text-primary">Pendataan Penduduk</h2>
                <p>( Isi data sesuai dengan KTP atau Kartu Keluarga )</p>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="post" id="locations" action="{{ route('residents.store') }}">
                                        @csrf
                                        @method('POST')
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="name">Nama Lengkap</label>
                                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror border-2" name="name" value="{{ old('name') }}">
                                                    @error('name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="NIK">NIK</label>
                                                    <input type="number" id="NIK" class="form-control @error('NIK') is-invalid @enderror border-2" name="NIK" autocomplete="none" value="{{ old('NIK') }}">
                                                    @error('NIK')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="place_birth">Tempat Lahir</label>
                                                    <input type="text" id="place_birth" class="form-control @error('place_birth') is-invalid @enderror border-2" name="place_birth" autocomplete="none" value="{{ old('place_birth') }}">
                                                    @error('place_birth')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="birth">Tanggal Lahir</label>
                                                    <input type="date" id="birth" class="form-control @error('birth') is-invalid @enderror border-2" name="birth" autocomplete="none" value="{{ old('birth') }}">
                                                    @error('birth')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="job_id">Pekerjaan</label>
                                                    <select type="text" id="job_id" class="form-control @error('job_id') is-invalid @enderror border-2" name="job_id" value="{{ old('job_id') }}">
                                                    <option disabled="" selected class="text-gray-500">Pilih Pekerjaan</option>
                                                    @foreach ($jobs as $job)
                                                        <option value="{{ $job->id }}">{{ $job->name }}</option>
                                                    @endforeach
                                                    </select>
                                                    @error('job_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="gender">Jenis Kelamin</label>
                                                    <select type="text" id="gender" class="form-control @error('gender') is-invalid @enderror border-2" name="gender" value="{{ old('gender') }}">
                                                    <option value="Pria">Pria</option>
                                                    <option value="Wanita">Wanita</option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="RT">RT</label>
                                                    <input type="number" id="RT" class="form-control @error('RT') is-invalid @enderror border-2" name="RT" autocomplete="none" value="{{ old('RT') }}">
                                                    @error('RT')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="RW">RW</label>
                                                    <input type="number" id="RW" class="form-control @error('RW') is-invalid @enderror border-2" name="RW" autocomplete="none" value="{{ old('RW') }}">
                                                    @error('RW')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="address">Alamat</label>
                                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror border-2" name="address" autocomplete="none" value="{{ old('address') }}"></textarea>
                                                    @error('address')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="provinces_id">Provinsi</label>
                                                    <select id="provinces_id" class="form-control @error('provinces_id') is-invalid @enderror border-2" name="provinces_id" v-if="provinces" v-model="provinces_id" value="{{ old('provinces_id') }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih Provinsi</option>
                                                        <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                                    </select>
                                                    <select v-else class="form-control">
                                                        <option disabled="" selected class="text-gray-500">Pilih Provinsi</option>
                                                    </select>
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
                                                    @error('villages_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="religion">Agama</label>
                                                    <select type="text" id="religion" class="form-control @error('religion') is-invalid @enderror border-2" name="religion" value="{{ old('religion') }}">
                                                    <option disabled="" selected class="text-gray-500">Pilih Agama</option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Kristen">Kristen</option>
                                                    <option value="Katolik">Katolik</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Buddha">Buddha</option>
                                                    <option value="Konghucu">Konghucu</option>
                                                    <option value="Atheis">Atheis</option>
                                                    </select>
                                                    @error('religion')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select type="text" id="status" class="form-control @error('status') is-invalid @enderror border-2" name="status" value="{{ old('status') }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih Status</option>
                                                        <option value="Pelajar">Pelajar</option>
                                                        <option value="Menikah">Kawin</option>
                                                        <option value="Cerai Hidup">Cerai Hidup</option>
                                                        <option value="Cerai Mati">Cerai Mati</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="education">Pendidikan</label>
                                                    <select type="text" id="education" class="form-control @error('education') is-invalid @enderror border-2" name="education" value="{{ old('education') }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih Pendidikan</option>
                                                        <option value="SD">SD</option>
                                                        <option value="SMP">SMP</option>
                                                        <option value="SMA">SMA</option>
                                                        <option value="S1">S1</option>
                                                        <option value="S2">S2</option>
                                                        <option value="S3">S3</option>
                                                    </select>
                                                    @error('education')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="blood_group">Golongan Darah</label>
                                                    <select type="text" id="blood_group" class="form-control @error('blood_group') is-invalid @enderror border-2" name="blood_group" value="{{ old('blood_group') }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih Golongan Darah</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="AB">AB</option>
                                                        <option value="O">O</option>
                                                    </select>
                                                    @error('blood_group')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="kewarganegaraan">Kewarganegaraan</label>
                                                    <select type="text" id="kewarganegaraan" class="form-control @error('kewarganegaraan') is-invalid @enderror border-2" name="kewarganegaraan" value="{{ old('kewarganegaraan') }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih Kewarganegaraan</option>
                                                        <option value="WNI">WNI</option>
                                                        <option value="WNA">WNA</option>
                                                    </select>
                                                    @error('kewarganegaraan')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="category">Kategori</label>
                                                    <select type="text" id="category" class="form-control @error('category') is-invalid @enderror border-2" name="category" value="{{ old('category') }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih Kategori</option>
                                                        <option value="Penduduk Tetap">Penduduk Tetap</option>
                                                        <option value="Penduduk Pindah">Penduduk Pindah</option>
                                                        <option value="Penduduk Datang">Penduduk Datang</option>
                                                    </select>
                                                    @error('category')
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
                <a href="{{ route('residents.index') }}" class="text-decoration-none text-white px-3">
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
        },
        data: {
            provinces: null,
            regencies: null,
            districts: null,
            villages: null,
            provinces_id: null,
            regencies_id: null,
            districts_id: null,
            villages_id: null,
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
