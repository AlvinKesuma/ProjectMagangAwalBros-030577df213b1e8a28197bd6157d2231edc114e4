<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanKomiteMutuController;
use App\Http\Controllers\KepatuhanIdentifikasiController;
use App\Http\Controllers\IdentifikasiPemberianObatController;
use App\Http\Controllers\PasienPemberianObatController;
use App\Http\Controllers\PasienPemberianDarahController;
use App\Http\Controllers\TeknikSBARPerawatController;
use App\Http\Controllers\ElektrolitPekatController;
use App\Http\Controllers\PencegahanResikoJatuhController;
use App\Http\Controllers\PasienPemberianNutrisiController;
use App\Http\Controllers\SampelDarahLaboratoriumController;
use App\Http\Controllers\IdentifikasiPasienRadiologiController;
use App\Http\Controllers\ProsesReadBackController;
use App\Http\Controllers\HasilKritisLaboratoriumController;
use App\Http\Controllers\PembuanganObatNarkotikaController;
use App\Http\Controllers\PelabelanObatPasienController;
use App\Http\Controllers\OperatorDaerahOperasiController;
use App\Http\Controllers\TimeOutVKController;
use App\Http\Controllers\TimeOutPoliGigiController;
use App\Http\Controllers\PetugasCuciTanganController;
use App\Http\Controllers\PenggunaanAPDController;
use App\Http\Controllers\InfoPenyakitPasienController;
use App\Http\Controllers\BoardingTimePasienController;
use App\Http\Controllers\AntibioticProphylaxisTypeController;
use App\Http\Controllers\AntibiotikProfilaksisController;
use App\Http\Controllers\PenundaanOperasiElectif30MinController;
use App\Http\Controllers\PenundaanOperasiElectif1JamController;
use App\Http\Controllers\WaktuTanggapSeksiSesareaController;
use App\Http\Controllers\KejadianWaterIntrusionController;
use App\Http\Controllers\PemeliharaanAlatMedisController;
use App\Http\Controllers\KepatuhanVAPController;
use App\Http\Controllers\KepatuhanIDOController;
use App\Http\Controllers\KepatuhanIADPController;
use App\Http\Controllers\KepatuhanISKController;
use App\Http\Controllers\KelengkapanResepRawatJalanController;
use App\Http\Controllers\PengelolaanKomplainPasienController;
use App\Http\Controllers\KepuasanPasienController;
use App\Http\Controllers\WaktuTungguRawatJalan30MinController;
use App\Http\Controllers\WaktuTungguRawatJalanUnder30MinController;
use App\Http\Controllers\WaktuTungguRawatJalanUp60MinController;
use App\Http\Controllers\KepatuhanVisitDokterSpesialisController;
use App\Http\Controllers\KepatuhanFormulariumNasionalController;
use App\Http\Controllers\KepatuhanAlurKlinisController;
use App\Http\Controllers\RehospitalisasiGeriatriController;
use App\Http\Controllers\DischargePlanningController;
use App\Http\Controllers\FeedbackPelangganController;
use App\Http\Controllers\PerbaikanStatusCVAController;
use App\Http\Controllers\LOSgagalJantungAkutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/', [LaporanKomiteMutuController::class, 'index'])->name('laporan-komite-mutu.index');
Route::post('/store', [LaporanKomiteMutuController::class, 'store'])->name('laporan-komite-mutu.store');

Route::get('/show/{id}', [LaporanKomiteMutuController::class, 'show'])->name('laporan-komite-mutu.show');

Route::resource('laporan-komite-mutu', LaporanKomiteMutuController::class)
    ->only(['index']);

Route::resource('kepatuhan-identifikasi', KepatuhanIdentifikasiController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('identifikasi-pemberianobat', IdentifikasiPemberianObatController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('pasien-pemberianobat', PasienPemberianObatController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('pasien-pemberiandarah', PasienPemberianDarahController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('tekniksbar-perawat', TeknikSBARPerawatController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('elektrolit-pekat', ElektrolitPekatController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('pencegahan-resikojatuh', PencegahanResikoJatuhController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('pasien-pemberiannutrisi', PasienPemberianNutrisiController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('sampel-darahlaboratorium', SampelDarahLaboratoriumController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('identifikasi-pasienradiologi', IdentifikasiPasienRadiologiController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('proses-readback', ProsesReadBackController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('hasil-kritislaboratorium', HasilKritisLaboratoriumController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('pembuangan-obatnarkotika', PembuanganObatNarkotikaController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('pelabelan-obatpasien', PelabelanObatPasienController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('operator-daerahoperasi', OperatorDaerahOperasiController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('timeout-vk', TimeOutVKController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('timeout-poligigi', TimeOutPoliGigiController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('petugas-cucitangan', PetugasCuciTanganController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('penggunaan-apd', PenggunaanAPDController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('info-penyakitpasien', InfoPenyakitPasienController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('boarding-timepasien', BoardingTimePasienController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('antibiotic-prophylaxistype', AntibioticProphylaxisTypeController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('antibiotik-profilaksis', AntibiotikProfilaksisController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('penundaan-operasi-electif-30min', PenundaanOperasiElectif30MinController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('penundaan-operasi-electif-1jam', PenundaanOperasiElectif1JamController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('waktu-tanggap-seksi-sesarea', WaktuTanggapSeksiSesareaController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('kejadian-water-intrusion', KejadianWaterIntrusionController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('pemeliharaan-alat-medis', PemeliharaanAlatMedisController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('kepatuhan-vap', KepatuhanVAPController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('kepatuhan-ido', KepatuhanIDOController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('kepatuhan-iadp', KepatuhanIADPController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('kepatuhan-isk', KepatuhanISKController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('kelengkapan-resep-rawat-jalan', KelengkapanResepRawatJalanController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('pengelolaan-komplain-pasien', PengelolaanKomplainPasienController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('kepuasan-pasien', KepuasanPasienController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('waktu-tunggu-rawat-jalan-30min', WaktuTungguRawatJalan30MinController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('waktu-rawat-jalan-under30min', WaktuTungguRawatJalanUnder30MinController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('waktu-rawat-jalan-up60min', WaktuTungguRawatJalanUp60MinController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('kepatuhan-visit-dokter-spesialis', KepatuhanVisitDokterSpesialisController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('kepatuhan-formularium-nasional', KepatuhanFormulariumNasionalController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('kepatuhan-alur-klinis', KepatuhanAlurKlinisController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('rehospitalisasi-geriatri', RehospitalisasiGeriatriController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('discharge-planning', DischargePlanningController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('feedback-pelanggan', FeedbackPelangganController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('perbaikan-status-cva', PerbaikanStatusCVAController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('los-gagal-jantung-akut', LOSgagalJantungAkutController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);


    