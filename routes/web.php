<?php

use App\Http\Controllers\MailController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//category By Author
Route::get('/category/insert', [App\Http\Controllers\CategoryController::class, 'category_insert'])->name('category.insert');
Route::post('/category/submit', [App\Http\Controllers\CategoryController::class, 'category_submit'])->name('category.submit');
Route::get('/category/show', [App\Http\Controllers\CategoryController::class, 'category_show'])->name('category.show');
Route::get('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'category_delete'])->name('category.delete');
Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/edit/confirm/{id}', [App\Http\Controllers\CategoryController::class, 'category_edit_confirm'])->name('category.edit.confirm');

///project Make By Author
Route::get('/category/based/project', [App\Http\Controllers\ProjectController::class, 'project_add_page'])->name('project.add.page');
Route::post('/categorywise/project/insert', [App\Http\Controllers\ProjectController::class, 'categorywise_project_insert'])->name('categorywise.project.insert');
Route::get('/list/project', [App\Http\Controllers\ProjectController::class, 'project_list'])->name('project.list');
Route::get('/edit/project/page/{id}', [App\Http\Controllers\ProjectController::class, 'project_edit_page'])->name('project.edit.page');
Route::post('/update/project/{id}', [App\Http\Controllers\ProjectController::class, 'project_update'])->name('project.update');
Route::get('/project/delete/{id}', [App\Http\Controllers\ProjectController::class, 'project_delete'])->name('project.delete');

//guest System

Route::get('/guest/register', [App\Http\Controllers\GuestController::class, 'guest_register'])->name('guest.register');
Route::get('/guest/login', [App\Http\Controllers\GuestController::class, 'guest_login'])->name('guest.login');
Route::post('/guest/store', [App\Http\Controllers\GuestController::class, 'guest_store'])->name('guest.store');
Route::get('/guest/login/dashboard', [App\Http\Controllers\GuestController::class, 'dashboard'])->name('dashboard');
Route::post('/guest/login/req', [App\Http\Controllers\GuestLoginController::class, 'guest_login_req'])->name('guest.login.req');
Route::get('/guest/logout', [App\Http\Controllers\GuestController::class, 'guest_logout'])->name('guest.logout');
Route::get('/guest/pass/reset/req', [App\Http\Controllers\GuestController::class, 'guest_pass_reset_req'])->name('guest.pass.reset.req');
Route::post('/guest/pass/req/send', [App\Http\Controllers\GuestController::class, 'guest_pass_req_send'])->name('guest.pass.req.send');
Route::get('/guest/pass/reset/form/{token}', [App\Http\Controllers\GuestController::class, 'guest_pass_reset_form'])->name('guest.pass.reset.form');
Route::post('/guest/pass/reset', [App\Http\Controllers\GuestController::class, 'pass_reset'])->name('pass.reset');

//guest profile
Route::get('/guest/profile/page/{id}', [App\Http\Controllers\GuestProfile::class, 'profile_page'])->name('profile.page');
Route::get('/profile/show/{id}', [App\Http\Controllers\GuestProfile::class, 'profile_show'])->name('profile.show');

Route::post('/guest/profile/update/{id}', [App\Http\Controllers\GuestProfile::class, 'guest_update'])->name('guest.update');

//guestWorkAddPage
Route::get('/work/add/page', [App\Http\Controllers\WorkController::class, 'work_add_page'])->name('work.add.page');
Route::post('/work/upload/success', [App\Http\Controllers\WorkController::class, 'work_upload_success'])->name('work.upload.success');
Route::get('/work/list', [App\Http\Controllers\WorkController::class, 'work_list'])->name('work.list');
Route::get('/work/details/{id}', [App\Http\Controllers\WorkController::class, 'work_details'])->name('work.details');

//task find by member
Route::get('/task/list_from_user', [App\Http\Controllers\TaskFindController::class, 'task_list_from_user'])->name('task.list_from_user');
Route::get('/req/task/{id}', [App\Http\Controllers\TaskFindController::class, 'req_task'])->name('req.task');
Route::get('/task/req/show', [App\Http\Controllers\TaskFindController::class, 'task_req_show'])->name('task.req.show');



//Tasks Request From MemberUpgrade
Route::get('/show/request/list/{id}', [App\Http\Controllers\TaskRequestsfromMember::class, 'show_request_list'])->name('show.request.list');
Route::get('/accept/tasks/{id}', [App\Http\Controllers\TaskRequestsfromMember::class, 'accept_tasks'])->name('accept.tasks');
Route::get('/request/delete/{id}', [App\Http\Controllers\TaskRequestsfromMember::class, 'request_delete'])->name('request.delete');



Route::get('send-mail', [MailController::class, 'index'])->name('send.email');
Route::get('/work/{id}', [App\Http\Controllers\TaskFindController::class, 'work'])->name('work.update');
Route::get('/work/done/{id}', [App\Http\Controllers\TaskFindController::class, 'work_done'])->name('work.done');
Route::get('/work/delete/{id}', [App\Http\Controllers\TaskFindController::class, 'work_delete'])->name('work.delete');




///
Route::get('/requester/description/{id}', [App\Http\Controllers\TaskRequestsfromMember::class, 'requester_description'])->name('requester.description');
Route::get('/profile/{id}', [App\Http\Controllers\TaskRequestsfromMember::class, 'profile'])->name('profile');



//admin find member
Route::get('/hire/member', [App\Http\Controllers\AdminWithMember::class, 'hire_member'])->name('hire.member');
Route::get('/member/details/{id}', [App\Http\Controllers\AdminWithMember::class, 'member_details'])->name('member.details');



///Role Manager

Route::get('/role', [App\Http\Controllers\RoleController::class, 'role'])->name('role');
Route::post('/permission/store', [App\Http\Controllers\RoleController::class, 'permission_store'])->name('permission.store');
Route::get('/permission/edit/{id}', [App\Http\Controllers\RoleController::class, 'permission_edit'])->name('permission.edit');
Route::post('/permission_edit/confirm/{id}', [App\Http\Controllers\RoleController::class, 'permission_edit_confirm'])->name('permission_edit.confirm');
Route::get('/permission/delete/{id}', [App\Http\Controllers\RoleController::class, 'permission_delete'])->name('permission.delete');
Route::post('/permission/update', [App\Http\Controllers\RoleController::class, 'permission_update'])->name('permission.update');



Route::post('role/store', [App\Http\Controllers\RoleController::class, 'role_store'])->name('role.store');
Route::get('/remove/role/{id}', [App\Http\Controllers\RoleController::class, 'remove_role'])->name('remove.role');
Route::get('/edit/user/role/permission/{id}', [App\Http\Controllers\RoleController::class, 'edit_user_role_permission'])->name('edit.user.role.permission');
Route::get('/role/delete/{id}', [App\Http\Controllers\RoleController::class, 'role_delete'])->name('role.delete');


Route::post('/assign/role', [App\Http\Controllers\RoleController::class, 'assign_role'])->name('assign.role');
Route::post('/assign/role/tologer', [App\Http\Controllers\RoleController::class, 'assign_role_tologer'])->name('assign.role.tologer');
Route::get('/member/list', [App\Http\Controllers\RoleController::class, 'member_list'])->name('member.list');
Route::get('/assigning/newtask/{id}', [App\Http\Controllers\AssiginingNewTask::class, 'assigning_newtask'])->name('assigning.newtask');

Route::get('/assign/task/{id}/{category_id}', [App\Http\Controllers\AssiginingNewTask::class, 'assign_task'])->name('assign.task');
Route::get('/remove/task/{id}/{category_id}', [App\Http\Controllers\AssiginingNewTask::class, 'remove_task'])->name('remove.task');



// Route::get('/assign/task/{id}/{category_id}', [App\Http\Controllers\AssiginingNewTask::class, 'assign_task'])->name('my.tasklist');
Route::get('/my/task/{id}', [App\Http\Controllers\AssiginingNewTask::class, 'my_tasklist'])->name('my.tasklist');
Route::get('/working/onit/{id}', [App\Http\Controllers\AssiginingNewTask::class, 'working_onit'])->name('working.onit');
Route::get('/working/done/{id}', [App\Http\Controllers\AssiginingNewTask::class, 'working_done'])->name('working.done');
Route::get('/my/memberlist/{id}', [App\Http\Controllers\AssiginingNewTask::class, 'my_memberlist'])->name('my.memberlist');
Route::get('/delete/mytaskmembers/{id}', [App\Http\Controllers\AssiginingNewTask::class, 'delete_mytaskmembers'])->name('delete.mytaskmembers');



//update profile
Route::post('/update/profile/{id}', [App\Http\Controllers\HomeController::class, 'update_profile'])->name('update.profile');
Route::get('/user/profile/{id}', [App\Http\Controllers\HomeController::class, 'user_profile'])->name('user.profile');


//google
// Route::get('/google/redirect', [App\Http\Controllers\GoogleController::class, 'redirect_provider'])->name('google.redirect');
// Route::get('google/callback', [App\Http\Controllers\GoogleController::class, 'provider_to_application'])->name('google.callback');
// // Route::get('auth/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('auth.google');
// // Route::get('auth/google/callback', [App\Http\Controllers\GoogleController::class, 'handleGoogleCallback']);