<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "as" => "auth.",
        "name" => "auth",
        "middleware" => ["auth"]
    ],
    function () {
        Route::livewire("/login", "auth.login")->name("login");
        Route::livewire("/signup", "auth.signup")->name("signup");
    }
);

Route::group([
    "as" => "home.",
    "name" => "home",
    "middleware" => ["auth"]
], function () {
    Route::livewire("/", "home.index")->name("index");
});
