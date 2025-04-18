<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Captcha\CaptchaController;
use App\Http\Controllers\Siswa\SiswaController;
use App\Http\Controllers\Siswa\PermohonanController;
use App\Http\Controllers\Siswa\JadwalController;
use App\Http\Controllers\Role\HasUserSiswaControlle;
use App\Http\Controllers\Export\PDFController;
use App\Http\Controllers\TokenOTP\PasswordResetTokensController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function ()
    {
        return auth()->user();
    });

    Route::apiResource('roles', RoleController::class);
    Route::apiResources([
        'DataUser'=>UserController::class,
        'hasUserSiswa'=>HasUserSiswaControlle::class,
        'siswa' => SiswaController::class,
        'jadwal' => JadwalController::class,
        'passwordResetToken' => PasswordResetTokensController::class,
        'PDFexport' => PDFController::class,
        'cekPermohonan' =>PermohonanController::class,
    ]);

   // Route::post('cekPermohonan', [PermohonanController::class, 'cekPermohonan'])->name('cekPermohonan');


});

Route::get('captcha', [CaptchaController::class,'index' ])->name('captcha.index');
Route::post('CariSiswa',[SiswaController::class, 'CariSiswa'])->name('CariSiswa');
Route::apiResources([
    'passwordResetToken' => PasswordResetTokensController::class,
]);

Route::post('cekTokenPasswordReset', [PasswordResetTokensController::class, 'cekTokenReset'])->name('cekTokenPasswordReset');
//Route::apiResource('roles', RoleController::class)->middleware('auth:sanctum');
