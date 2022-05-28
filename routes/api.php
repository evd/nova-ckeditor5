<?php

use Illuminate\Support\Facades\Route;
use Realevd\NovaCkeditor5\Http\Controllers\UploadController;

Route::post('upload', UploadController::class.'@store');
