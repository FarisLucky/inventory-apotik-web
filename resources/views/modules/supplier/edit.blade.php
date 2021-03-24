@extends('master_layout')

@section('main')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <!-- FORM SUPPLIER -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Supplier</h2>
                            <a href="{{ route('supplier.index') }}" class="right btn btn-info">
                                Kembali
                            </a>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('supplier.update',['id_supplier'=>$supplier->id_supplier]) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="no_pbf">No PBF</label>
                                    <input type="text" name="no_pbf" id="no_pbf" class="form-control" placeholder="No PBF" value="{{ $supplier->no_pbf }}">
                                    @error('no_pbf')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_supplier">Nama Supplier</label>
                                    <input type="text" name="nama_supplier" id="nama_supplier" class="form-control" placeholder="Nama Supplier" value="{{ $supplier->nama_supplier }}">
                                    @error('nama_supplier')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="telp">Telp</label>
                                    <input type="text" name="telp" id="telp" class="form-control" placeholder="Telepon" value="{{ $supplier->telp }}">
                                    @error('telp')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fax">Fax</label>
                                    <input type="text" name="fax" id="fax" class="form-control" placeholder="Fax" value="{{ $supplier->fax }}">
                                    @error('fax')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ $supplier->email }}">
                                    @error('email')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control">{{ $supplier->alamat }}</textarea>
                                    @error('alamat')
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

