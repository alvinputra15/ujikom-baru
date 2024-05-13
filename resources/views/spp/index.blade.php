@extends('layout.tamplate')
@section('content')
@section('title', 'Spp ')
@include('layout.navbar')
@include('layout.sidebar')

<div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header">
          <strong class="card-title">Atur nominal Spp</strong>
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
            <form class="form-valide-with-icon needs-validation" action="{{route('spp.update',$spp->id_spp  )}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="form-group col-md-12">
                <label for="nominal">Harga spp</label>
                <input type="number" class="form-control" name="nominal" id="nominal" value="{{$spp->nominal}}">
                @error('nominal')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
              </div>
        
            <button type="submit" class="btn btn-primary">kirim</button>
            <a href="{{route('spp.index')}}" class="btn btn-danger">Kembali</a>
          </form>
        </div> <!-- /. card-body -->
      </div> <!-- /. card -->
    </div> <!-- /. col -->
  </div>

@endsection
