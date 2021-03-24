<div class="panel">
    <div class="panel-heading">
        <h3 style="display: inline-block; border-bottom: 1px solid black; padding-bottom: 0.5rem">
            Rincian Faktur Pembelian
        </h3>
        <a href="{{ route('pembelian.index') }}" class="right btn btn-info">
            Kembali
        </a>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Tgl Transaksi</label>
                    <h3 style="margin: 0px;">
                        {{ date('d-m-Y', strtotime($pembelian->tgl_transaksi)) }}
                    </h3>
                </div>
                <div class="form-group">
                    <label for="no_faktur">No Faktur</label>
                    <input type="text" name="no_faktur" id="no_faktur" class="form-control" value="{{ $pembelian->no_faktur }}" disabled>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <input type="text" name="jth_tempo" id="jth_tempo" class="form-control" value="{{ $pembelian->supplier->nama_supplier }}" disabled>
                </div>
                <div class="form-group">
                    <label for="jth_tempo">Tgl Jatuh Tempo</label>
                    <input type="text" name="jth_tempo" id="jth_tempo" class="form-control" value="{{ date('d-m-Y',strtotime($pembelian->tgl_jatuh_tempo)) }}" disabled>
                </div>
            </div>
        </div>
    </div>
</div>
