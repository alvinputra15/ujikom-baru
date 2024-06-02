@extends('layout.tamplate')
@section('content')
@section('title', 'Tingkat Tambah')
@include('layout.navbar')
@include('layout.sidebar')
<div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header">
          <strong class="card-title">Form Tambah Tingkat</strong>
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
            <form class="form-valide-with-icon needs-validation" action="{{route('tingkat.store')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="kelas">Kode_Tingkat</label>
                <?php
                 $kodeajaran = autonumber('tingkats','kode_tingkat',3, 'TKT');
                ?>
                <input type="text" class="form-control" name="kode_tingkat" readonly id="kode_tingkat" value="<?= $kodeajaran ?>">
              </div>

              <div class="form-group col-md-12">
                <label for="kelas">Tingkat</label>
                <input type="text" class="form-control" name="tingkat" id="tingkat" placeholder="tingkat">
              </div>
            <button type="submit" class="btn btn-primary">kirim</button>
            <a href="{{route('tingkat.index')}}" class="btn btn-dangear">Kembali</a>
          </form>
        </div> <!-- /. card-body -->
      </div> <!-- /. card -->
    </div> <!-- /. col -->
  </div>
  @endsection
