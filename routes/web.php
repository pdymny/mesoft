<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Dashboard\ShowDashboard;
use App\Http\Livewire\Patients\ShowPatients;
use App\Http\Livewire\Patients\ShowPatient;
use App\Http\Livewire\Workers\ShowWorkers;
use App\Http\Livewire\Visits\ShowVisits;
use App\Http\Livewire\Services\ShowServices;
use App\Http\Livewire\Settings\ShowSettings;
use App\Http\Livewire\Documents\ShowDocuments;
use App\Http\Livewire\WorkSchedule\ShowWorkSchedule;
use App\Http\Livewire\Settings\ShowStocks;
use App\Http\Livewire\Settings\ShowWidget;
use App\Http\Livewire\Settings\ShowPayments;
use App\Http\Livewire\ShowRecommend;
use App\Http\Livewire\Communicator\ShowCommunicator;
use App\Http\Livewire\Widget\ShowWidgetGuest;
use App\Http\Livewire\ShowCennik;
use App\Http\Livewire\ShowWelcome;
use App\Http\Livewire\ShowFunkcje;
use App\Http\Livewire\ShowKontakt;
use App\Http\Livewire\ShowRegulamin;
use App\Http\Livewire\ShowPomoc;
use App\Http\Livewire\Terms\ShowTerms;
use App\Http\Livewire\Przelewy24Call;
use App\Http\Livewire\Marketing\ShowMarketing;
use App\Http\Livewire\Admin\ShowAdmin;


Route::get('/', ShowWelcome::class)->name('start');
Route::get('/funkcje', ShowFunkcje::class)->name('funkcje');
Route::get('/cennik', ShowCennik::class)->name('cennik');
Route::get('/kontakt', ShowKontakt::class)->name('kontakt');
Route::get('/regulamin', ShowRegulamin::class)->name('regulamin');
Route::get('/pomoc', ShowPomoc::class)->name('pomoc');

Route::post('/przelewy24', Przelewy24Call::class);

Route::get('/widget/{id}', ShowWidgetGuest::class)->name('guest_widget');
Route::get('/widget/{id}/{visit}', ShowWidgetGuest::class)->name('guest_visit_widget');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', ShowDashboard::class)->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/communicator', ShowCommunicator::class)->name('communicator');

Route::middleware(['auth:sanctum', 'verified'])->get('/visits', ShowVisits::class)->name('visits');

Route::middleware(['auth:sanctum', 'verified'])->get('/terms', ShowTerms::class)->name('terms');

Route::middleware(['auth:sanctum', 'verified'])->get('/patients', ShowPatients::class)->name('patients');
Route::middleware(['auth:sanctum', 'verified'])->get('/patient/{id}', ShowPatient::class)->name('patient');

Route::middleware(['auth:sanctum', 'verified'])->get('/workers', ShowWorkers::class)->name('workers');

Route::middleware(['auth:sanctum', 'verified'])->get('/services', ShowServices::class)->name('services');

Route::middleware(['auth:sanctum', 'verified'])->get('/documents', ShowDocuments::class)->name('documents');

Route::middleware(['auth:sanctum', 'verified'])->get('/marketing', ShowMarketing::class)->name('marketing');

Route::middleware(['auth:sanctum', 'verified'])->get('/settings', ShowSettings::class)->name('settings');
Route::middleware(['auth:sanctum', 'verified'])->get('/work-schedule', ShowWorkSchedule::class)->name('work_schedule');
Route::middleware(['auth:sanctum', 'verified'])->get('/stocks', ShowStocks::class)->name('stocks');
Route::middleware(['auth:sanctum', 'verified'])->get('/payments', ShowPayments::class)->name('payments');
Route::middleware(['auth:sanctum', 'verified'])->get('/widget-notify', ShowWidget::class)->name('widget');

Route::middleware(['auth:sanctum', 'verified'])->get('/recommend', ShowRecommend::class)->name('recommend');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin', ShowAdmin::class)->name('admin');