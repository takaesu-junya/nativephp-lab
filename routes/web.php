<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Native\Laravel\Facades\Notification;
use Native\Laravel\Facades\Settings;
use Native\Laravel\Facades\Window;

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
    if (request()->openwindow) {
    }
    if (request()->notification) {
        Notification::title('Hello from NativePHP🐘')
            ->message('ウイルスに感染しました！🥳')
            ->show();
    }
    return view('welcome', [
        'users' => User::all(),
        'theme' => Settings::get('theme', 'light')
    ]);
});

Route::view('/about', 'about')->name('about');
Route::get('/settings', function () {

    return view('/settings', [
        'theme' => Settings::get('theme', 'light')
    ]);
});



Route::post('/user', function () {
    User::factory()->create();
    Notification::title('User created')
        ->message('Details about user here.')
        ->show();
    return back();
});

Route::post('/settings', function (Request $request) {
    Settings::set('theme', $request::post('theme'));

    return redirect('/');
});

Route::get('/reddit', function () {
    $response = Http::get('https://www.reddit.com/r/rarepuppers.json');
    $posts = $response->json()['data']['children'];
    return view('index', [
        'posts' => $posts,

    ]);
});

Route::get('/posts/{id}', function (string $id) {
    $response = Http::get('https://api.reddit.com/api/info/?id=' . $id);
    $post = $response->json()['data']['children'];

    Notification::new()
        ->title($post[0]['data']['title'])
        ->message('Cute doggos!')
        ->show();

    return view('show', [
        'post' => $post,
    ]);
});
