@extends('layout.tamplate')
@section('content')
@section('title', 'Profile ')
@include('layout.navbar')
@include('layout.sidebar')

<div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header">
          <strong class="card-title">Form Setting</strong>
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
            <form class="form-valide-with-icon needs-validation" action="{{route('setting.update',$setting->id_setting  )}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 vertical-radius">
                    <label class="text-label form-label required" for="logo">foto profile</label>
                    <div class="input-group validate-username">
                        <input type="file" class="form-control br-style"
                            id="logo" name="logo">
                    </div>
                            @empty($setting->logo)
                            <p>Foto Profile tidak ada</p>
                        @else
                        <small  >Foto lama:</small>
                            <div class="mt-2" >

                                <img src="{{asset('storage/back/logo/'.$setting->logo) }}" class="img-thumbnail img-preview" alt="Foto Pengguna" width="120px">
                            </div>
                        @endempty
                            @error('logo')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail4">Nama sekolah</label>
                <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="{{$setting->nama_sekolah}}">
                @error('nama_sekolah')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
              </div>
              <div class="form-group col-md-12">
                <label for="inputEmail4">ALamat</label>
      <textarea name="alamat" class="form-control" id="" cols="30" rows="10">{{ $setting->alamat }}</textarea>
                @error('alamat')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
              </div>
              <div class="form-group col-md-12">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" name="email" id="inputEmail5" value="{{$setting->email}}">
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
              </div>

            <div class="form-group col-md-12">
                <label for="inputPassword4">Website</label>
                <input type="url" class="form-control" name="website" value="{{$setting->website}}">
                @error('website')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>

              <div class="form-group col-md-12">
                <label for="inputPassword4">NPSN</label>
                <input type="number" class="form-control" name="npsn" id="inputPassword5" value="{{$setting->npsn}}">
                @error('npsn')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>


            </div>
            <button type="submit" class="btn btn-primary">kirim</button>
            <a href="{{route('setting.index')}}" class="btn btn-danger">Kembali</a>
          </form>
        </div> <!-- /. card-body -->
      </div> <!-- /. card -->
    </div> <!-- /. col -->
  </div>

@endsection
