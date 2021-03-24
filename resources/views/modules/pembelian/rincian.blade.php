@extends('master_layout')

@section('main')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- FORM Faktur -->
                    @include('modules.pembelian.rincian_header')
                    <!-- END FORM Faktur -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('modules.pembelian.rincian_detail')
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
@include('modules.pembelian.rincian_detail_obat_modal')
</div>
@endsection

@section('script')
<script>
    $('.detail_rincian_obat').on("click",function(e) {
        e.preventDefault();
        const url = $(this).attr('data-url');
        $.ajax({
            type: "GET",
            url: url,
            success:function(response){
                const {code, status, data} = response;
                console.log(data.obat.kategori);
                console.log(data.obat.kategori.kategori);
                if (code === 200) {
                    $("#modal_no_batch").val(data.obat.no_batch)
                    $("#modal_nama_obat").val(data.obat.nama_obat)
                    $("#modal_kategori").val(data.obat.kategori.kategori)
                    $("#modal_satuan").val(data.obat.satuan.satuan)
                    $("#modal_stock").val(data.obat.stock)
                    $('#editModal').modal('show')
                }
            }
        });
    })
</script>
@endsection
