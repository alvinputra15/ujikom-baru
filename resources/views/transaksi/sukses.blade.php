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
                    <button class="print btn btn-info float-right" onclick="window.print()">print</button>
                <p class="text-muted font-14">
                    Terimakasih telah melakukan pembayaran
                </p>
                <h3>Detail pembayaran:</h3>
                <table class="table datatables" >
                    <thead>
                      <tr>
                        <th>Nama siswa</th>
                        <th>Kelas</th>
                        <th>tahun ajaran</th>
                        <th>metode pembayaran</th>
                        <th>bulan</th>
                        <th>Nominal</th>
                        <th>status</th>
                        <th>Tanggal transaksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td>{{ $user->name }}</td>
                          <td>{{ $kelas->kelas }}</td>
                          <td>{{ $ajaran->tahun_ajaran }}</td>
                          <td>{{ $metode->metode_pembayaran }}</td>
                          <td>{{ $transaksi->bulan }} bulan</td>
                          <td>Rp{{ number_format($transaksi->nominal , 2,',' , '.')}}</td>
                          <td>{{ $transaksi->status_pembayaran }}</td>
                          <td>{{ $transaksi->tanggal_transaksi }}</td>
                              </form>
                            </div>
                          </td>
                        </tr>

                    </tbody>
                  </table>
                  <div class="float-right">
                    <h6>Di data oleh: {{Auth::user()->name}}</h6>
                    <h6>Total: Rp{{ number_format($transaksi->nominal * $transaksi->bulan, 2 ,',', '.')}}</h6>
                  </div>

                </div>
                <a href="{{route('bayar.spp')}}" class="btn btn-primary mt-4">Lihat transaksi</a>
              </div>
            </div>
          </div> <!-- simple table -->
        </div> <!-- end section -->
      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div>

@endsection
