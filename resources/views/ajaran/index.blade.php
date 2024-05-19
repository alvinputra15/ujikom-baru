@extends('layout.tamplate')
@section('content')
@section('title', 'ajaran')
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
                <a  class="btn mb-2 btn-primary"  href="{{ route('ajaran.tambah') }}">Tambah</a>
                <!-- table -->
                <table class="table datatables" id="dataTable-1">
                  <thead>
                    <tr>
                      <th>kode</th>
                      <th>Tahun ajaran</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($ajarans as $item)
                    <tr>
                        <td>{{ $item->kode_ajaran}}</td>
                        <td>{{ $item->tahun_ajaran }}</td>

                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('ajaran.edit', $item->kode_ajaran) }}">Edit</a>
                            <form action="{{ route("ajaran.delete",["kode_ajaran" => $item->kode_ajaran])}}" method="POST" class="dropdown-item">
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
