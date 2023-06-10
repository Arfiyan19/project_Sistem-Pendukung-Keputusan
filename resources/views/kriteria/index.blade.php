@extends('layouts.stisla.index', ['title' => 'Halaman Data Kriteria', 'page_heading' => 'Daftar Kriteria'])

@section('content')
<div class="card">
  <div class="row">
    <div class="col-lg-12">
      <button type="button" class="btn btn-primary float-right mt-3 mx-3" data-toggle="modal" data-target="#kriteria_create_modal">
        <i class="fas fa-fw fa-plus"></i>
        Tambah Data
      </button>

    </div>
  </div>
  <div class="row px-3 py-3">
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="datatable">

          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Bobot</th>
              <th scope="col">Code</th>
              <th scope="col">Atribut</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $data)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $data->name }}</td>
              <td>{{ $data->bobot }}</td>
              <td>{{ $data->code }}</td>
              <td>{{ $data->atribut }}</td>
              <td class="text-center">
                <a data-id="{{ $data->id }}" class="btn btn-sm btn-info text-white show_modal" data-toggle="modal" data-target="#show_data">
                  <i class="fas fa-fw fa-info"></i>
                </a>
                <a data-id="{{ $data->id }}" class="btn btn-sm btn-success text-white swal-edit-button" data-toggle="modal" data-target="#kriteria_edit_modal" data-placement="top" title="Ubah data">
                  <i class="fas fa-fw fa-edit"></i>
                </a>
                <a data-id="{{ $data->id }}" class="btn btn-sm btn-danger text-white swal-delete-button" data-toggle="tooltip" data-placement="top" title="Hapus data">
                  <i class="fas fa-fw fa-trash-alt"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('modal')
@include('kriteria.modal.create')
@include('kriteria.modal.show')
@include('kriteria.modal.edit')
@endpush

@push('js')
@include('kriteria._script')
@endpush