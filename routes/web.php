<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::group(['prefix' => 'api'], function(){
    Route::get('/distribution', function(){
        return response()->json(['data' => auth()->user()->account->distribution]);
    })->middleware("auth");

    Route::post('/distribution', function() {
        $data = request()->all('usd', 'rub', 'euro');
        $sum = 0;
        foreach($data as $value) {
            $sum += intval($value);
        }
        if($sum !== 100) {
            return response()->json(['msg' => 'Распределите на все 100%'], 400);
        }

        auth()->user()->account->distribution->update($data);
    })->middleware('auth');
});
