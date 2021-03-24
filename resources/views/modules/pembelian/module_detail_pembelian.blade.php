
<div class="panel">
    <div class="panel-heading">
        <h2 class="panel-title">Form pembelian</h2>
    </div>
    <div class="panel-body">
        <div style="float: right; margin-bottom: 1rem">
            <form id="destroy_all_obat" action="{{ route('pembelian.destroy_all_obat') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-info">Hapus Semua Obat</button>
            </form>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="8%">No</th>
                    <th width="35%">Obat</th>
                    <th>Harga Beli</th>
                    <th>Jumlah</th>
                    <th>Diskon</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $ttl = 0;
                @endphp
                @if ($list_obat != null)
                    @foreach ($list_obat as $key => $obat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $obat['nama_obat'] }}</td>
                        <td>{{ number_format($obat['harga_beli'],0,',','.') }}</td>
                        <td>{{ $obat['jumlah'] }}</td>
                        <td>{{ $obat['diskon'] }}</td>
                        <td>
                            <a href="#" data-url="{{ route('pembelian.edit_obat', ['id_obat'=>$key]) }}" class="btn btn-warning edit_obat">Edit</a>
                            <form class="btn_edit" action="{{ route('pembelian.destroy_obat', ['id_obat'=>$key]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @php
                        $ttl += $obat['harga_beli']
                    @endphp
                    @endforeach
                @else
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem 0px">Kosong</td>
                </tr>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <h3>Total Pembelian</h3>
                    </td>
                    <td colspan="2" style="text-align: right;">
                        <h3>
                            Rp {{ number_format($ttl,0,',','.') }}
                        </h3>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
