@extends('layouts.app')
@section('title')
<title>Users edit</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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

                        @endslot

                        @if (session('error'))
                        <x-alert type="danger">
                            {!! session('error') !!}
                        </x-alert>

                        @endif

                        <form action="{{ route('users.update', $user->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="name" value="{{ $user->name }}"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}"
                                    class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" required readonly>
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid':'' }}" required>
                                    <option disabled selected>- pilih jenis kelamin -</option>
                                    <option value="laki-laki" {{ $user->jenis_kelamin == "laki-laki" ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ $user->jenis_kelamin == "perempuan" ? 'selected' : '' }}>perempuan</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('jenis_kelamin') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <input type="jabatan" name="jabatan"
                                    class="form-control {{ $errors->has('jabatan') ? 'is-invalid':'' }}" value="{{$user->jabatan}}">
                                <p class="text-danger">{{ $errors->first('jabatan') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Divisi</label>
                                <input type="divisi" name="divisi"
                                    class="form-control {{ $errors->has('divisi') ? 'is-invalid':'' }}" value="{{$user->divisi}}">
                                <p class="text-danger">{{ $errors->first('divisi') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" class="form-control {{ $errors->has('divisi') ? 'is-invalid':'' }}">{{$user->alamat}}</textarea>
                                <p class="text-danger">{{ $errors->first('alamat') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                <p class="text-warning">Biarkan kosong, jika tidak ingin mengganti password</p>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm">
                                    <i class="fa fa-send"></i> Update
                                </button>
                            </div>
                        </form>
                        @slot('footer')
                        @endslot
                    </x-card>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
