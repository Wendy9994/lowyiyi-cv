<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReferenceController;
use Barryvdh\DomPDF\Facade\Pdf;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

$factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
$firestore = $factory->createFirestore()->database();
$auth = $factory->createAuth();

// Public CV page
Route::get('/', [ProfileController::class, 'index'])->name('cv.public');

// Admin Login & Authentication
Route::get('/admin', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin', [AdminController::class, 'authenticate'])->name('admin.authenticate');

// Admin Register
Route::get('/admin/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'store'])->name('admin.store');

// Protect Admin Dashboard with Middleware
Route::middleware(['admin'])->group(function () use ($firestore) {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Profile
    Route::get('/admin/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/admin/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/admin/profile/view/{id}', [ProfileController::class, 'view'])->name('profile.view');

    // CRUD Routes for Firebase-based Data
    Route::resource('/admin/education', EducationController::class);
    Route::resource('/admin/experiences', ExperienceController::class);
    Route::resource('/admin/awards', AwardController::class);
    Route::resource('/admin/skills', SkillController::class);
    Route::resource('/admin/languages', LanguageController::class);
    Route::resource('/admin/references', ReferenceController::class);
});

// PDF Download Route
Route::get('/preview-cv', function () use ($firestore) {
    $profileRef = $firestore->collection('profiles')->document('main')->snapshot();
    $educationRef = $firestore->collection('education')->documents();
    $experienceRef = $firestore->collection('experience')->documents();
    $skillsRef = $firestore->collection('skills')->documents();
    $awardsRef = $firestore->collection('awards')->documents();
    $languagesRef = $firestore->collection('languages')->documents();
    $referencesRef = $firestore->collection('references')->documents();

    if (!$profileRef->exists()) {
        return abort(404, 'Profile not found');
    }

    $pdf = Pdf::loadView('cv_pdf', [
        'profile' => $profileRef->data(),
        'education' => $educationRef,
        'experience' => $experienceRef,
        'skills' => $skillsRef,
        'awards' => $awardsRef,
        'languages' => $languagesRef,
        'references' => $referencesRef
    ])->setPaper('A4', 'portrait');

    return $pdf->stream('CV_' . str_replace(' ', '_', $profileRef->get('name')) . '.pdf');
})->name('cv.preview');
