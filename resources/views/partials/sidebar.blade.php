
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                @hasanyrole('admin|super-admin')
                <li><a href="{{ route('dashboard') }}" class="{{ MenuActiveHelpers::set_active('dashboard') }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                @endhasanyrole
                <li><a href="{{ route('pembelian.index') }}" class="{{ MenuActiveHelpers::set_active('pembelian.*') }}"><i class="lnr lnr-book"></i> <span>Pembelian</span></a></li>
                <li>
                    <a href="#management_user" class="{{ MenuActiveHelpers::set_active([
                        'user.*',
                        'role_permission.*'
                        ]) }}" data-toggle="collapse">
                        <i class="lnr lnr lnr-user"></i>
                        <span>Management User</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="management_user" class="collapse {{ MenuActiveHelpers::set_active([
                        'user.*',
                        'role_permission.*',
                        'permission.*'
                        ],'in') }}">
                        <ul class="nav">
                            <li><a href="{{ route('user.index') }}" class="{{ MenuActiveHelpers::set_active('user.*') }}">User</a></li>
                            <li><a href="{{ route('role_permission.index') }}" class="{{ MenuActiveHelpers::set_active('role_permission.*') }}">Role Permission</a></li>
                            <li><a href="{{ route('permission.index') }}" class="{{ MenuActiveHelpers::set_active('permission.*') }}">Permission</a></li>
                        </ul>
                    </div>

                </li>
                <li>
                    <a href="#subMaster" class="{{ MenuActiveHelpers::set_active([
                        'supplier.*',
                        'satuan.*',
                        'obat.*',
                        'kategori.*'
                        ]) }}" data-toggle="collapse">
                            <i class="lnr lnr-database"></i>
                            <span>Master</span>
                            <i class="icon-submenu lnr lnr-chevron-left"></i>
                        </a>
                    <div id="subMaster" class="collapse {{ MenuActiveHelpers::set_active([
                        'supplier.*',
                        'satuan.*',
                        'obat.*',
                        'kategori.*'
                        ],'in') }}">
                        <ul class="nav">
                            <li><a href="{{ route('obat.index') }}" class="{{ MenuActiveHelpers::set_active('obat.*') }}">Obat</a></li>
                            <li>
                                <a href="{{ route('supplier.index') }}" class="{{ MenuActiveHelpers::set_active('supplier.*') }}">Supplier</a>
                            </li>
                            <li><a href="{{ route('satuan.index') }}" class="{{ MenuActiveHelpers::set_active('satuan.*') }}">Satuan Obat</a></li>
                            <li><a href="{{ route('kategori.index') }}" class="{{ MenuActiveHelpers::set_active('kategori.*') }}">Kategori Obat</a></li>
                        </ul>
                    </div>

                </li>
                <li>
                    <a href="#subLaporan" class="{{ MenuActiveHelpers::set_active([
                        'supplier.*',
                        'satuan.*',
                        'obat.*',
                        'kategori.*'
                        ]) }}" data-toggle="collapse">
                        <i class="lnr lnr-database"></i>
                        <span>Laporan</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="subLaporan" class="collapse {{ MenuActiveHelpers::set_active([
                        'supplier.*',
                        'satuan.*',
                        'obat.*',
                        'kategori.*'
                        ],'in') }}">
                        <ul class="nav">
                            <li><a href="{{ route('obat.index') }}" class="{{ MenuActiveHelpers::set_active('obat.*') }}">Obat</a></li>
                        </ul>
                    </div>

                </li>
            </ul>
        </nav>
    </div>
</div>
