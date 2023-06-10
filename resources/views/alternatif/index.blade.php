@extends('layouts.stisla.index', ['title' => 'Halaman Data Alternatif', 'page_heading' => 'Daftar Alternatif'])

@section('content')
<div class="card">
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-primary float-right mt-3 mx-3" data-toggle="modal" data-target="#alternatif_create_modal">
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
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($alternatif as $row)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $row->nama }}</td>
                            <td class="text-left">
                                <a data-id="{{ $row->id }}" class="btn btn-sm btn-info text-white show_modal" data-toggle="modal" data-target="#show_alternatif">
                                    <i class="fas fa-fw fa-info"></i>
                                </a>
                                <a data-id="{{ $row->id }}" class="btn btn-sm btn-success text-white swal-edit-button" data-toggle="modal" data-target="#alternatif_edit_modal" data-placement="top" title="Ubah data">
                                    <i class="fas fa-fw fa-edit"></i>
                                </a>
                                <a data-id="{{ $row->id }}" class="btn btn-sm btn-danger text-white swal-delete-button" data-toggle="tooltip" data-placement="top" title="Hapus data">
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
@include('alternatif.modal.create')
@include('alternatif.modal.show')
@include('alternatif.modal.edit')
@endpush

@push('js')
@include('alternatif._script')
@endpush