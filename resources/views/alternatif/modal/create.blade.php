<!-- Modal -->
<div class="modal fade" id="alternatif_create_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"> Tambah Alternatif dan Nilai Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="alternatif_create">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="item_code">Id Alternatif</label>
                                <!-- auto increment -->
                                <?php

                                use Illuminate\Support\Facades\DB as db;

                                $query = db::table('alternatifs')->select('id')->orderBy('id', 'desc')->limit(1)->get();
                                if ($query->isEmpty()) {
                                    $id = 1;
                                    echo "<input type='hidden' class='form-control' id='id_alter2natif' name='id_alter2natif' value='$id' readonly>";
                                    echo "<input type='text' class='form-control' id='id_alternatif' name='id_alternatif' value='$id' readonly>";
                                } else {
                                    foreach ($query as $row) {
                                        $id = $row->id + 1;
                                        echo "<input type='hidden' class='form-control' id='id_alter2natif' name='id_alter2natif' value='$id' readonly>";
                                        echo "<input type='text' class='form-control' id='id_alternatif' name='id_alternatif' value='$id' readonly>";
                                    }
                                }
                                ?>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nama alternatif">Nama Alternatif</label>
                                <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 align="center">Nilai Kriteria</h5>
                    <hr>

                    <div class="row">
                        @foreach($kriteria as $row)
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nama Kriteria" style="text-transform: uppercase;"> <b style="text-transform: uppercase;">{{ $row->code }}</b> &nbsp; {{ $row->name }} </label>
                                <input type="hidden" class="form-control" id="id_kriteria[]" name="id_kriteria[]" value="{{ $row->id }}" readonly>
                                <input type="text" class="form-control" id="nilai_kriteria[]" name="nilai_kriteria[]">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>