<?php

use App\Http\Controllers\ollamaController;
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

Route::get(
    '/', [OllamaController::class, 'prompt']
);

Route::post(
    '/', [OllamaController::class, 'answer']
);

Route::get('/ollama-status', [OllamaController::class, 'checkStatus'])->name('ollama.status');
