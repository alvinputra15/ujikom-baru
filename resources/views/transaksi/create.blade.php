@extends('layout.tamplate')
@section('content')
@section('title', 'tambah bayar spp')
@include('layout.navbar')
@include('layout.sidebar')
<div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header">
          <strong class="card-title">Form Tambah Bayar SPP</strong>
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
            <form class="form-valide-with-icon needs-validation" action="{{route('bayar.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="kelas">kode transaksi</label>
                    <?php
                     $kodeTransaksi = autonumber('transaksi','kode_transaksi',3, 'TKS');
                    ?>
                    <input type="text" class="form-control" name="kode_transaksi" readonly id="kode_transaksi" value="<?= $kodeTransaksi ?>">
                  </div>
                  </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" >
                  </div>
                  </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="user_id">Nama siswa</label>
                <select name="user_id" id="nama_siswa" class="form-control">
                    <option value="" selected disabled hidden>Pilih nama siswa</option>
                    @foreach ($levelUser as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                </select>
              </div>
              <hr>
              <div id="user-info">
                <p class="col-12">nis: <span id="nis"></span></p>
                <hr>
                <p class="col-12">telepon: <span id="telepon"></span></p>
                <hr>
                <p class="col-12">email: <span id="email"></span></p>
                <hr>
                <p class="col-12">alamat: <span id="alamat"></span></p>
            </div>
              </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="kelas_id">Kelas</label>
                      <select name="kelas_id" id="kelas_id" class="form-control">
                        <option value="" selected disabled hidden>Pilih Kelas</option>
                        @foreach ($kelas as $item)
                        <option value="{{$item->id_kelas}}">{{$item->kelas}}</option>
                    @endforeach
                      </select>
                    </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="ajaran_kode">ajaran</label>
                        <select name="ajaran_kode" id="ajaran_kode" class="form-control">
                          <option value="" selected disabled hidden>Pilih Tahun ajaran</option>
                          @foreach ($ajaran as $item)
                          <option value="{{$item->kode_ajaran}}">{{$item->tahun_ajaran}}</option>
                      @endforeach
                        </select>
                      </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="metode_kode">metode pembayaran</label>
                          <select name="metode_kode" id="metode_kode" class="form-control">
                            <option value="" selected disabled hidden>Pilih Tahun metode</option>
                            @foreach ($metode as $item)
                            <option value="{{$item->kode_metode}}">{{$item->metode_pembayaran}}</option>
                        @endforeach
                          </select>
                        </div>
                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="bulan">Bulan</label>
                          <select name="bulan" id="" class="form-control">
                            <option value="" selected disabled hidden></option>
                            <option value="1">1 bulan</option>
                            <option value="2">2 bulan</option>
                            <option value="3">3 bulan</option>
                            <option value="4">4 bulan</option>
                            <option value="5">5 bulan</option>
                            <option value="6">6 bulan</option>
                            <option value="7">7 bulan</option>
                            <option value="8">8 bulan</option>
                            <option value="9">9 bulan</option>
                            <option value="10">10 bulan</option>
                            <option value="11">11 bulan</option>
                            <option value="12">12 bulan</option>
                          </select>
                        </div>
                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="nominal">Nominal</label>
                          <input type="number" class="form-control" name="nominal" id="nominal" value="{{$nominal->nominal}}" readonly>
                        </div>
                        </div>
            <button type="submit" class="btn btn-primary">kirim</button>
            <a href="{{route('bayar.spp')}}" class="btn btn-danger">Kembali</a>
          </form>
        </div> <!-- /. card-body -->
      </div> <!-- /. card -->
    </div> <!-- /. col -->
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
        $('#nama_siswa').change(function(){
            var userId = $(this).val();
            if(userId){
                $.ajax({
                    type:"GET",
                    url:"/get-user-info/"+userId, // Update with correct URL
                    success:function(response){
                        if(response){
                            $('#nis').text(response.nis);
                            $('#telepon').text(response.telepon);
                            $('#email').text(response.email);
                            $('#alamat').text(response.alamat);
                        }
                    }
                });
            }
        });
    });
</script>

  @endsection
