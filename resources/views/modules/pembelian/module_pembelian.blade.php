<div class="panel">
    <div class="panel-heading">
        <h3 style="display: inline-block; border-bottom: 1px solid black; padding-bottom: 0.5rem">
            Form Faktur Pembelian
        </h3>
        @if (session('success_faktur'))
            <div class="alert alert-success">
                Berhasil menambahkan Faktur
            </div>
        @endif
    </div>
    <div class="panel-body">
        <form action="{{ route('pembelian.tambah_faktur') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Tgl Transaksi</label>
                        <h3 style="margin: 0px;">
                            {{ date('d-m-Y', strtotime(now())) }}
                        </h3>
                    </div>
                    <div class="form-group">
                        <label for="no_faktur">No Faktur</label>
                        <input type="text" name="no_faktur" id="no_faktur" class="form-control" placeholder="No Faktur" value="{{ $faktur != null ? $faktur['no_faktur'] : '' }}">
                        @error('no_faktur')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="supplier">Supplier</label>
                        <select name="supplier" id="supplier" class="form-control">
                            <option value="">Pilih Supplier</option>
                            @foreach ($supplier as $s)
                            <option value="{{ $s->id_supplier }}" {{ $faktur != null ? MenuActiveHelpers::set_selected($faktur['supplier'], $s->id_supplier) : '' }} >{{ $s->nama_supplier }}</option>
                            @endforeach
                        </select>
                        @error('supplier')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jth_tempo">Tgl Jatuh Tempo</label>
                        <input type="date" name="jth_tempo" id="jth_tempo" class="form-control" placeholder="Tanggal Jatuh Tempo" value="{{ $faktur != null ? $faktur['jth_tempo'] : '' }}">
                        @error('jth_tempo')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="margin-top: .8rem">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
