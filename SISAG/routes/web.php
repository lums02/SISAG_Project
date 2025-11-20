<?php

use App\Http\Controllers\AcademyController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\CitoyenController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\TransparenceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjetController::class, 'home'])->name('home');
Route::get('/dashboard', [ProjetController::class, 'index'])->name('dashboard');
Route::get('/project/{project}', [ProjetController::class, 'show'])->name('projects.show');

Route::get('/project/{project}/timeline', [TimelineController::class, 'show'])->name('projects.timeline');
Route::post('/project/{project}/timeline', [TimelineController::class, 'store'])->name('projects.timeline.store');
Route::patch('/timeline/{timeline}', [TimelineController::class, 'update'])->name('timelines.update');
Route::get('/project/{project}/transparency', [TransparenceController::class, 'show'])->name('projects.transparency');

Route::get('/academy', [AcademyController::class, 'index'])->name('academy.index');

Route::get('/citizen', [CitoyenController::class, 'index'])->name('citizen.index');
Route::post('/citizen/feedback', [CitoyenController::class, 'storeFeedback'])->name('citizen.feedback');

Route::get('/reports', [RapportController::class, 'index'])->name('reports.index');
Route::post('/reports/generate', [RapportController::class, 'generate'])->name('reports.generate');
Route::get('/reports/{report}/download', [RapportController::class, 'download'])->name('reports.download');
Route::get('/reports/{report}/view', [RapportController::class, 'view'])->name('reports.view');

Route::get('/history', [HistoriqueController::class, 'index'])->name('history.index');

Route::get('/admin/audit', [AuditController::class, 'index'])
    ->middleware('auth')
    ->name('audit.index');
