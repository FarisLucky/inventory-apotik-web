<div class="panel">
    <div class="panel-heading">
        <h3 style="display: inline-block; border-bottom: 1px solid black; padding-bottom: 0.5rem">
            Form Obat
        </h3>
        @if (session('success_obat'))
            <div class="alert alert-success">
                Berhasil menambahkan Obat
            </div>
        @endif
    </div>
    <div class="panel-body">
        <form action="{{ route('pembelian.tambah_obat') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="obat">Obat</label>
                        <select name="obat" id="obat" class="form-control">
                            <option value="">Pilih Obat</option>
                            @foreach ($obat as $o)
                            <option value="{{ $o->id_obat }}" {{ MenuActiveHelpers::set_selected(old('obat'), $o->id_obat) }} >{{ $o->nama_obat }}</option>
                            @endforeach
                        </select>
                        @error('obat')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" name="harga_beli" id="harga_beli" class="form-control" placeholder="Harga Beli" value="{{ old('harga_beli') }}">
                        @error('harga_beli')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Jumlah Beli" value="{{ old('jumlah') }}">
                        @error('jumlah')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="diskon">Diskon</label>
                        <input type="number" name="diskon" id="diskon" class="form-control" placeholder="Diskon Beli %" value="{{ old('diskon') }}">
                        @error('diskon')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
