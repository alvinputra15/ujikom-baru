@extends('layout.tamplate')
@section('content')
@section('title', 'User Tambah')
@include('layout.navbar')
@include('layout.sidebar')
<div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header">
          <strong class="card-title">Form Tambah User</strong>
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
            <form class="form-valide-with-icon needs-validation" action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                @csrf
               <div class="mb-3 vertical-radius">
                    <label class="text-label form-label required" for="foto_profile">foto profile <small>(Jika ada)</small></label>
                    <div class="input-group validate-username">
                        <input type="file" class="form-control br-style" id="img"
                            id="foto_profile" name="foto_profile" value="{{old('foto_profile')}}">
                    </div>
                            <div class="mt-1">
                                <img src="" alt="" class="img-thumbnail img-preview" width="100px">
                            </div>
                            @error('foto_profile')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail4">Nis</label>
                <input type="number" class="form-control" name="nis" id="inputEmail5" placeholder="masukan nis anda">
              </div>
              <div class="form-group col-md-12">
                <label for="inputEmail4">Name</label>
                <input type="text" class="form-control" name="name" id="inputEmail5" placeholder="masukan nama anda">
              </div>
              <div class="form-group col-md-12">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" name="email" id="inputEmail5" placeholder="masukan email">
              </div>

            <div class="form-group col-md-12">
              <label for="inputPassword4">Password</label>
              <input type="password" class="form-control" name="password" id="inputPassword5" placeholder="Masukan password">
              @error('password')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
            </div>
            <div class="form-group col-md-12">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-group transparent-append validate-password">
                    <input type="password" class="form-control" id="password_confirmation" placeholder="masukan password kembali" name="password_confirmation">
                    @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
              <div class="form-group col-md-12">
                <label for="inputPassword4">Alamat</label>
                <input type="textarea" class="form-control" name="alamat" id="inputPassword5" placeholder="masukan alamat">
              </div>
              <div class="form-group col-md-12">
                <label for="inputPassword4">Telepon</label>
                <input type="number" class="form-control" name="telepon" id="inputPassword5" placeholder="masukan nomor telpon">
              </div>
              <div class="form-group col-md-12">
                <label for="inputState">Level</label>
                <select id="inputState5" name="level" class="form-control">
                  <option selected>Admin</option>
                  <option>User</option>
                  <option>Petugas</option>
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
