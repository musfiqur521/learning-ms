<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\CategoryController;



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

    Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');

});


### Instructor All Route ###

Route::controller(AdminController::class)->group(function(){

    Route::get('/all/instructor','AllInstructor')->name('all.instructor');
    Route::post('/update/user/status','UpdateUserStatus')->name('update.user.status');



});

// Permission All Route
Route::controller(RoleController::class)->group(function(){

    Route::get('/all/permission','AllPermission')->name('all.permission');
    Route::get('/add/permission','AddPermission')->name('add.permission');
    Route::post('/store/permission','StorePermission')->name('store.permission');

    Route::get('/edit/permission/{id}','EditPermission')->name('edit.permission');

    Route::post('/update/permission','UpdatePermission')->name('update.permission');

    Route::get('/delete/permission/{id}','DeletePermission')->name('delete.permission');

});
// Role All Route
Route::controller(RoleController::class)->group(function(){

    Route::get('/all/roles','AllRoles')->name('all.roles');
    Route::get('/add/roles','AddRoles')->name('add.roles');
    Route::post('/store/roles','StoreRoles')->name('store.roles');
    Route::get('/edit/roles/{id}','EditRoles')->name('edit.roles');
    Route::post('/update/roles','UpdateRoles')->name('update.roles');
    Route::get('/delete/roles/{id}','DeleteRoles')->name('delete.roles');



    Route::get('/add/roles/permission','AddRolesPermission')->name('add.roles.permission');

    Route::post('/role/permission/store','RolePermissionStore')->name('role.permission.store');
    Route::get('all/role/permission','AllRolePermissionStore')->name('all.roles.permission');
    Route::get('admin/edit/roles/{id}','AdminEditRoles')->name('admin.edit.roles');
    Route::post('admin/roles/update/{id}','AAdminRolesUpdate')->name('admin.roles.update');
    Route::get('admin/delete/roles/{id}','AdminDeleteRoles')->name('admin.delete.roles');

});


}); ///End Admin Group Middleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::get('/become/instructor', [AdminController::class, 'BecomeInstructor '])->name('become.instructor');

Route::post('/instructor/register', [AdminController::class, 'InstructorRegister '])->name('instructor.register');

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




