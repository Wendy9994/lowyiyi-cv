<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReferenceController;

use App\Models\Profile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Award;
use App\Models\Language;
use App\Models\Reference;

// Public CV page
Route::get('/', [ProfileController::class, 'index'])->name('cv.public');

// Admin Login & Authentication
Route::get('/admin', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin', [AdminController::class, 'authenticate'])->name('admin.authenticate');

//Admin Register
Route::get('/admin/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'store'])->name('admin.store');

// Protect Admin Dashboard with Middleware
    Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Profile - Only Edit & Update &View
    Route::get('/admin/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/admin/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/admin/profile/view/{id}', [ProfileController::class, 'view'])->name('profile.view');


    // CRUD Routes for Each Section
    Route::resource('education', EducationController::class);
    Route::put('/education/{education}', [EducationController::class, 'update'])->name('education.update');
    Route::get('/admin/education/view/{id}', [EducationController::class, 'view'])->name('education.view');


    Route::resource('/admin/experiences', ExperienceController::class);
    Route::put('/experiences/{experience}', [ExperienceController::class, 'update'])->name('experiences.update');
    Route::get('/admin/experiences/view/{id}', [ExperienceController::class, 'view'])->name('experiences.view');


    Route::resource('/admin/awards', AwardController::class);
    Route::put('/admin/awards/{award}', [AwardController::class, 'update'])->name('awards.update');
    Route::get('/admin/awards/view/{id}', [AwardController::class, 'view'])->name('awards.view');

    Route::resource('/admin/skills', SkillController::class);
    Route::put('/admin/skills/{skill}', [SkillController::class, 'update'])->name('skills.update');
    Route::get('/admin/skills/view/{id}', [SkillController::class, 'view'])->name('skills.view');


    Route::resource('/admin/languages', LanguageController::class);
    Route::put('/admin/languages/{language}', [LanguageController::class, 'update'])->name('languages.update');
    Route::get('/admin/languages/view/{id}', [LanguageController::class, 'view'])->name('languages.view');


    Route::resource('/admin/references', ReferenceController::class);
    Route::put('/admin/references/{reference}', [ReferenceController::class, 'update'])->name('references.update');
    Route::get('/admin/references/view/{id}', [ReferenceController::class, 'view'])->name('references.view');


});

// PDF Download Route
Route::get('/preview-cv', function () {
    $profile = Profile::first();
    $education = Education::all();
    $experience = Experience::all();
    $skills = Skill::all();
    $awards = Award::all();
    $languages = Language::all();
    $references = Reference::all();

    if (!$profile) {
        return abort(404, "Profile not found");
    }

    // Generate PDF and Open in New Tab (Preview Mode)
    $pdf = Pdf::loadView('cv_pdf', compact('profile', 'education', 'experience', 'skills', 'awards', 'languages', 'references'))
              ->setPaper('A4', 'portrait');

    return $pdf->stream('CV_' . str_replace(' ', '_', $profile->name) . '.pdf');
})->name('cv.preview');