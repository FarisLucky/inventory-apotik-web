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
                            <h2 class="panel-title">Create Role</h2>
                            <a href="{{ route('role_permission.index') }}" class="right btn btn-info">
                                Kembali
                            </a>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('role_permission.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <input type="text" name="role" id="role" class="form-control" placeholder="Role" >
                                    @error('role')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="permission">Pilih Permission</label>
                                    <hr style="margin: 1rem 0px">
                                    @foreach($permissions as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permission[]"
                                                   value="{{$permission->id}}" id="{{$permission->id}}" >
                                            <label class="form-check-label" for="{{$permission->id}}">
                                                {{$permission->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                    @error("permission")
                                    <p class="text-danger">
                                        {{$message}}
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

