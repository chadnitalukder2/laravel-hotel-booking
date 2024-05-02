<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\BookAreaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserStore'])->name('profile.store');
    Route::get('/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/password/change/store', [UserController::class, 'PasswordChangeStore'])->name('password.change.store');
});

require __DIR__.'/auth.php';

// Admin  Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');



});// End Admin  Group Middleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// Admin  Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function(){
    
    //Team all route
    Route::controller(TeamController::class)->group(function(){
    Route::get('/all/team', 'AllTeam')->name('all.team');
    Route::get('/add/team', 'AddTeam')->name('add.team');
    Route::post('/team/store', 'TeamStore')->name('team.store');
    Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
    Route::post('/team/update', 'TeamUpdate')->name('team.update');
    Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team');
    });

     //Team all route
    Route::controller(BookAreaController::class)->group(function(){
        Route::get('/book/area', 'BookArea')->name('book.area');
        Route::post('/update/book/area', 'UpdateBookArea')->name('update.book.area');
    });

    //Room Type route
    Route::controller(RoomTypeController::class)->group(function(){
        Route::get('/room/type/list', 'RoomTypeList')->name('room.type.list');
        Route::get('/add/room/type', 'AddRoomType')->name('add.room.type');
        Route::post('/room/type/store', 'RoomTypeStore')->name('room.type.store');
    });

      //Room All route
      Route::controller(RoomController::class)->group(function(){
        Route::get('/edit/room/{id}', 'EditRoom')->name('edit.room');
       
    });
  
});

  