@extends('master_layout')

@section('main')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success">
                    Berhasil menambahkan Permission
                </div>
            @elseif(session('gagal'))
                <div class="alert alert-success">
                    Berhasil diubah
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <!-- FORM SUPPLIER -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h2 class="panel-title">Create Permission</h2>
                            <a href="{{ route('permission.index') }}" class="right btn btn-info">
                                Kembali
                            </a>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('permission.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="permission">Routing</label>
                                    <input type="text" name="permission" id="permission" class="form-control" placeholder="Permission" >
                                    @error('permission')
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

