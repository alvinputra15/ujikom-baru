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
                <a  class="btn mb-2 btn-primary"  href="{{ route('bayar.tambah') }}">Tambah</a>
                <!-- table -->
                <table class="table datatables" id="dataTable-1">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama petugas</th>
                      <th>Nama siswa</th>
                      <th>Kelas</th>
                      <th>Nominal</th>
                      <th>status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($transaksi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_petugas }}</td>
                        <td>{{ $item->User->name }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->nominal }}</td>
                        <td>{{ $item->status_pembayaran }}</td>
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('transaksi.edit', $item->id_kelas) }}">Edit</a>
                            <form action="{{ route("transaksi.delete",["id_kelas" => $item->id_kelas])}}" method="POST" class="dropdown-item">
                                @csrf
                                <button type="submit">Hapus</button>
                            </form>
                          </div>
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
