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

Route::get('/', 'HomeController@index');

Route::get('/home','HomeController@index')->name('home');
Route::get('/info/about_site',function(){
    return view('info.about_site');
})->name('info.about_site');
Route::get('/vocalo/recently_famous_vocalovideos','RecentlyFamousVocalovideoController@index')->name('vocalo.recently_famous_vocalovideos');
Route::get('/vocalo/vocalo_ranking','FamousVocalovideoController@index')->name('vocalo.vocalo_ranking');
Route::get('/vocalo/vocalo_gacha',function(){
    return view('vocalo.vocalo_gacha');
})->name('vocalo.vocalo_gacha');
Route::get('/vocalo/gacha_result','VocaloGachaController@index')->name('vocalo.gacha_result');
Route::get('/utattemita/recently_famous_utattemita','RecentlyFamousUtattemitaController@index')->name('utattemita.recently_famous_utattemita');