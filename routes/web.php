<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

    ////// Admin group Middleware #################################

Route::middleware(['auth','roles:admin'])->group(function(){

Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

Route::post('/admin/change/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

### Category All Route ###

Route::controller(CategoryController::class)->group(function(){

    Route::get('/all/category','AllCategory')->name('all.category');

    Route::get('/add/category','AddCategory')->name('add.category');

    Route::post('/store/category','StoreCategory')->name('store.category');

    Route::get('/edit/category/{id}','EditCategory')->name('edit.category');

    Route::post('/update/category','UpdateCategory')->name('update.category');

    Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');

});

### SubCategory All Route ###

Route::controller(CategoryController::class)->group(function(){

    Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');

    Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');

    Route::post('/store/subcategory','StoreSubCategory')->name('store.subcategory');

    Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');

    Route::post('/update/Subcategory','UpdateSubCategory')->name('update.subcategory');

    Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');

});


}); ///End Admin Group Middleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::get('/become/instructor', [AdminController::class, 'BecomeInstructor'])->name('become.instructor');

///// Instructor Group Middleware #################################

Route::middleware(['auth','roles:instructor'])->group(function(){

Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])->name('instructor.dashboard');

Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])->name('instructor.logout');

Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');

Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');

Route::get('/instructor/change/password', [InstructorController::class, 'InstructorChangePassword'])->name('instructor.change.password');

Route::post('/instructor/password/update', [InstructorController::class, 'InstructorPasswordUpdate'])->name('instructor.password.update');




}); //// End Instructor Group Middleware

Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])->name('instructor.login');
    ###################################################




