@extends('master_layout')

@section('main')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

            @if (session('destroy_success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <!-- RECENT PURCHASES -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">List Supplier</h3>
                            <div class="right">
                                <a href="{{ route('user.create') }}" class="btn btn-primary">
                                    Tambah
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="7%">No</th>
                                        <th width="15%">Name</th>
                                        <th width="15%">Username</th>
                                        <th width="30%">Email</th>
                                        <th width="18%">Role</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $s)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $s->name }}
                                        </td>
                                        <td>
                                            {{ $s->username }}
                                        </td>
                                        <td>
                                            {{ $s->email }}
                                        </td>
                                        <td>
                                            {{ $s->roles->first()->name }}
                                        </td>
                                        <td>
                                            <a href="{{ route("user.edit",['id_user'=>$s->id]) }}" class="btn btn-warning mb-2">
                                                Edit
                                            </a>
                                            <form class="destroy" action="{{ route('user.destroy',['id_user'=>$s->id]) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END RECENT PURCHASES -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
@endsection

@section('script')
<script>
    $('.destroy').on("submit",function(e) {
        e.preventDefault();
        const url_form = $(this).attr('action');
        console.log(url_form);
        alertify.confirm('Hapus','Apakah ingin dihapus ?',function() {
            $.ajax({
                type: "DELETE",
                url: url_form,
                data: {
                    "_token" : "{{ csrf_token() }}"
                },
                success:function(response){
                    const {code, status, data} = response;
                    if (code === 200) {
                        alertify.notify('Berhasil','success', 1, function () {
                            window.location.href = data.routing
                        })
                    }
                }
            });
        },function () {
            alertify.error('Gagal')
        })
    })
</script>
@endsection
