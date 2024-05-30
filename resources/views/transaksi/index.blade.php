@extends('layout.tamplate')
@section('content')
@section('title', 'transaksi')
@include('layout.navbar')
@include('layout.sidebar')
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="mb-2 page-title">Data table</h2>
        <p class="card-text">DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, built upon the foundations of progressive enhancement, that adds all of these advanced features to any HTML table. </p>
        <div class="row my-4">
          <!-- Small table -->
          <div class="col-md-12">
            <div class="card shadow">
              <div class="card-body">



                <form action="{{ route('bayar.spp') }}" method="GET">
                  <h4>Filter data bayar spp tahun ajaran</h4>
                  <select name="tahun_ajaran" onchange="this.form.submit()" class="form-control mb-2" style="width:268px">
                      <option value="">All</option>
                      @foreach ($ajaran as $item)
                          <option value="{{ $item->tahun_ajaran }}" @if ($selectedCategory == $item->tahun_ajaran) selected @endif>
                              {{ $item->tahun_ajaran }}
                          </option>
                      @endforeach
                  </select>
              </form>

                  <a  class="btn mb-2 btn-primary"  href="{{ route('bayar.tambah') }}">Tambah</a>
                <!-- table -->
                <table class="table datatables" id="dataTable-1">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama siswa</th>
                      {{-- <th>bulan</th> --}}
                      <th>Tanggal transaksi</th>
                      <th>Kelas</th>
                      <th>Tahun ajaran</th>
                      <th>metode pembayaran</th>
                      <th>spp bulan</th>
                      <th>Nominal</th>
                      <th>total</th>
                      <th>status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($transaksi as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->User->name }}</td>
                      {{-- <td>{{ $item->bulan1 }}</td> --}}
                      <td>{{ $item->tanggal_transaksi }}</td>
                      <td>{{ $item->Kelas->kelas }}</td>
                      <td>{{ $item->Ajaran->tahun_ajaran }}</td>
                      <td>{{ $item->Metode->metode_pembayaran }}</td>
                      <td>{{ $item->bulan }}</td>
                      <td>{{ $item->nominal }}</td>
                      <td>{{ $item->nominal * $item->bulan}}</td>
                      <td>{{ $item->status_pembayaran }}</td>
                      </tr>
                    @endforeach


                  </tbody>
                </table>
              </div>
            </div>
          </div> <!-- simple table -->
        </div> <!-- end section -->
      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div>

@endsection
