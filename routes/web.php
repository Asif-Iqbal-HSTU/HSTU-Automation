<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/workspace', [CourseController::class, 'add'])->middleware(['auth', 'verified'])->name('workspace');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/addCourse', [CourseController::class, 'add'])->name('course.add');
    Route::post('/storeCourse', [CourseController::class, 'store'])->name('course.store');

    Route::get('/success', [CourseController::class, 'success'])->name('success');

    Route::get('/set-syllabus/{courseCode}', [CourseController::class, 'setSyllabus'])->name('set-syllabus-route');
    Route::post('/set-syllabus/co/{courseCode}', [CourseController::class, 'storeCourseObjective'])->name('set-syllabus-route.co');
    Route::get('/set-syllabus/clo/{courseCode}', [CourseController::class, 'setSyllabus'])->name('set-syllabus-route.clo');

});

require __DIR__.'/auth.php';
