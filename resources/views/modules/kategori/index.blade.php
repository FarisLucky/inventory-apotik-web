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
                            <h3 class="panel-title">List Kategori</h3>
                            <div class="right">
                                <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                                    Tambah
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="8%">No</th>
                                        <th width="35%">Kategori</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori as $s)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $s->kategori }}
                                        </td>
                                        <td>
                                            {{ date('d-m-Y H:i:s',strtotime($s->created_at)) }}
                                        </td>
                                        <td>
                                            {{ date('d-m-Y H:i:s',strtotime($s->updated_at)) }}
                                        </td>
                                        <td>
                                            <a href="{{ route("kategori.edit",['id_kategori'=>$s->id_kategori]) }}" class="btn btn-warning mb-2">
                                                Edit
                                            </a>
                                            <form class="destroy" action="{{ route('kategori.destroy',['id_kategori'=>$s->id_kategori]) }}" method="post">
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
                        alertify.notify('Berhasil','success', 3, function () {
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
