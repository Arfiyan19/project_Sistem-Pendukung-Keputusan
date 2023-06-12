<!-- Modal -->
<div class="modal fade" id="kriteria_edit2_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="kriteria_edit2">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="item_code">Kode Kriteria</label>
                                <input type="text" name="item_code" class="form-control" id="code_create" name="code_create">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Nama Kriteria</label>
                                    <input type="text" class="form-control" id="name_create" name="name_create">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="brand">Bobot</label>
                                    <input type="text" class="form-control" id="bobot_create" name="bobot_create">
                                </div>
                            </div>




                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="condition">Atribut Kriteria</label>
                                    <select class="custom-select" id="atribut_create" name="atribut_create">
                                        <option selected>Pilih</option>
                                        <option value="Benefit">Benefit</option>
                                        <option value="Cost">Cost</option>
                                        <!-- <option value="3">Rusak Ringan</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>