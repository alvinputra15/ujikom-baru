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
                <div class="text-center">
                    <h1 class=" text-success">Pembayaran Spp Sukses</h1>
                <p class="text-muted font-14">
                    Terimakasih telah melakukan pembayaran  
                </p>
                <h3>Detail pembayaran:</h3>
                <table class="table datatables" id="dataTable-1">
                    <thead>
                      <tr>
                        <th>Nama siswa</th>
                        <th>Kelas</th>
                        <th>bulan</th>
                        <th>Nominal</th>
                        <th>Total</th>
                        <th>status</th>
                        <th>Didata oleh</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td>{{ $user->name }}</td>
                          <td>{{ $transaksi->kelas }}</td>
                          <td>{{ $transaksi->bulan }} bulan</td>
                          <td>{{ $transaksi->nominal }}</td>
                          <td>{{ $transaksi->nominal * $transaksi->bulan}}</td>
                    
                          <td>{{ $transaksi->status_pembayaran }}</td>
                          <td>{{ $petugas->name }}</td>
                          <td>{{ $petugas->created_at }}</td>
                    
                              </form>
                            </div>
                          </td>
                        </tr>
  
                    </tbody>
                  </table>
                <a href="{{route('bayar.spp')}}" class="btn btn-primary">Lihat transaksi</a>
                </div>
              </div>
            </div>
          </div> <!-- simple table -->
        </div> <!-- end section -->
      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div>

@endsection
