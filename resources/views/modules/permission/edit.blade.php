@extends('master_layout')
@section('main')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success">
                    Berhasil ditambah
                </div>
            @elseif(session('gagal'))
                <div class="alert alert-danger">
                    Permission Sudah Ada
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <!-- FORM SUPPLIER -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Role</h2>
                            <a href="{{ route('role_permission.index') }}" class="right btn btn-info">
                                Kembali
                            </a>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('role_permission.permission.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="role" value="{{$role->id_role}}">
                                <div class="form-group">
                                    <label for="permission">Pilih Permission</label>
                                    <select name="permission" id="permission" class="form-control">
                                        @foreach($permissions as $p)
                                            <option value="{{$p->id_permission}}">{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            @include("modules.role_permission.permission_table")
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
@section("script")
    <script>
        $(".destroy").on("submit", function (e) {
            e.preventDefault();
            const id_role = $(this).val()
            const url = $(this).attr("action")
            alertify.confirm('Hapus','Apakah ingin dihapus ?',function() {
                $.ajax({
                type: "DELETE",
                url : url,
                data: {
                    "_token" : "{{csrf_token()}}",
                    "role" : {{$role->id_role}}
                },
                success:function (response) {
                    const {code, status, data} = response;
                    if (code === 200) {
                        alertify.notify('Berhasil','success', 1, function () {
                            window.location.href = data.routing
                        })
                    }
                }
            })
            },function () {
                alertify.error('Gagal')
            })
        })
    </script>
@endsection

