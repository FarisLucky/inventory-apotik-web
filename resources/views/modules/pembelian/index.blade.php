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
                            <h3 class="panel-title">List Pembelian</h3>
                            <div class="right">
                                <a href="{{ route('pembelian.show') }}" class="btn btn-primary">
                                    Tambah Pembelian
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="8%">No</th>
                                        <th width="12%">No Faktur</th>
                                        <th width="12%">Tgl Jatuh Tempo</th>
                                        <th width="12%">Tgl Transaksi</th>
                                        <th width="12%">Supplier</th>
                                        <th width="12%">Total</th>
                                        <th width="12%">Dibuat Oleh</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembelian as $s)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $s->no_faktur }}
                                        </td>
                                        <td>
                                            {{ date('d-m-Y H:i:s',strtotime($s->tgl_jatuh_tempo)) }}
                                        </td>
                                        <td>
                                            {{ date('d-m-Y H:i:s',strtotime($s->tgl_transaksi)) }}
                                        </td>
                                        <td>
                                            {{ $s->supplier->nama_supplier }}
                                        </td>
                                        <td>
                                            20000
                                        </td>
                                        <td>
                                            {{ $s->akun->username }}
                                        </td>
                                        <td>
                                            <a href="{{ route("pembelian.rincian",['id_pembelian'=>$s->id]) }}" class="btn btn-warning mb-2">
                                                Rincian
                                            </a>
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
