<?php


use App\Http\Controllers\MesController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
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

Route::get('/', [MesController::class, 'login']);
Route::post('/', [MesController::class, 'loginRechercheLivre'])->name('loginRechercheLivre');



Route::get('/home', [MesController::class, 'home'])->middleware('auth')->name('home');
Route::post('/home', [MesController::class, 'homeUsers'])->middleware('auth')->name('home.users');

Route::get('/pageDERecherche', [MesController::class, 'rechercheLivreDispo'])->middleware('auth')->name('pageDeRecherche');
Route::post('/pageDERecherche', [MesController::class, 'rechercheLivre'])->middleware('auth')->name('rechercheLivre');

Route::get('/ajouterLivre', [MesController::class, 'formulaireLivre'])->middleware('auth')->name('ficheLivre');
Route::post('/ajouterLivre', [MesController::class, 'ajouterLivre'])->middleware('auth')->name('ajouterLivre');

Route::get('/detailLivre', [MesController::class, 'detailLivre'])->middleware('auth')->name('detailLivre');
Route::post('/detailLivre', [MesController::class, 'ajouterCommentaire'])->middleware('auth')->name('ajouterCommentaire');

Route::get('/activite', [MesController::class, 'activite'])->middleware('auth')->name('activite');
Route::post('/activite', [MesController::class, 'deposerLivre'])->middleware('auth')->name('depotLivre');


Route::get('/partiPasFini', [MesController::class, 'pageConstruction'])->middleware('auth')->name('partiePasFini');

Route::get('/emprunter',[MesController::class, 'obtenirLivre'])->middleware('auth')->name('prendreLivre');
Route::post('/emprunter',[MesController::class, 'empruntLivre'])->middleware('auth')->name('emprunter');
