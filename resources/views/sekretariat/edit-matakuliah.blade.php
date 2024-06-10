@extends('layout.template')
@section('konten')

<!-- START FORM -->
<form action='{{ url('sekretariat/'.$data->id_matakuliah ) }}' method='post'>
@csrf
@method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <a href="{{ url('sekretariat') }}" class="btn btn-secondary">Kembali</a>

            <div class="mb-3 row">
                <label for="id_matakuliah" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-10">
                    {{ $data->id_matakuliah }}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_matakuliah" class="col-sm-2 col-form-label">Nama Matakuliah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama_matakuliah' id="nama_matakuliah" value="{{ $data->nama_matakuliah }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="sks" class="col-sm-2 col-form-label">SKS</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='sks' id="sks" value="{{ $data->sks }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='semester' id="semester" value="{{ $data->semester }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="perkuliahan" class="col-sm-2 col-form-label">Perkuliahan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='perkuliahan' id="perkuliahan" value="{{ $data->perkuliahan }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_dosen" class="col-sm-2 col-form-label">Dosen</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama_dosen' id="nama_dosen" value="{{ $data->dosen->nama_dosen }}">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2"><button type="submit" class="btn btn-primary" name="submit">Simpan</button></div>
            </div>
</form>
        </div>
        <!-- AKHIR FORM -->
@endsection