@extends('master_layout')

@section('main')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success">
                    Berhasil Ditambahkan
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <!-- FORM SUPPLIER -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h2 class="panel-title">Create Satuan</h2>
                            <a href="{{ route('satuan.index') }}" class="right btn btn-info">
                                Kembali
                            </a>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('satuan.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="Satuan">Satuan</label>
                                    <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Satuan Obat" value="{{ old('satuan') }}">
                                    @error('satuan')
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

