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
                <!-- table -->
                <button class="btn btn-info" onclick="window.print()">Print</button>
                <table class="table datatables" id="dataTable-1">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama petugas</th>
                      <th>Nama siswa</th>
                      <th>Kelas</th>
                      {{-- <th>bulan</th> --}}
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
                        <td>{{ $item->User->name }}</td>
                        <td>{{ $item->Kelas->kelas }}</td>
                        <td>{{ $item->bulan }}</td>
                        <td>{{ $item->nominal }}</td>
                        <td>{{ $item->nominal * $item->bulan}}</td>
                        <td>{{ $item->status_pembayaran }}</td>

                        </td>
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
