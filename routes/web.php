<?php

use App\Http\Controllers\Admin\InstructurController;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;
use GuzzleHttp\Client;
use App\Http\Controllers\Admin\StudentController;

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

// Route::get('user-data', function () {
//     $client = new Client();
//     $res = $client->request('GET', 'https://avatars.dicebear.com/api/human/:seed.svg');
//     $decode = json_decode($res->getBody());
//     dd($decode);
// });



Route::get('/', function () {
    return view('welcome');
})->name('landing');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user', 'fireauth');
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
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::resource('users/student', StudentController::class, ['except' => ['create', 'store']]);
        Route::put('users/student/{student}/enable', [StudentController::class, 'enable'])->name('student.enable');
        Route::put('users/student/{student}/disable', [StudentController::class, 'disabled'])->name('student.disable');
        Route::resource('users/instructur', InstructurController::class, ['except' => ['create', 'store']]);
        Route::put('users/instructur/{instructur}/enable', [InstructurController::class, 'enable'])->name('instructur.enable');
        Route::put('users/instructur/{instructur}/disable', [InstructurController::class, 'disabled'])->name('instructur.disable');
        Route::resource('users/admin', App\Http\Controllers\Admin\AdminController::class);
    });
});


// Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
// Route::resource('profile', AdminProfileController::class, ['only' => ['show', 'post', 'put', 'delete']]);
// Route::resource('users/admins', AdminController::class, ['only' => ['index', 'show']])->parameters([
//     'users' => 'username'
// ]);
// Route::resource('users/students', StudentController::class)->parameters([
//     'users' => 'username'
// ]);
// Route::resource('users/instructors', InstructorController::class)->parameters([
//     'users' => 'username'
// ]);
// Route::resource('roles', RoleController::class, ['only' => ['index']])->parameters([
//     'roles' => 'roles'
// ]);
// Route::resource('category/course-categories', CourseCategoryController::class, ['except' => 'show'])->parameters([
//     'course_categories' => 'category_slug',
// ]);
// Route::resource('category/price-types', PriceTypeController::class, ['except' => 'show'])->parameters([
//     'course_price_types' => 'price_type_slug'
// ]);
// Route::resource('category/class-types', ClassTypeController::class, ['except' => 'show'])->parameters([
//     'course_class_types' => 'class_type_slug'
// ]);
// Route::resource('category/course-levels', CourseLevelController::class, ['except' => 'show'])->parameters([
//     'course_masterclass_level' => 'masterclass_level_slug'
// ]);
// Route::resource('classes', ClassController::class);
// Route::resource('masterclasses', MasterClassController::class)->parameters([
//     'course_masterclasses' => 'masterclass_slug'
// ]);
// Route::resource('masterclass.curriculum-section', CurriculumSectionController::class, ['except' => 'show'])->parameters([
//     'course_curriculum_sections' => 'curriculum_section'
// ]);

// Route::resource('masterclass.curriculum-section.curriculum', CurriculumController::class, ['except' => 'show'])->parameters([
//     'course_curriculum' => 'curriculum'
// ]);

// Route::resource('certificates', CertificateController::class);
// Route::resource('reviews', ReviewController::class);

// if user role is instructur and is verified
Route::prefix('instructur')->name('instructur.')->group(function () {
    Route::middleware(['user', 'fireauth', 'instructur'])->group(function () {
        Route::resource('profile', App\Http\Controllers\Auth\ProfileController::class);
        Route::view('success', 'registration-success')->name('success');
        Route::get('dashboard', function () {
            return view('instructur.dashboard');
        })->name('dashboard');
    });
});

// if user role is instructor and is verified
Route::middleware(['user', 'fireauth', 'student'])->group(function () {
});

Route::middleware(['user', 'fireauth', 'auth'])->group(function () {
    Route::get('instruktur/formulir', App\Http\Livewire\FormInstructur::class)->name('form.instructur');
});
