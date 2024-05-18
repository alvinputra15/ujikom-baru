@extends('layout.tamplate')
@section('content')
@section('title', 'Tahun ajaran Tambah')
@include('layout.navbar')
@include('layout.sidebar')
<div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header">
          <strong class="card-title">Form Tambah Tahun ajaran</strong>
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
            <form class="form-valide-with-icon needs-validation" action="{{route('ajaran.store')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="kelas">Kode_ajaran</label>
                <?php
                 $kodeajaran = autonumber('ajarans','kode_ajaran',3, 'AJR');
                ?>
                <input type="text" class="form-control" name="kode_ajaran" readonly id="kode_ajaran" value="<?= $kodeajaran ?>">
              </div>

              <div class="form-group col-md-12">
                <label for="kelas">Tahun ajaran</label>
                <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" placeholder="masukan Kelas">
              </div>
            <button type="submit" class="btn btn-primary">kirim</button>
            <a href="{{route('kelas.index')}}" class="btn btn-dangear">Kembali</a>
          </form>
        </div> <!-- /. card-body -->
      </div> <!-- /. card -->
    </div> <!-- /. col -->
  </div>
  @endsection
