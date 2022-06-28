<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\UserController;

Route::prefix("auth")->group(function () {
    Route::post("register", [AuthController::class, "register"]);
    Route::post("login", [AuthController::class, "login"]);

    Route::middleware("auth:api")->group(function () {
        Route::post("logout", [AuthController::class, "logout"]);
        Route::get("user", [AuthController::class, "user"]);
        Route::get("refresh", [AuthController::class, "refresh"]);
    });
});

Route::post("users", [UserController::class, "index"]);
Route::put("users/{user}", [UserController::class, "update"]);
Route::delete("users/{user}", [UserController::class, "destroy"]);

// ==== groups ====
Route::resource("groups", GroupController::class);
Route::get("groups/update/{group_id}", [GroupController::class, "groupIndex"]);

Route::get("questions/{group_id}", [QuestionController::class, "index"]);
Route::resource("questions", QuestionController::class);

Route::post("answers", [AnswerController::class, "store"]);
Route::get("/answers/with-selected-answers", [AnswerController::class, "index"]);
