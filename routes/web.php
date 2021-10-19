<?php

use App\Http\Controllers\BirthController;
use App\Http\Controllers\ComeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DieController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyDetailController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\TetapController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::get('user/{id}/konfirmasi', [UserController::class, 'konfirmasi'])->name('user.delete');
    Route::get('user/{id}/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::get('user/konfirmasiAll', [UserController::class, 'konfirmasiAll'])->name('user.confirmAll');
    Route::get('user/deleteAll', [UserController::class, 'deleteAll'])->name('user.deleteAll');

    Route::resource('jobs', JobController::class);
    Route::get('job/export', [JobController::class, 'jobExport'])->name('jobExport');
    Route::get('job/exportTemplate', [JobController::class, 'template'])->name('jobExportTemplate');
    Route::post('job/import', [JobController::class, 'jobImportExcel'])->name('jobImportExcel');
    Route::get('job/konfirmasiAll', [JobController::class, 'konfirmasiAll'])->name('job.confirmAll');
    Route::get('job/deleteAll', [JobController::class, 'deleteAll'])->name('job.deleteAll');
    Route::get('job/print', [JobController::class, 'printJob'])->name('job.print');
    Route::get('job/{id}/konfirmasi', [JobController::class, 'konfirmasi'])->name('job.confirm');
    Route::get('job/{id}/delete', [JobController::class, 'delete'])->name('job.delete');

    Route::resource('families', FamilyController::class);
    Route::get('family/deleteAll', [FamilyController::class, 'deleteAllFamily'])->name('family.deleteAll');
    Route::get('family/{id}/konfirmasi', [FamilyController::class, 'konfirmasi'])->name('family.confirm');
    Route::get('family/{id}/delete', [FamilyController::class, 'delete'])->name('family.delete');
    Route::get('family/print', [FamilyController::class, 'familyPrint'])->name('family.print');
    Route::get('family/export', [FamilyController::class, 'template'])->name('family.exportTemplate');
    Route::get('family/exportTemplate', [FamilyController::class, 'familyExport'])->name('family.export');
    Route::post('family/import', [FamilyController::class, 'familyImport'])->name('family.import');

    Route::resource('familyDetails', FamilyDetailController::class);
    Route::get('familyDetails/familyDetail/{id}/confirm', [FamilyDetailController::class, 'confirm'])->name('detail.confirm');
    Route::get('familyDetails/familyDetail/{id}/delete', [FamilyDetailController::class, 'delete'])->name('detail.delete');
    Route::get('familyDetail/deleteAll', [FamilyDetailController::class, 'deleteAllFamilyDetail'])->name('detail.deleteAll');

    Route::resource('residents', ResidentController::class);
    Route::get('resident/export', [ResidentController::class, 'residentExport'])->name('resident.export');
    Route::get('resident/exportTemplate', [ResidentController::class, 'template'])->name('resident.exportTemplate');
    Route::post('resident/import', [ResidentController::class, 'residentImport'])->name('resident.import');
    Route::get('resident/konfirmasiAll', [ResidentController::class, 'konfirmasiAll'])->name('resident.confirmAll');
    Route::get('resident/deleteAll', [ResidentController::class, 'deleteAllResident'])->name('resident.deleteAll');
    Route::get('resident/print', [ResidentController::class, 'residentPrint'])->name('resident.print');
    Route::get('resident/{id}/konfirmasi', [ResidentController::class, 'konfirmasi'])->name('resident.confirm');
    Route::get('resident/{id}/delete', [ResidentController::class, 'delete'])->name('resident.delete');
    Route::get('/reset-filter/residents', [ResidentController::class,'resetFilter'])->name('filter-reset');

    Route::resource('births', BirthController::class);
    Route::get('birth/print', [BirthController::class, 'birthPrint'])->name('birth.print');
    Route::get('birth/export', [BirthController::class, 'birthExport'])->name('birth.export');
    Route::get('birth/exportTemplate', [BirthController::class, 'template'])->name('birth.exportTemplate');
    Route::get('birth/{id}/konfirmasi', [BirthController::class, 'konfirmasi'])->name('birth.confirm');
    Route::get('birth/{id}/delete', [BirthController::class, 'delete'])->name('birth.delete');
    Route::get('birth/deleteAll', [BirthController::class, 'deleteAllBirth'])->name('birth.deleteAll');
    Route::get('/reset-filter/births', [BirthController::class,'resetFilter'])->name('filter-resetBirth');

    Route::resource('dies', DieController::class);
    Route::get('die/print', [DieController::class, 'diePrint'])->name('die.print');
    Route::get('/reset-filter/dies', [DieController::class,'resetFilter'])->name('filter-resetDie');
    Route::get('die/{id}/konfirmasi', [DieController::class, 'konfirmasi'])->name('die.confirm');
    Route::get('die/{id}/delete', [DieController::class, 'delete'])->name('die.delete');
    Route::get('die/konfirmasiAll', [DieController::class, 'konfirmasiAll'])->name('die.confirmAll');
    Route::get('die/deleteAll', [DieController::class, 'deleteAllDeath'])->name('die.deleteAll');
    Route::get('die/export', [DieController::class, 'deathExport'])->name('die.export');
    Route::get('die/exportTemplate', [DieController::class, 'template'])->name('die.exportTemplate');
    Route::post('die/import', [DieController::class, 'dieImport'])->name('die.import');

    Route::resource('tetaps', TetapController::class);
    Route::get('tetap/print', [TetapController::class, 'tetapPrint'])->name('tetap.print');
    Route::get('tetap/export', [TetapController::class, 'tetapExport'])->name('tetap.export');
    Route::get('tetap/exportTemplate', [TetapController::class, 'template'])->name('tetap.exportTemplate');
    Route::post('tetap/import', [TetapController::class, 'tetapImport'])->name('tetap.import');
    Route::get('/reset-filter/tetap', [TetapController::class,'resetFilter'])->name('filter-reset-tetap');

    Route::resource('comes', ComeController::class);
    Route::get('/reset-filter/come', [ComeController::class,'resetFilter'])->name('filter-reset-come');
    Route::get('come/print', [ComeController::class, 'comePrint'])->name('come.print');
    Route::get('come/export', [ComeController::class, 'comeExport'])->name('come.export');
    Route::get('come/exportTemplate', [ComeController::class, 'template'])->name('come.exportTemplate');
    Route::post('come/import', [ComeController::class, 'comeImport'])->name('come.import');

    Route::resource('transfers', TransferController::class);
    Route::get('/reset-filter/transfer', [TransferController::class,'resetFilter'])->name('filter-reset-transfer');
    Route::get('transfer/print', [TransferController::class, 'transferPrint'])->name('transfer.print');
    Route::get('transfer/export', [TransferController::class, 'transferExport'])->name('transfer.export');
    Route::get('transfer/exportTemplate', [TransferController::class, 'template'])->name('transfer.exportTemplate');
    Route::post('transfer/import', [TransferController::class, 'transferImport'])->name('transfer.import');

});

// Route::get('login', function(){
//     return view('auth.login');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
