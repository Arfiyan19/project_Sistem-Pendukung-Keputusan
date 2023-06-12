<!-- Modal -->
<div class="modal fade" id="show_kriteria" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table" id=table>
          <tr>
            <td style="width: 145px;">
              <b>Nama</b>
            </td>
            <td style="width: 20px;">:</td>
            <td id="name"></td>
          </tr>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id='tutup'>Tutup</button>
      </div>
    </div>
  </div>
</div>
<script>
  // button tutup klik reload page  
  $('#tutup').click(function() {
    location.reload();
  });
</script>