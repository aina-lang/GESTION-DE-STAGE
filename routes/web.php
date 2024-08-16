<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\TypeFormController;
use App\Http\Controllers\Setting;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PartenariatController;
use App\Http\Controllers\StageController;

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

/** for side bar menu active */
function set_active($route)
{
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}


// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/', function () {
//         return view('dashboard.home');
//     });

//     Route::get('home', function () {
//         return view('home');
//     });
//     Route::get('dashboard', function () {
//         return view('dashboard.home');
//     });
// });

Auth::routes();

// ----------------------------login ------------------------------//
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('change/password', 'changePassword')->name('change/password');
});

// ----------------------------- register -------------------------//
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register/store', 'storeUser')->name('register.store');
    Route::get('/register/{id}/edit', 'edit')->name('register.edit'); // Pour afficher le formulaire d'édition
    Route::post('/register', 'update')->name('register.update'); // Pour traiter la mise à jour
});

// -------------------------- main dashboard ----------------------//
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->middleware('auth')->name('home');
    Route::get('user/profile/page', 'userProfile')->middleware('auth')->name('user/profile/page');
    // Route::get('teacher/dashboard', 'teacherDashboardIndex')->middleware('auth')->name('teacher/dashboard');
    // Route::get('student/dashboard', 'studentDashboardIndex')->middleware('auth')->name('student/dashboard');
});


Route::get('stage/{id}/pdf', [StageController::class, 'generatePdf'])->middleware('auth')->name('stage.pdf');
Route::get('stage/download', [StageController::class, 'downloadPdf'])->middleware('auth')->name('stage.download');

// ----------------------------- user controller -------------------------//
Route::controller(UserManagementController::class)->group(function () {
    Route::get('list/users', 'index')->middleware('auth')->name('list/users');
    Route::post('change/password', 'changePassword')->name('change/password');
    Route::get('view/user/edit/{id}', 'userView')->middleware('auth');
    Route::post('user/update', 'userUpdate')->name('user/update');
    Route::post('user/delete', 'userDelete')->name('user/delete');
    Route::get('user/add', 'addUser')->name('user/add');
});

// ------------------------ setting -------------------------------//
Route::controller(Setting::class)->group(function () {
    Route::get('setting/page', 'index')->middleware('auth')->name('setting/page');
});

// ------------------------ student -------------------------------//
Route::controller(StudentController::class)->group(function () {
    Route::get('student/list', 'student')->middleware('auth')->name('student/list'); // list student
    Route::get('student/grid', 'studentGrid')->middleware('auth')->name('student/grid'); // grid student
    Route::get('student/add/page', 'studentAdd')->middleware('auth')->name('student/add/page'); // page student
    Route::post('student/add/save', 'studentSave')->name('student/add/save'); // save record student
    Route::get('student/edit/{id}', 'studentEdit'); // view for edit
    Route::post('student/update', 'studentUpdate')->name('student/update'); // update record student
    Route::post('student/delete', 'studentDelete')->name('student/delete'); // delete record student
    Route::get('student/profile/{id}', 'studentProfile')->middleware('auth'); // profile student
});

// ------------------------ teacher -------------------------------//
Route::controller(TeacherController::class)->group(function () {
    Route::get('teacher/add/page', 'teacherAdd')->middleware('auth')->name('teacher/add/page'); // page teacher
    Route::get('teacher/list/page', 'teacherList')->middleware('auth')->name('teacher/list/page'); // page teacher
    Route::get('teacher/grid/page', 'teacherGrid')->middleware('auth')->name('teacher/grid/page'); // page grid teacher
    Route::post('teacher/save', 'saveRecord')->middleware('auth')->name('teacher/save'); // save record
    Route::get('teacher/edit/{id}', 'editRecord'); // view teacher record
    Route::post('teacher/update', 'updateRecordTeacher')->middleware('auth')->name('teacher/update'); // update record
    Route::post('teacher/delete', 'teacherDelete')->name('teacher/delete'); // delete record teacher
});

// ----------------------- department -----------------------------//
// Route::controller(DepartmentController::class)->group(function () {
//     Route::get('department/list/page', 'departmentList')->middleware('auth')->name('department/list/page'); // department/list/page
//     Route::get('department/add/page', 'addDepartment')->middleware('auth')->name('department/add/page'); // page add department
//     Route::get('department/edit/page/{id}', 'editDepartment')->middleware('auth')->name('department/edit/page'); // page edit department
// });

// ----------------------- partenariat -----------------------------//
Route::controller(PartenariatController::class)->group(function () {
    Route::get('partenariat/list/page', 'listPartenaires')->middleware('auth')->name('partenariats.list'); // Liste de tous les partenariats
    Route::get('partenariat/add/page', 'addPartenaire')->middleware('auth')->name('partenariats.add'); // Page pour ajouter un nouveau partenariat
    Route::post('partenariat/save', 'savePartenaire')->middleware('auth')->name('partenariats.save'); // Enregistrer un nouveau partenariat
    Route::get('partenariat/edit/page/{id}', 'editPartenaire')->middleware('auth')->name('partenariats.edit'); // Page pour modifier un partenariat
    Route::put('partenariat/update/{id}', 'updatePartenaire')->middleware('auth')->name('partenariats.update'); // Mettre à jour un partenariat
    Route::delete('partenariat/delete/{id}', 'deletePartenaire')->middleware('auth')->name('partenariats.delete'); // Supprimer un partenariat
});



Route::controller(StageController::class)->group(function () {
    Route::get('stage/list', 'index')->middleware('auth')->name('stage.list'); // Liste des stages
    Route::get('stage/grid', 'grid')->middleware('auth')->name('stage.grid'); // Vue en grille des stages
    Route::get('stage/add', 'create')->middleware('auth')->name('stage.add'); // Page pour ajouter un stage
    Route::post('stage/save', 'store')->middleware('auth')->name('stage.save'); // Enregistrer un nouveau stage
    Route::get('stage/edit/{id}', 'edit')->middleware('auth')->name('stage.edit'); // Page pour modifier un stage
    Route::put('stage/update/{id}', 'update')->middleware('auth')->name('stage.update'); // Mettre à jour un stage
    Route::delete('stage/delete/', 'destroy')->middleware('auth')->name('stage.delete'); // Supprimer un stage
});
