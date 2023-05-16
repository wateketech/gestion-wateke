<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Auth\Login;

use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\Account\Profile\Profile;
use App\Http\Livewire\Account\Management\UserManagement;



// use App\Http\Livewire\LaravelExamples\UserProfile;
use App\Http\Livewire\Contacts\Contacts\AllContacts as Contacts;
use App\Http\Livewire\Contacts\Contacts\Create as CreateContact;
use App\Http\Livewire\Contacts\Entity\AllEntity as Entitys;
use App\Http\Livewire\Contacts\Entity\Create as CreateEntity;



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

Route::get('/', Login::class)->name('login');
// Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');
// Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');

// Route::get('/reset-password/{id}',ResetPassword::class)->name('reset-password')->middleware('signed');  //  identificar esta ruta

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // RUTAS PARA GERENCIA
    Route::group(['middleware' => ['role:Gerencia|SuperAdmin']], function () {
        // SECCIÓN DE CUENTA
        Route::get('/user-management', UserManagement::class)->name('user-management');
    });


    // SECCIÓN DE CUENTA
    Route::get('/profile', Profile::class)->name('profile');

    // SECCIÓN DE CONTACTOS
    Route::get('/contactos', Contacts::class)->name('contactos');
    Route::get('/crear-contacto', CreateContact::class)->name('crear-contacto');

    Route::get('/entidades', Entitys::class)->name('entidades');
    Route::get('/entidades/{route?}', Entitys::class)->name('entidades');
    Route::get('/crear-entidad', CreateEntity::class)->name('crear-entidad');





    // Route::get('/crear-agencias-basic', CreateFastEntity::class)->name('crear-agencia-basic');



    // Route::get('/agentes', Agente::class)->name('agente');



    // Route::get('/billing', Billing::class)->name('billing');
    // Route::get('/tables', Tables::class)->name('tables');
    // Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');            // esta ruta su controlar y vista sobra
    // Route::get('/static-sign-up', StaticSignUp::class)->name('static-sign-up');     // esta ruta su controlar y vista sobra
    // Route::get('/rtl', Rtl::class)->name('rtl');                                    // esta ruta su controlar y vista sobra
    // Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');






});


// Route::fallback(function (){
//     return redirect('/dashboard');
// });

