<?php

use App\Http\Controllers\Admin\InstructurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\RequestInstructurController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryCourseController;
use App\Http\Controllers\Admin\CategoryLevelTypeController;
use App\Http\Controllers\Admin\CategoryPriceTypeController;
use App\Http\Controllers\Admin\CategoryTagsController;
use App\Http\Controllers\Admin\ChattingController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HelpCenterController;


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

Route::view('/', 'welcome')->name('landing');
Route::view('/bantuan', 'help-center')->name('help.center');
Route::view('/tentang/steadyacademy', 'about-steady-academy')->name('about.steady-academy');
Route::view('/tentang/kami', 'about-us')->name('about.us');
Route::view('/instruktur', 'become-instructur')->name('become.instructur');
Route::view('/kontak', 'contact-us')->name('contact.us');
Route::view('/bantuan/akun-dan-keamanan-student', 'help.account')->name('help.account');
Route::view('/bantuan/pembelajaran', 'help.learning')->name('help.learning');
Route::view('/bantuan/pembayaran', 'help.payment')->name('help.payment');
Route::view('/instruktur/syarat', 'become-instructur')->name('term.instructur');
Route::view('/instruktur/list', 'list-instructur')->name('term.instructur.list');
Route::view('/privasi-dan-sekurity', 'term.privacy')->name('term.privacy');
Route::view('/syarat-dan-ketentuan', 'term.condition')->name('term.condition');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user', 'fireauth');

// Authentication routes
Auth::routes();
Route::get('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify_email'])->name('verify')->middleware('fireauth');
Route::post('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify'])->name('send.email')->middleware('fireauth');
Route::post('login/{provider}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleCallback']);
Route::get('steadyacademy/admin/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm']);
Route::post('steadyacademy/admin/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'loginAdmin'])->name('admin.login');

Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);

// if user registered but not verified
Route::middleware('fireauth')->group(function () {
});

// if user registered is verified
Route::middleware(['user', 'fireauth'])->group(function () {
});

// if user role is admin and is verified
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth', 'fireauth', 'admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('chatting', [ChattingController::class, 'index'])->name('chatting.index');
        Route::get('chatting/{id}', [ChattingController::class, 'update'])->name('chatting.update');
        Route::resource('users/student', StudentController::class, ['except' => ['create', 'store']]);
        Route::put('users/student/{student}/enable', [StudentController::class, 'enable'])->name('student.enable');
        Route::put('users/student/{student}/disable', [StudentController::class, 'disabled'])->name('student.disable');
        Route::resource('users/instructur', InstructurController::class, ['except' => ['create', 'store']]);
        Route::put('users/instructur/{instructur}/enable', [InstructurController::class, 'enable'])->name('instructur.enable');
        Route::put('users/instructur/{instructur}/disable', [InstructurController::class, 'disabled'])->name('instructur.disable');
        Route::resource('users/admin', AdminController::class);
        Route::resource('instructur/request', RequestInstructurController::class);
        Route::put('users/instructur/request/{instructur}/approve', [RequestInstructurController::class, 'approve'])->name('request.approve');
        Route::put('users/instructur/request/{instructur}/disable', [RequestInstructurController::class, 'disabled'])->name('request.disable');
        Route::resource('kategori/kursus_kategori', CategoryCourseController::class);
        Route::resource('kategori/tipe_harga', CategoryPriceTypeController::class, ['except' => ['show']]);
        Route::resource('kategori/tags', CategoryTagsController::class, ['except' => ['show']]);
        Route::resource('kategori/tipe_level', CategoryLevelTypeController::class, ['except' => ['show']]);
        // Route::resource('kursus', CoursesController::class);
        Route::get('tambah/kursus', App\Http\Livewire\Admin\CoursesLivewire::class)->name('add.course');
        // Route::get('kursus', CoursesController::class)->name('kursus');
        Route::resource('kursus', CoursesController::class);
    });
});


// if user role is instructur and is verified
Route::prefix('instructur')->name('instructur.')->group(function () {
    Route::view('success', 'registration-success')->name('success')->middleware(['user', 'fireauth']);
    Route::middleware(['user', 'fireauth', 'instructur'])->group(function () {
        // Route::resource('profile', App\Http\Controllers\Auth\ProfileController::class);
        Route::get('dashboard', function () {
            return view('instructur.dashboard');
        })->name('dashboard');
        // Route::get('users/student', App\Http\Controllers\Instructur\InstructurStudentController::class)->name('users.student');
        Route::get('tambah/kursus', App\Http\Livewire\Admin\CoursesLivewire::class)->name('add.course');
    });
});

// if user role is student and is verified
Route::middleware(['user', 'fireauth', 'student'])->group(function () {
});

Route::middleware(['user', 'fireauth', 'auth', 'isRegistered'])->group(function () {
    Route::get('instruktur/formulir', App\Http\Livewire\FormInstructur::class)->name('form.instructur');
});

// Route::get('/help-center', function () {
//     return view('helpcenter');
// })->name('helpcenter');
// Route::get('/inctructor-list', function () {
//     return view('instructorlist');
// })->name('instructorlist');
