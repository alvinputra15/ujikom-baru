@extends('layout.tamplate')
@section('content')
@section('title', 'Metode pembayaran Edit')
@include('layout.navbar')
@include('layout.sidebar')
<div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header">
          <strong class="card-title">Form Edit metode pembayaran</strong>
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
            <form class="form-valide-with-icon needs-validation" action="{{route('metode.update', $metode->kode_metode)}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="kelas">kode metode pembayaran</label>
                <input type="text" class="form-control" name="kode_metode" readonly id="kode_metode" value="{{$metode->kode_metode}}">
              </div>

              <div class="form-group col-md-12">
                <label for="metode_pembayaran">metode pembayaran</label>
                <input type="text" class="form-control" name="metode_pembayaran" id="metode_pembayaran" value="{{$metode->metode_pembayaran}}">
              </div>
            <button type="submit" class="btn btn-primary">kirim</button>
            <a href="{{route('metode.index')}}" class="btn btn-dangear">Kembali</a>
          </form>
        </div> <!-- /. card-body -->
      </div> <!-- /. card -->
    </div> <!-- /. col -->
  </div>
  @endsection
