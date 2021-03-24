
<div class="panel">
    <div class="panel-heading">
        <h2 class="panel-title">Form pembelian</h2>
    </div>
    <div class="panel-body">
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
                @if ($detail != null)
                    @foreach ($detail as $obat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $obat->obat->nama_obat }}</td>
                        <td>{{ number_format($obat->harga_beli,0,',','.') }}</td>
                        <td>{{ $obat->quantity }}</td>
                        <td>{{ $obat->diskon }}</td>
                        <td>
                            <a href="#" data-url="{{ route('pembelian.detail_rincian_obat', ['no_batch'=>$obat->no_batch]) }}" class="btn btn-warning detail_rincian_obat">
                                Rincian Obat
                            </a>
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
