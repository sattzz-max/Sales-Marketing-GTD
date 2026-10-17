<?php
use App\Http\Controllers\{AdminController, InquiryController, PageController};
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'show'])->defaults('page', 'home')->name('home');
foreach (['about', 'team', 'events', 'contact'] as $p) Route::get("/$p", [PageController::class, 'show'])->defaults('page', $p)->name($p);
Route::post('/inquiry', [InquiryController::class, 'submit'])->middleware('throttle:10,1')->name('inquiry.submit');
Route::get('/sitemap.xml', function () {
  $d = cfg()['domain'] ?? ''; abort_unless(ext_url($d), 404); // aktif setelah APP_DOMAIN diisi
  $x = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
  foreach (['', 'about', 'team', 'events', 'contact'] as $p) $x .= '<url><loc>'.e(rtrim($d, '/').'/'.$p).'</loc></url>';
  return response($x.'</urlset>', 200, ['Content-Type'=>'application/xml']);
});

Route::prefix('admin')->group(function () {
  Route::get('login', [AdminController::class, 'loginForm'])->name('login');
  Route::post('login', [AdminController::class, 'login'])->middleware('throttle:6,1');
  Route::middleware('auth')->group(function () {
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/', [AdminController::class, 'inquiries'])->name('admin.inquiries');
    Route::post('inquiries/status', [AdminController::class, 'status'])->name('admin.status');
    Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('settings', [AdminController::class, 'saveSettings'])->name('admin.settings.save');
    Route::get('{res}', [AdminController::class, 'index'])->whereIn('res', ['team','events','gallery'])->name('admin.crud');
    Route::post('{res}', [AdminController::class, 'save'])->whereIn('res', ['team','events','gallery'])->name('admin.save');
    Route::post('{res}/delete', [AdminController::class, 'destroy'])->whereIn('res', ['team','events','gallery'])->name('admin.delete');
  });
});
