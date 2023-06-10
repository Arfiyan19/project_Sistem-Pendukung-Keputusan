@extends('layouts.stisla.index', ['title' => 'Halaman Data Alternatif', 'page_heading' => 'Perhitungan'])

@section('content')
<div class="card">
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-primary float-right mt-3 mx-3" data-toggle="modal" data-target="#alternatif_create_modal">
                <i class="fas fa-fw fa-plus"></i>
                Tambah Data Perhitungan
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
                            <th scope="col">Data</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
@include('perhitungan.modal.create')
@include('perhitungan.modal.show')
@include('perhitungan.modal.edit')
@endpush

@push('js')
@include('perhitungan._script')
@endpush