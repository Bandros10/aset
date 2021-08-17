@extends('layouts.app')
@section('title')
<title>Users Create</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                        <li class="breadcrumb-item active">Add New</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    ​
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <x-card>
                        @slot('title')
                            <h3>Tambah Data User</h3>
                        @endslot

                        @if (session('error'))
                        <x-alert type="danger">
                            {!! session('error') !!}
                        </x-alert>
                        @endif

                        <form action="{{ route('users.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}"
                                    required>
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}"
                                    required>
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid':'' }}" required>
                                    <option disabled selected>- pilih jenis kelamin -</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">perempuan</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('jenis_kelamin') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <input type="jabatan" name="jabatan"
                                    class="form-control {{ $errors->has('jabatan') ? 'is-invalid':'' }}" required>
                                <p class="text-danger">{{ $errors->first('jabatan') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Divisi</label>
                                <input type="divisi" name="divisi"
                                    class="form-control {{ $errors->has('divisi') ? 'is-invalid':'' }}" required>
                                <p class="text-danger">{{ $errors->first('divisi') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" class="form-control {{ $errors->has('divisi') ? 'is-invalid':'' }}"></textarea>
                                <p class="text-danger">{{ $errors->first('alamat') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}" required>
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Role</label>
                                <select name="role" class="form-control {{ $errors->has('role') ? 'is-invalid':'' }}" required>
                                    <option value="">Pilih</option>
                                    @foreach ($role as $row)
                                    <option value="{{ $row->name }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('role') }}</p>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm">
                                    <i class="fa fa-send"></i> Simpan
                                </button>
                            </div>
                        </form>
                        @slot('footer')
                        ​
                        @endslot
                    </x-card>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
