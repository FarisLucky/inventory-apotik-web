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
                <div class="col-md-6">
                    <!-- FORM Faktur -->
                    @include('modules.pembelian.module_pembelian')
                    <!-- END FORM Faktur -->
                </div>
                <div class="col-md-6">
                    <!-- FORM Obat -->
                    @include('modules.pembelian.form_obat')
                    <!-- END FORM Obat -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('modules.pembelian.module_detail_pembelian')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form id="submit_pembelian" action="{{ route('pembelian.store') }}" method="POST">
                        <button type="submit" class="btn btn-success" style="width: 100%; padding: 1rem 0px; margin-bottom: 2rem">Lanjutkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
@include('modules.pembelian.modal_edit')
</div>
@endsection

@section('script')
<script>
    $('#submit_pembelian').on("submit",function(e) {
        e.preventDefault();
        const url_form = $(this).attr('action');
        console.log(url_form);
        alertify.confirm('Submit','Apakah Pembelian ingin disimpan ?',function() {
            $.ajax({
                type: "POST",
                url: url_form,
                data: {
                    "_token" : "{{ csrf_token() }}"
                },
                success:function(response){
                    const {code, status, data} = response;
                    console.log(status);
                    if (code === 200) {
                        alertify.notify('Berhasil','success', 3, function () {
                            window.location.href = data.routing
                        })
                    } else if(code === 500) {
                        alertify.notify(status,'error', 3, function () {
                            // window.location.href = data.routing
                        })
                    }
                }
            });
        },function () {
            alertify.error('Gagal')
        })
    })

    $('.edit_obat').on("click",function(e) {
        e.preventDefault();
        const url = $(this).attr('data-url');
        $.ajax({
            type: "GET",
            url: url,
            success:function(response){
                const {code, status, data} = response;
                if (code === 200) {
                    $("#id").val(data.id)
                    $("#id_obat").val(data.obat.id_obat)
                    $("#no_batch").val(data.obat.no_batch)
                    $("#modal_nama_obat").val(data.obat.nama_obat)
                    $("#modal_harga_beli").val(data.obat.harga_beli)
                    $("#modal_jumlah").val(data.obat.jumlah)
                    $("#modal_diskon").val(data.obat.diskon)
                    $('#editModal').modal('show')
                }
            }
        });
    })

    $('#form_modal').on("submit",function(e) {
        e.preventDefault();
        const url_form = $(this).attr('action');
        const id = $("#id").val()
        const id_obat = $("#id_obat").val()
        const no_batch = $("#no_batch").val()
        const nama_obat = $("#modal_nama_obat").val()
        const harga_beli = $("#modal_harga_beli").val()
        const jumlah = $("#modal_jumlah").val()
        const diskon = $("#modal_diskon").val()
        $.ajax({
            type: "PUT",
            url: url_form,
            data: {
                "_token" : "{{ csrf_token() }}",
                "id" : id,
                "id_obat" : id_obat,
                "no_batch" : no_batch,
                "nama_obat" : nama_obat,
                "harga_beli" : harga_beli,
                "jumlah" : jumlah,
                "diskon" : diskon,
            },
            success:function(response){
                const {code, status, data} = response;
                if (code === 200) {
                    alertify.notify('Berhasil','success', 2, function () {
                        window.location.href = data.routing
                    })
                } else if(code === 500) {
                    alertify.notify(status,'error', 2)
                }
            }
        });
    })

    $('.btn_edit').on("submit",function(e) {
        e.preventDefault();
        const url_form = $(this).attr('action');
        console.log(url_form);
        alertify.confirm('Hapus','Apakah ingin menghapus obat ?',function() {
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
                    } else if(code === 500) {
                        alertify.notify(status,'error', 3, function () {
                            // window.location.href = data.routing
                        })
                    }
                }
            });
        })
    })
    $('#destroy_all_obat').on("submit",function(e) {
        e.preventDefault();
        const url_form = $(this).attr('action');
        console.log(url_form);
        alertify.confirm('Hapus Semua Obat','Apakah ingin menghapus semua obat ?',function() {
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
                    } else if(code === 500) {
                        alertify.notify(status,'error', 3, function () {
                            // window.location.href = data.routing
                        })
                    }
                }
            });
        },function () {  })
    })
</script>
@endsection

