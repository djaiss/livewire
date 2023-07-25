<?php

use App\Http\Controllers\Auth\ValidateInvitationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Projects\ProjectController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Settings\SettingsUserController;
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

Route::get('invitation/{code}', [ValidateInvitationController::class, 'show'])->name('invitation.validate.show');
Route::post('invitation/{code}', [ValidateInvitationController::class, 'update'])->name('invitation.validate.update');

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('search', [SearchController::class, 'index'])->name('search.index');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // projects
    Route::prefix('projects')->group(function (): void {
        Route::get('', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('{project}', [ProjectController::class, 'show'])->name('projects.show');
        Route::get('{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

        // messages
        Route::get('{project}/messages', [MessageController::class, 'index'])->name('messages.index');

        // tasklists
        Route::get('{project}/taskLists', [ProjectTaskListController::class, 'index'])->name('tasks.index');
    });

    Route::middleware(['administrator'])->prefix('settings')->group(function (): void {
        Route::get('', [SettingsController::class, 'index'])->name('settings.index');

        // user management
        Route::get('users', [SettingsUserController::class, 'index'])->name('settings.user.index');
        Route::get('users/invite', [SettingsUserController::class, 'create'])->name('settings.user.create');
        Route::post('users/invite', [SettingsUserController::class, 'store'])->name('settings.user.store');
        Route::get('users/{user}/edit', [SettingsUserController::class, 'edit'])->name('settings.user.edit');
        Route::put('users/{user}', [SettingsUserController::class, 'update'])->name('settings.user.update');
        Route::get('users/{user}/delete', [SettingsUserController::class, 'delete'])->name('settings.user.delete');
        Route::delete('users/{user}', [SettingsUserController::class, 'destroy'])->name('settings.user.destroy');

        // office management
        Route::get('personalize/offices', [PersonalizeOfficeController::class, 'index'])->name('settings.personalize.office.index');
        Route::get('personalize/offices/create', [PersonalizeOfficeController::class, 'create'])->name('settings.personalize.office.create');
        Route::post('personalize/offices', [PersonalizeOfficeController::class, 'store'])->name('settings.personalize.office.store');
        Route::get('personalize/offices/{office}/edit', [PersonalizeOfficeController::class, 'edit'])->name('settings.personalize.office.edit');
        Route::put('personalize/offices/{office}', [PersonalizeOfficeController::class, 'update'])->name('settings.personalize.office.update');
        Route::delete('personalize/offices/{office}', [PersonalizeOfficeController::class, 'destroy'])->name('settings.personalize.office.destroy');

        // team type management
        Route::get('personalize/teamTypes', [PersonalizeTeamTypeController::class, 'index'])->name('settings.personalize.team_type.index');
        Route::get('personalize/teamTypes/create', [PersonalizeTeamTypeController::class, 'create'])->name('settings.personalize.team_type.create');
        Route::post('personalize/teamTypes', [PersonalizeTeamTypeController::class, 'store'])->name('settings.personalize.team_type.store');
        Route::get('personalize/teamTypes/{teamType}/edit', [PersonalizeTeamTypeController::class, 'edit'])->name('settings.personalize.team_type.edit');
        Route::put('personalize/teamTypes/{teamType}', [PersonalizeTeamTypeController::class, 'update'])->name('settings.personalize.team_type.update');
        Route::delete('personalize/teamTypes/{teamType}', [PersonalizeTeamTypeController::class, 'destroy'])->name('settings.personalize.team_type.destroy');

        Route::middleware(['account_manager'])->group(function (): void {
            Route::get('personalize/upgrade', [PersonalizeUpgradeController::class, 'index'])->name('settings.personalize.upgrade.index');
            Route::put('personalize/upgrade', [PersonalizeUpgradeController::class, 'update'])->name('settings.personalize.upgrade.update');
        });
    });
});

require __DIR__ . '/auth.php';
