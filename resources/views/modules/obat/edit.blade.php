@extends('master_layout')

@section('main')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success">
                    Berhasil Diubah
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <!-- FORM SUPPLIER -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Obat</h2>
                            <a href="{{ route('obat.index') }}" class="right btn btn-info">
                                Kembali
                            </a>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('obat.update',['id_obat' => $obat->id_obat]) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="no_batch">No Batch</label>
                                    <input type="text" name="no_batch" id="no_batch" class="form-control" placeholder="No Batch" value="{{ $obat->no_batch }}">
                                    @error('no_batch')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_obat">Nama Obat</label>
                                    <input type="text" name="nama_obat" id="nama_obat" class="form-control" placeholder=" Nama Obat" value="{{ $obat->nama_obat }}">
                                    @error('nama_obat')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" id="kategori" class="form-control" placeholder="Kategori Obat" >
                                        <option value="">-- Kategori --</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id_kategori }}" {{ MenuActiveHelpers::set_selected($k->id_kategori, $obat->id_kategori) }} >{{ $k->kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <select name="satuan" id="satuan" class="form-control" placeholder="Satuan Obat" >
                                        <option value="">-- Satuan --</option>
                                        @foreach ($satuan as $s)
                                            <option value="{{ $s->id_satuan }}" {{ MenuActiveHelpers::set_selected($s->id_satuan, $obat->id_satuan) }} >{{ $s->satuan }}</option>
                                        @endforeach
                                    </select>
                                    @error('satuan')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="text" name="stock" id="stock" class="form-control" placeholder="Stock Obat" value="{{ $obat->stock }}">
                                    @error('stock')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END FORM SUPPLIER -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
@endsection

