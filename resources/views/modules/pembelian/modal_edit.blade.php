  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form_modal" action="{{ route('pembelian.update_obat') }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="id_obat" id="id_obat">
            <input type="hidden" name="no_batch" id="no_batch">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="modal_nama_obat">Obat</label>
                            <input type="text" name="modal_nama_obat" id="modal_nama_obat" class="form-control" disabled>
                            @error('obat')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="modal_harga_beli">Harga Beli</label>
                            <input type="number" name="modal_harga_beli" id="modal_harga_beli" class="form-control" >
                            @error('harga_beli')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="modal_jumlah">Jumlah</label>
                            <input type="number" name="modal_jumlah" id="modal_jumlah" class="form-control" >
                            @error('jumlah')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="modal_diskon">Diskon</label>
                            <input type="number" name="modal_diskon" id="modal_diskon" class="form-control" >
                            @error('diskon')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
