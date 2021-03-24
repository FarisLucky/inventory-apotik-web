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
                    <!-- FORM kategori -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit kategori</h2>
                            <a href="{{ route('kategori.index') }}" class="right btn btn-info">
                                Kembali
                            </a>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('kategori.update',['id_kategori'=>$kategori->id_kategori]) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <input type="text" name="kategori" id="kategori" class="form-control" placeholder="No PBF" value="{{ $kategori->kategori }}">
                                    @error('kategori')
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
                    <!-- END FORM kategori -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
@endsection

