@extends('layout.tamplate')
@section('content')
@section('title', 'User Edit')
@include('layout.navbar')
@include('layout.sidebar')

<div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header">
          <strong class="card-title">Form Edit User</strong>
        </div>
        @if ($errors->any())
        <div class="my-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        <div class="card-body">
            <form class="form-valide-with-icon needs-validation" action="{{route('user.update',$user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 vertical-radius">
                    <label class="text-label form-label required" for="foto_profile">foto profile</label>
                    <div class="input-group validate-username">
                        <input type="file" class="form-control br-style"
                            id="foto_profile" name="foto_profile">
                    </div>
                            @empty($user->foto_profile)
                            <p>Foto Profile tidak ada</p>
                        @else
                            <div class="mt-2" >
                                <small  >Foto lama:</small>
                                <img src="{{asset('storage/back/foto-profile/'.$user->foto_profile) }}" class="img-thumbnail img-preview" alt="Foto Pengguna" width="120px">
                            </div>
                        @endempty
                            @error('foto_profile')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail4">Nis</label>
                <input type="number" class="form-control" id="nis" name="nis" value="{{$user->nis}}">
                @error('nis')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
              </div>
              <div class="form-group col-md-12">
                <label for="inputEmail4">Name</label>
                <input type="text" class="form-control" name="name" id="inputEmail5"id="name" name="name" value="{{$user->name}}">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
              </div>
              <div class="form-group col-md-12">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" name="email" id="inputEmail5" value="{{$user->email}}">
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
              </div>

            <div class="form-group col-md-12">
              <label for="inputPassword4">Password</label>
              <input type="password" class="form-control" name="password" id="inputPassword5" >
              @error('password')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
            </div>
            <div class="form-group col-md-12">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-group transparent-append validate-password">
                    <input type="password" class="form-control" id="password_confirmation"   name="password_confirmation">
                    @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
              <div class="form-group col-md-12">
                <label for="inputPassword4">Alamat</label>
                <input type="textarea" class="form-control" name="alamat" id="inputPassword5"  value="{{$user->alamat}}">
                @error('alamat')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
              </div>
              <div class="form-group col-md-12">
                <label for="inputPassword4">Telepon</label>
                <input type="number" class="form-control" name="telepon" id="inputPassword5"  value="{{$user->telepon}}">
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
              </div>
              <div class="form-group col-md-12">
                <label for="inputState">Level</label>
                <select id="inputState5" name="level" class="form-control">
                    @foreach ($levels as $level)
                    <option value="{{ $level }}" {{ old('level', $user->level) == $level ? 'selected' : '' }}>
                        {{ $level }}
                    </option>
                @endforeach
                </select>
              </div>

            </div>
            <button type="submit" class="btn btn-primary">kirim</button>
            <a href="{{route('user.index')}}" class="btn btn-danger">Kembali</a>
          </form>
        </div> <!-- /. card-body -->
      </div> <!-- /. card -->
    </div> <!-- /. col -->
  </div>

@endsection
