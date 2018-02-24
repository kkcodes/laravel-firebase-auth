<?php


Route::group(['middleware' => ['web']], function () {

    Route::any('auth/login', "Kkcodes\FirebaseAuth\Http\FirebaseAuthController@loginFirebase");

});