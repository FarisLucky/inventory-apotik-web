<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SatuanObatController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Permissions\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Permissions\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvidashder within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [DashboardController::class, 'index'])
//    ->middleware('role_permission:developer')
    ->name('dashboard');

Route::name('register.')
    ->prefix('register')
    ->group(function () {
        Route::get('/', [RegisterController::class, 'show'])
            ->name('show');
        Route::post('/', [RegisterController::class, 'register'])
            ->name('register');
    });

Route::name('auth.')
    ->prefix('auth/')
    ->middleware('login.checked')
    ->group(function () {
        Route::get("login", [LoginController::class, 'show'])
            ->name('login');
        Route::post('authenticate', [LoginController::class, 'authenticate'])
            ->name('authenticate');
        Route::get('dashboard_login', [LoginController::class, 'index'])
            ->excludedMiddleware('login.checked');
    });

Route::get('/logout', [LogoutController::class, 'logout'])
    ->name('logout');

Route::name('supplier.')
    ->prefix('supplier/')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('index', [SupplierController::class, 'index'])
            ->name('index');
        Route::get('create', [SupplierController::class, 'create'])
            ->name('create');
        Route::post('store', [SupplierController::class, 'store'])
            ->name('store');
        Route::get('edit/{id_supplier}', [SupplierController::class, 'edit'])
            ->name('edit');
        Route::put('update/{id_supplier}', [SupplierController::class, 'update'])
            ->name('update');
        Route::delete('destroy/{id_supplier}', [SupplierController::class, 'destroy'])
            ->name('destroy');
    });


// Satuan Route
Route::name('satuan.')
    ->prefix('satuan/')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [SatuanObatController::class, 'index'])
            ->name('index');
        Route::get('create', [SatuanObatController::class, 'create'])
            ->name('create');
        Route::post('store', [SatuanObatController::class, 'store'])
            ->name('store');
        Route::get('edit/{id_satuan}', [SatuanObatController::class, 'edit'])
            ->name('edit');
        Route::put('update/{id_satuan}', [SatuanObatController::class, 'update'])
            ->name('update');
        Route::delete('destroy/{id_satuan}', [SatuanObatController::class, 'destroy'])
            ->name('destroy');
    });

// Obats Route
Route::name('obat.')
    ->prefix('obat/')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [ObatController::class, 'index'])
            ->name('index');
        Route::get('create/', [ObatController::class, 'create'])
            ->name('create');
        Route::post('store/', [ObatController::class, 'store'])
            ->name('store');
        Route::get('edit/{id_obat}', [ObatController::class, 'edit'])
            ->name('edit');
        Route::put('update/{id_obat}', [ObatController::class, 'update'])
            ->name('update');
        Route::delete('destroy/{id_obat}', [ObatController::class, 'destroy'])
            ->name('destroy');
    });

// Kategory
Route::name('kategori.')
    ->prefix('kategori/')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [KategoryController::class, 'index'])
            ->name('index');
        Route::get('create', [KategoryController::class, 'create'])
            ->name('create');
        Route::post('store', [KategoryController::class, 'store'])
            ->name('store');
        Route::get('edit/{id_kategori}', [KategoryController::class, 'edit'])
            ->name('edit');
        Route::put('update/{id_kategori}', [KategoryController::class, 'update'])
            ->name('update');
        Route::delete('destroy/{id_kategori}', [KategoryController::class, 'destroy'])
            ->name('destroy');
    });

Route::name('pembelian.')
    ->prefix('pembelian/')
    ->middleware('auth')
    ->group(function () {
        Route::get('list', [PembelianController::class, 'index'])
            ->name('index');
        Route::get('rincian/{id_pembelian}', [PembelianController::class, 'rincian'])
            ->name('rincian');
        Route::get('rincian-detail-obat/{no_batch}', [PembelianController::class, 'rincianDetailObat'])
            ->name('detail_rincian_obat');
        Route::get('form/', [PembelianController::class, 'show'])
            ->name('show');
        Route::post('store/', [PembelianController::class, 'store'])
            ->name('store');
        Route::post('tambah-obat/', [PembelianController::class, 'tambahObat'])
            ->name('tambah_obat');
        Route::post('tambah-faktur/', [PembelianController::class, 'tambahFaktur'])
            ->name('tambah_faktur');
        Route::post('store/', [PembelianController::class, 'store'])
            ->name('store');
        Route::put('update-obat/', [PembelianController::class, 'updateObat'])
            ->name('update_obat');
        Route::get('edit-obat/{id_obat}', [PembelianController::class, 'editObat'])
            ->name('edit_obat');
        Route::get('destroy-obat/{id_obat}', [PembelianController::class, 'destroyObat'])
            ->name('destroy_obat');
        Route::delete('destroy-all-obat/', [PembelianController::class, 'destroyAllObat'])
            ->name('destroy_all_obat');
    });

Route::get('/roles',[PermissionController::class, 'permission']);

Route::name('user.')
    ->middleware('auth')
    ->prefix('user/')
    ->group(function () {
        Route::get("/",[UserController::class,'index'])
            ->name('index');
        Route::get('create/',[UserController::class, 'create'])
            ->name('create');
        Route::post('store/',[UserController::class, 'store'])
            ->name('store');
        Route::get('edit/{id_user}/', [UserController::class, 'edit'])
            ->name('edit');
        Route::put('update/{id_user}/', [UserController::class, 'update'])
            ->name('update');
        Route::delete('destroy/{id_user}/', [UserController::class, 'destroy'])
            ->name('destroy');
    });

Route::name("role_permission.")
    ->middleware("auth")
    ->prefix("role_permission/")
    ->group(function () {
        Route::get("/",[RoleController::class, "index"])
            ->name("index");
        Route::get("create/",[RoleController::class, "create"])
            ->name("create");
        Route::post("store/", [RoleController::class, "store"])
            ->name("store");
        Route::get("edit/{id_role}",[RoleController::class, "edit"])
            ->name("edit");
        Route::put("update/{id_role}", [RoleController::class, "update"])
            ->name("update");
        Route::delete("destroy/{id_role}",[RoleController::class, "destroy"])
            ->name("destroy");
        Route::name("permission.")
            ->prefix("permission/")
            ->group(function () {
                Route::delete("delete/{id_permission}", [RoleController::class, "destroyPermission"])
                    ->name("destroy");
        });
    });

Route::name("permission.")
    ->prefix("permission/")
    ->middleware("auth")
    ->group(function () {
        Route::get("/", [PermissionController::class, "index"])
            ->name("index");
        Route::get("create/", [PermissionController::class, "create"])
            ->name("create");
        Route::post("store/", [PermissionController::class, "store"])
            ->name("store");
        Route::get("edit/{id_permission}", [PermissionController::class, "edit"])
            ->name("edit");
        Route::delete("destroy/{id_permission}", [PermissionController::class, "destroy"])
            ->name("destroy");
    });
