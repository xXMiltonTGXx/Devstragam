<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController; 

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

Route::get('/', HomeController::class)->name("home");

Route::get('/nosotros', function () {
    return view('nosotros');
})->name("nosotros");

Route::get('/crear-cuenta', [RegisterController::class, 'index'] )->name('register');
Route::post('/crear-cuenta', [RegisterController::class, 'store'] );

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'Store'])->name('logout');

// nombre modelo user,  user:username que me muestre la ruta con la direccion del usuario 
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');
Route::post('/{user:username}/posts/{post}',[ComentarioController::class,'store'])->name('comentarios.store');
Route::delete('posts/{post}',[PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/imagenes',[ImagenController::class, 'store'])
->name('imagen.store' );

//Like a las fotos
Route::post('/posts/{post}/likes',[LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes',[LikeController::class, 'destroy'])->name('posts.likes.destroy');

//Rutas para el perfil
Route::get('{user:username}/editar-perfil',[PerfilController::class, 'index'])->name('perfil.index');
Route::post('{user:username}/editar-perfil',[PerfilController::class, 'store'])->name('perfil.store');

//Siguiendo a Usuarios  
Route::post('{user:username}/follow',[FollowerController::class, 'store'])->name('users.follow');
Route::delete('{user:username}/unfollow',[FollowerController::class, 'destroy'])->name('users.unfollow');

